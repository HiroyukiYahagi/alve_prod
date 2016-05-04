<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Fomulas Controller
 *
 * @property \App\Model\Table\FomulasTable $Fomulas
 */
class FomulasController extends AppController
{

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);

        //TODO
        //自社のID以外にアクセスが来た場合は強制リダイレクト
        $this->_validateId($event);
    }

    private function _validateId(Event $event){
        if(isset($event->subject()->request->params['pass'][0])){
            $id = $event->subject()->request->params['pass'][0];
        }else if(isset($this->request->data['id'])){
            $id = $this->request->data['id'];
        }else if(isset($this->request->query['id'])){
            $id = $this->request->query['id'];
        }else{
            return;
        }

        $fomula = $this->Fomulas->get($id);
        if($this->getAuthedUserId() != $fomula->company_id){
            $this->Flash->error(__('Invalid Access'));
            $this->redirect(['controller' => 'Top', 'action' => 'index']);
        }
    }


    public function view($id = null)
    {
        $fomula = $this->Fomulas->get($id, [
            'contain' => ['Companies', 'FomulaItems' => ['FomulaHeads']]
        ]);
        $this->set('fomula', $fomula);

        foreach ($fomula->fomula_items as $fomula_item) {
            $answers[$fomula_item->fomula_head->large_type][] = $fomula_item;
        }
        $this->set('answers', $answers);

    }

    private function _setFomulaHeads(){
        $this->loadModel("FomulaHeads");
        $fomulaHeads = $this->FomulaHeads->find('all')->contain(['Allocations' => ['AllocationItems']]);

        foreach ($fomulaHeads as $fomulaHead) {
            $fomulaHeadsMap[$fomulaHead->large_type][] = $fomulaHead;
        }
        $this->set('fomulaHeadsMap', $fomulaHeadsMap);
        return $fomulaHeadsMap;
    }


    public function evaluate(){

        $head_id = $this->request->data['head_id'];

        $json = json_encode(['head_id' => $head_id ,'data' => ['result' => 'OK', 'point' => 'OK' ]]);
        echo $json;

        $this->autoRender = false;
    }


    public function edit($id = null){
        if($id == null){
            $fomula = $this->Fomulas->newEntity();
            $this->set('title', __('New Formula Evaluation'));
        }else{
            $fomula = $this->Fomulas->get($id, ['contain' => ['FomulaItems' => ['FomulaHeads', 'Units']]]);
            $this->set('title', __('Edit Formula Evaluation'));

            foreach ($fomula->fomula_items as $fomula_item) {
                $selectedValues[$fomula_item->head_id] = $fomula_item->value;
            }
            $this->set('selectedValues', $selectedValues);
        }
        $this->set('fomula', $fomula);

        $this->_setEvaluationHeads();
    }

    private function _saveData($id, $data){
        
        if($id == null){
            $fomula = $this->Fomulas->newEntity();
            $company_id = $this->getAuthedUserId();
            $fomula->company_id = $company_id;
        }else{
            $fomula = $this->Fomulas->get($id, ['contain' => ['FomulaItems' => ['FomulaHeads', 'Units']]]);
        }

        $fomula->operator_name = $data['operator_name'];
        $fomula = $this->Fomulas->save($fomula);

        if($fomula == null){
            $this->Flash->error(__('Server Error:1'));
            return null;
        }
        
        $this->loadModel('FomulaItems');
        $this->FomulaItems->deleteAll(['fomula_id' => $fomula->id]);
        foreach ($data['selected'] as $key => $value) {
            $fomulaItems = $this->FomulaItems->newEntity();
            $fomulaItems->value = isset($data['new_value'][$key]) ? $data['new_value'][$key] : null;
            $fomulaItems->head_id = $key;
            $fomulaItems->fomula_id = $fomula->id;
            if(!$this->FomulaItems->save($fomulaItems)){
                $this->Flash->error(__('Server Error:2'));
                return null;
            }
        }

        $fomula = $this->Fomulas->get($id, ['contain' => ['FomulaItems' => ['FomulaHeads', 'Units']]]);
        return $fomula;
    }

    public function save($id = null){
        $data = $this->request->data;
        $fomula = $this->_saveData($id, $data);

        if($fomula == null){
            $this->Flash->error(__('Invalid Access.'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $this->Flash->success(__('Fomula has been saved.'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    public function submit($id = null){
        $data = $this->request->data;
        $fomula = $this->_saveData($id, $data);
        if($fomula == null){
            $this->Flash->error(__('Invalid Access.'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
        return $this->redirect(['controller' => 'Fomulas', 'action' => 'view', $id]);
    }

    private function _setEvaluationHeads(){
        $this->loadModel("FomulaHeads");
        $fomulaHeads = $this->FomulaHeads->find('all')->contain(['Allocations' => ['AllocationItems']]);

        foreach ($fomulaHeads as $fomulaHead) {
            $fomulaHeadsMap[$fomulaHead->large_type][] = $fomulaHead;
        }

        $this->set('fomulaHeadsMap', $fomulaHeadsMap);
        return $fomulaHeadsMap;
    }

    public function delete($id = null)
    {
        $fomula = $this->Fomulas->get($id);
        if ($this->Fomulas->delete($fomula)) {
            $this->Flash->success(__('The fomula has been deleted.'));
        } else {
            $this->Flash->error(__('The fomula could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }
}
