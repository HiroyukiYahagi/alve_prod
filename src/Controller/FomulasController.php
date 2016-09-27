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
            $this->Flash->error(__('不正なアクセスです'));
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
            $buffer[$fomulaHead->large_type][$fomulaHead->small_type]['value'] += $this->_evaluation($fomulaItem->head_id, $fomulaItem->value, $fomulaItem->compared_value)['point'];
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

    private function _setFomulaHeadsDetail(){
        $this->loadModel("FomulaHeads");
        $fomulaHeads = $this->FomulaHeads->find('all')->contain(['Allocations' => ['AllocationItems']]);

        foreach ($fomulaHeads as $fomulaHead) {
            $fomulaHeadsMap[$fomulaHead->large_type][$fomulaHead->medium_type." - ".$fomulaHead->small_type][] = $fomulaHead;
        }
        $this->set('fomulaHeadsMap', $fomulaHeadsMap);
        return $fomulaHeadsMap;
    }

    public function evaluate(){
        $this->autoRender = false;

        $head_id = $this->request->data['head_id'];
        $newValue = $this->request->data['newValue'];
        $oldValue = $this->request->data['oldValue'];

        //echo json_encode(["test"=>$head_id , "a" => $newValue]);

        echo json_encode(['head_id' => $head_id ,'data' => $this->_evaluation($head_id, $newValue, $oldValue)]);
    }

    private function _evaluation($headId, $newValue, $oldValue){
        $this->loadModel('FomulaHeads');
        $fomulaHead = $this->FomulaHeads->get($headId, ['contain' => ['Allocations' => ['AllocationItems']]]);
        
        $data = ['result' => '0%', 'point' => '0'];
        switch ($fomulaHead->allocation->allocation_type) {
            case 0:
                $data = $this->_valueEvaluation($newValue, $fomulaHead->allocation->allocation_items);
                break;
            case 1:
                if($newValue == 0) break;
                $rate = (($newValue - $oldValue)/$newValue)*100;
                $data = $this->_rangeEvaluation($rate, $fomulaHead->allocation->allocation_items);
                $data['result'] .= $fomulaHead->allocation->allocation_unit;
                break;
            case 2:
                if($oldValue == 0) break;
                $rate = (($oldValue - $newValue)/$oldValue)*100;
                $data = $this->_rangeEvaluation($rate, $fomulaHead->allocation->allocation_items);
                $data['result'] .= $fomulaHead->allocation->allocation_unit;
                break;
        }
        return $data;
    }

    private function _valueEvaluation($newValue, $candidates){
        foreach ($candidates as $candidate) {
            if($newValue == $candidate->id){
                return ['result' => '-', 'point' => $candidate->point];
            }
        }
        return ['result' => '-', 'point' => '-'];
    }
    
    private function _rangeEvaluation($rate, $candidates){

        foreach ($candidates as $candidate) {
            if($candidate->range_max === null || $candidate->range_max > $rate ){
                if($candidate->range_min === null || $candidate->range_min <= $rate ){
                    if($rate == 0){
                        return ['result' => round($rate, 1), 'point' => '0'];
                    }else{
                        return ['result' => round($rate, 1), 'point' => $candidate->point];
                    }
                }
            }
        }
        return ['result' => round($rate, 1), 'point' => '-1'];
    }

    public function edit($id = null){
        $this->_setUnitMap();

        if($id == null){
            $fomula = $this->Fomulas->newEntity();
            $this->set('title', __('新規しくみ評価'));
        }else{
            $fomula = $this->Fomulas->get($id, ['contain' => ['FomulaItems' => ['FomulaHeads', 'Units']]]);
            $this->set('title', __('しくみ評価の編集'));

            $selectedUnits=null;
            $selectedValues=null;
            $selectedCompValues=null;
            $selectedOptValues=null;
            foreach ($fomula->fomula_items as $fomula_item) {
                $selectedUnits[$fomula_item->head_id] = $fomula_item->unit_id;
                $selectedValues[$fomula_item->head_id] = $fomula_item->value;
                $selectedCompValues[$fomula_item->head_id] = $fomula_item->compared_value;
                $selectedOptValues[$fomula_item->head_id] = $fomula_item->other_unit;
            }
            $this->set('selectedUnits', $selectedUnits);
            $this->set('selectedValues', $selectedValues);
            $this->set('selectedCompValues', $selectedCompValues);
            $this->set('selectedOptValues', $selectedOptValues);
        }
        $this->set('fomula', $fomula);

        //TODO
        //$this->_setFomulaHeads();
        $this->_setFomulaHeadsDetail();
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
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return null;
        }
        
        $this->loadModel('FomulaItems');
        $this->FomulaItems->deleteAll(['fomula_id' => $fomula->id]);
        foreach ($data['selected'] as $key => $value) {
            $fomulaItems = $this->FomulaItems->newEntity();
            $fomulaItems->value = isset($data['new_value'][$key]) ? $data['new_value'][$key] : null;
            $fomulaItems->compared_value = isset($data['old_value'][$key]) ? $data['old_value'][$key] : null;
            $fomulaItems->other_unit = isset($data['other_unit'][$key]) ? $data['other_unit'][$key] : null;
            $fomulaItems->unit_id = isset($data['units'][$key]) ? $data['units'][$key] : null;

            $fomulaItems->head_id = $key;
            $fomulaItems->fomula_id = $fomula->id;
            if(!$this->FomulaItems->save($fomulaItems)){
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
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
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $this->Flash->success(__('しくみ評価が保存されました'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    private function _validateFomulaEvaluation($fomula)
    {
        if(!isset($fomula->fomula_start)){
            return false;
        }
        if(!isset($fomula->fomula_end)){
            return false;
        }

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
            $this->Flash->error(__('必須項目が入力されていません。入力した内容を確認してください。'));
            return $this->redirect(['controller' => 'Fomulas', 'action' => 'edit', $fomula->id]);
        }

        $fomula->completed = 1;
        $fomula = $this->Fomulas->save($fomula);

        if($fomula == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
        return $this->redirect(['controller' => 'Fomulas', 'action' => 'view', $fomula->id]);
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
            $this->Flash->success(__('しくみ評価が削除されました'));
        } else {
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
        }
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    public function downloadCsv($id){

        $fomula = $this->Fomulas->get($id, ['contain' => ['FomulaItems' => ['Units', 'FomulaHeads' => ['Allocations' => ['AllocationItems'] ] ] ] ]);

        if(!isset($fomula)){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $filename = "しくみ評価データ_".date('Ymd');
        $this->set('filename', $filename);

        $header = ['大分類', '中分類', '小分類', '項目', '値'];
        $this->set('header', $header);


        $this->loadModel('FomulaHeads');
        $fomulaHeads = $this->FomulaHeads->find()->all()->toArray();
        foreach ($fomulaHeads as $key => $fomulaHead) {
            $buffer['large_type'] = $fomulaHead->large_type;
            $buffer['medium_type'] = $fomulaHead->medium_type;
            $buffer['small_type'] = $fomulaHead->small_type;
            $buffer['item_description'] = $fomulaHead->item_description;
            $buffer['unit'] = '';
            $buffer['value'] = '';
            $data[$fomulaHead->id] = $buffer;            
        }



        foreach ($fomula->fomula_items as $key => $fomulaItem) {

            $fomulaHead = $fomulaItem->fomula_head;
            $unit = $fomulaItem->unit;
            $allocation = $fomulaHead->allocation;
            $allocationType = $allocation->allocation_type;
            
            $value = '';
            if($allocationType != 0){
                $value = $fomulaItem->value;
            }else{
                $allocationItems = $allocation->allocation_items;
                foreach ($allocationItems as $allocationItem) {
                    if($allocationItem->id == $fomulaItem->value){
                        $value = $allocationItem->text;
                    }
                }
            }

            $buffer['large_type'] = $fomulaHead->large_type;
            $buffer['medium_type'] = $fomulaHead->medium_type;
            $buffer['small_type'] = $fomulaHead->small_type;
            $buffer['item_description'] = $fomulaHead->item_description;
            $buffer['unit'] = !is_null($unit) ? $unit->name : '';
            $buffer['value'] = $value;

            $data[$fomulaHead->id] = $buffer;
        }
        $this->set('data', $data);

        $this->viewBuilder()->layout(false);
    }


    private function _downloadCsv($id){

        $fomula = $this->Fomulas->get($id, ['contain' => ['FomulaItems' => ['Units', 'FomulaHeads' => ['Allocations' => ['AllocationItems'] ] ] ] ]);

        if(!isset($fomula)){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }


        $filename = "しくみ評価データ_".date('Ymd');   
        
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strstr($user_agent, 'Trident') || strstr($user_agent, 'MSIE')) {
            $filename = mb_convert_encoding($filename, "SJIS");
        }

        $this->set('filename', $filename);

        $header = ['大分類', '中分類', '小分類', '項目', '値'];
        $this->set('header', $header);

        foreach ($fomula->fomula_items as $key => $fomulaItem) {

            $fomulaHead = $fomulaItem->fomula_head;
            $unit = $fomulaItem->unit;
            $allocation = $fomulaHead->allocation;
            $allocationType = $allocation->allocation_type;
            
            $value = '';
            if($allocationType != 0){
                $value = $fomulaItem->value;
            }else{
                $allocationItems = $allocation->allocation_items;
                foreach ($allocationItems as $allocationItem) {
                    if($allocationItem->id == $fomulaItem->value){
                        $value = $allocationItem->text;
                    }
                }
            }

            $buffer['large_type'] = $fomulaHead->large_type;
            $buffer['medium_type'] = $fomulaHead->medium_type;
            $buffer['small_type'] = $fomulaHead->small_type;
            $buffer['item_description'] = $fomulaHead->item_description;
            $buffer['unit'] = !is_null($unit) ? $unit->name : '';
            $buffer['value'] = $value;

            $data[] = $buffer;
        }
        $this->set('data', $data);

        $this->viewBuilder()->layout(false);
    }
}
