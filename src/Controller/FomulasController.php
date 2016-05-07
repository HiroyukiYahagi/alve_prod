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

        $this->set('scores', $this->_scoring($fomula->fomula_items));
    }

    private function _scoring($fomulaItems)
    {
        $this->loadModel('FomulaHeads');
        $fomulaHeads = $this->FomulaHeads->find()->all()->toArray();
        foreach ($fomulaHeads as $fomulaHead) {
            $buffer[$fomulaHead->large_type][$fomulaHead->small_type]['value'] = 0;
            $buffer[$fomulaHead->large_type][$fomulaHead->small_type]['count'] = 0;
        }

        foreach ($fomulaItems as $fomulaItem) {
            $fomulaHead = $fomulaItem->fomula_head;
            $buffer[$fomulaHead->large_type][$fomulaHead->small_type]['value'] += $this->_evaluation($fomulaItem->head_id, $fomulaItem->value);
            $buffer[$fomulaHead->large_type][$fomulaHead->small_type]['count'] += 1;
        }

        foreach($buffer as $key => $value){
            $valueSum = 0;
            $countSum = 0;
            foreach($value as $keyItem => $valueItem){
                $valueSum += $valueItem['value'];
                $countSum += ($valueItem['count'] == 0) ? 1 : $valueItem['count'] ;
            }
            $scores[$key] = round( $valueSum / $countSum , 2 ) ;
        }
        return $scores;
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
        $newValue = $this->request->data['newValue'];

        $point = $this->_evaluation($head_id, $newValue);

        $json = json_encode(['head_id' => $head_id ,'data' => ['point' => $point ]]);
        echo $json;
        $this->autoRender = false;
    }

    private function _evaluation($headId, $value){
        $this->loadModel('FomulaHeads');
        $fomulaHead = $this->FomulaHeads->get($headId, ['contain' => ['Allocations' => ['AllocationItems']]]);

        switch ($fomulaHead->allocation->allocation_type) {
            case 0:
                return $this->_valueEvaluation($value, $fomulaHead->allocation->allocation_items);
            case 1:
            case 2:
                return $this->_rangeEvaluation($value, $fomulaHead->allocation->allocation_items);
        }
        return null;
    }

    private function _valueEvaluation($value, $allocationItems){
        foreach ($allocationItems as $allocationItem) {
            if($allocationItem->id == $value)
                return $allocationItem->point;
        }
        return 0;
    }
    
    private function _rangeEvaluation($value, $allocationItems){
        foreach ($allocationItems as $allocationItem) {
            if($allocationItem->range_max === null || intval($allocationItem->range_max) > $value ){
                if($allocationItem->range_min === null || intval($allocationItem->range_min) <= $value ){
                    return $allocationItem->point;
                }
            }
        }
        return 0;
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
        $fomula->fomula_start = $data['fomula_start'];
        $fomula->fomula_end = $data['fomula_end'];
        $fomula = $this->Fomulas->save($fomula);

        if($fomula == null){
            $this->Flash->error(__('Server Error'));
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
                $this->Flash->error(__('Server Error'));
                return null;
            }
        }

        $fomula = $this->Fomulas->get($fomula->id, ['contain' => ['FomulaItems' => ['FomulaHeads', 'Units']]]);
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

    private function _validateFomulaEvaluation($fomula)
    {
        foreach ($fomula->fomula_items as $fomula_item) {
            if ($fomula_item->value == null
                || count($fomula_item->value) == 0
                ) {
                return false;
            }
        }
        return true;
    }

    public function submit($id = null){
        $data = $this->request->data;
        $fomula = $this->_saveData($id, $data);

        if(!$this->_validateFomulaEvaluation($fomula)){
            $this->Flash->error(__('Not completed.'));
            return $this->redirect(['controller' => 'Fomulas', 'action' => 'edit', $fomula->id]);
        }

        $fomula->completed = 1;
        $fomula = $this->Fomulas->save($fomula);

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

    public function unpublish($id = null)
    {
        $fomula = $this->Fomulas->get($id);
        $fomula->completed = 0;
        $this->Fomulas->save($fomula);
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
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
