<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{

    public $helpers = ['Csv'];

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['search']);

        //TODO
        //自社のプロダクトID以外にアクセスが来た場合は強制リダイレクト
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

        $product = $this->Products->get($id);
        if($this->getAuthedUserId() != $product->company_id){
            $this->Flash->error(__('不正なアクセスです'));
            $this->redirect(['controller' => 'Top', 'action' => 'index']);
        }
    }


    public function search()
    {
        $this->loadModel("Types");
        $types = $this->Types->find();
        $this->set('types', $types);

        $data = $this->request->query;
        if(isset($data['options'])){
            $products = $this->Products->findByConditions(null , isset($data['options'])? $data['options'] : null );
            $this->set('products', $products);
            $this->set('query', array_flip($data['options']));
        }

        $this->viewBuilder()->layout(false);
    }

    public function view($id = null)
    {
        $product = $this->Products->get($id, ['contain' => ['Evaluations' => ['EvaluationItems' => ['EvaluationHeads'] ], 'Types']] );
        $this->set('product', $product);

        //set answer
        if (isset($product->evaluations[0])) {
            foreach ($product->evaluations[0]->evaluation_items as $evaluation_item) {
                $answers[$evaluation_item->evaluation_head->large_type][] = $evaluation_item->evaluation_head;
            }
            $this->set('answersMap', $answers);

            $scores = $this->_scoring($product->evaluations[0]->evaluation_items);
            $this->set('scores', $scores);
        }else{
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
    }

    private function _setEvaluationHeads(){
        $this->loadModel("EvaluationHeads");
        $evaluationHeads = $this->EvaluationHeads->find('all')->contain(['Allocations' => ['AllocationItems']]);

        foreach ($evaluationHeads as $evaluationHead) {
            $evaluationHeadsMap[$evaluationHead->large_type][] = $evaluationHead;
        }
        $this->set('evaluationHeadsMap', $evaluationHeadsMap);
        return $evaluationHeadsMap;
    }

    private function _setEvaluationHeadsDetail(){
        $this->loadModel("EvaluationHeads");
        $evaluationHeads = $this->EvaluationHeads->find('all')->contain(['Allocations' => ['AllocationItems']]);

        foreach ($evaluationHeads as $evaluationHead) {
            $evaluationHeadsMap[$evaluationHead->large_type][$evaluationHead->medium_type.' - '.$evaluationHead->small_type][] = $evaluationHead;
        }
        $this->set('evaluationHeadsMap', $evaluationHeadsMap);
        return $evaluationHeadsMap;        
    }

    public function edit($id = null)
    {
        $this->loadModel("Types");
        $types = $this->Types->find();
        $this->set('types', $types);

        // TODO
        // $this->_setEvaluationHeads();
        $this->_setEvaluationHeadsDetail();
        $this->_setUnitMap();

        if($id == null){
            $this->set('title', __('新製品の登録'));
        }else{
            $this->set('title', __('製品情報の編集'));
            $product = $this->Products->get($id, [
                'contain' => ['Types', 'Evaluations' => [ 'EvaluationItems' => ['Units'] ] ]
            ]);
            $this->set('product', $product);


            $selectedUnits=null;
            $selectedValues=null;
            $selectedCompValues=null;
            foreach ($product->evaluations[0]->evaluation_items as $evaluation_item) {
                $selectedUnits[$evaluation_item->head_id] = $evaluation_item->unit_id;
                $selectedValues[$evaluation_item->head_id] = $evaluation_item->value;
                $selectedCompValues[$evaluation_item->head_id] = $evaluation_item->compared_value;
            }

            $this->set('selectedUnits', $selectedUnits);
            $this->set('selectedValues', $selectedValues);
            $this->set('selectedCompValues', $selectedCompValues);
        }
    }

    /* ajax function */
    public function evaluate(){
        $this->autoRender = false;

        $evaluationId = $this->request->data['evaluation_id'];
        $newValue = $this->request->data['newValue'];
        $oldValue = $this->request->data['oldValue'];

        echo json_encode([
            'evaluation_id' => $evaluationId ,
            'data' => $this->_evaluateValues($evaluationId, $newValue, $oldValue)]
        );

    }

    private function _evaluateValues($evaluationId, $newValue, $oldValue){
        $this->loadModel('EvaluationHeads');
        $evaluationHead = $this->EvaluationHeads->get($evaluationId, ['contain' => ['Allocations' => ['AllocationItems'] ] ]);

        $data = ['result' => '-', 'point' => '-'];
        switch ($evaluationHead->allocation->allocation_type) {
            case 1:
                if($newValue == 0) break;
                $rate = (($newValue - $oldValue)/$newValue)*100;
                $data = $this->_rangeEvaluation($rate, $evaluationHead->allocation->allocation_items);
                $data['result'] .= $evaluationHead->allocation->allocation_unit;
                break;
            case 2:
                if($oldValue == 0) break;
                $rate = (($oldValue - $newValue)/$oldValue)*100;
                $data = $this->_rangeEvaluation($rate, $evaluationHead->allocation->allocation_items);
                $data['result'] .= $evaluationHead->allocation->allocation_unit;
                break;
            case 0:
                //特定値評価
                $data = $this->_valueEvaluation($newValue, $evaluationHead->allocation->allocation_items);
                break;
        }
        return $data;
    }

    private function _rangeEvaluation($rate, $candidates){
        foreach ($candidates as $candidate) {
            if($candidate->range_max === null || intval($candidate->range_max) > $rate ){
                if($candidate->range_min === null || intval($candidate->range_min) <= $rate ){
                    return ['result' => round($rate, 1), 'point' => $candidate->point];
                }
            }
        }
        return ['result' => round($rate, 1), 'point' => '0'];
    }

    private function _valueEvaluation($newValue, $candidates){
        foreach ($candidates as $candidate) {
            if($newValue == $candidate->id){
                return ['result' => '-', 'point' => $candidate->point];
                
            }
        }
        return ['result' => '-', 'point' => '-'];
    }

    private function _validateProductEvaluation($product){

        if (!isset($product->evaluations[0]))    
            return false;

        if (!isset($product->type))    
            return false;

        if (!isset($product->product_name) || strlen($product->product_name) == 0)
            return false;
        if (!isset($product->model_number) || strlen($product->model_number) == 0)
            return false;

        if (!isset($product->sales_date))
            return false;
        if (!isset($product->latest_fomula))
            return false;

        foreach ($product->evaluations[0]->evaluation_items as $key => $evaluation_item) {
            if ($evaluation_item->value == null
                || $evaluation_item->compared_value == null
                || count($evaluation_item->value) == 0
                || count($evaluation_item->compared_value) == 0
                ) {
                return false;
            }
        }
        
        return true;
    }

    private function _saveData($id, $data){
        $companyId = $this->getAuthedUserId();
        if(!isset($id)){
            $product = $this->Products->newEntity();
            $product->company_id = $companyId;
        }else{
            $product = $this->Products->get($id, ['contain' => ['Evaluations' => ['EvaluationItems'], 'Types']]);
        }
        $product = $this->Products->patchEntity($product, $data);

        //日付関係
        $product->sales_date = $data['sales_date'];
        $product->latest_fomula = $data['latest_fomula'];
        //var_dump($product->sales_date);

        if(!$this->Products->save($product)){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $this->loadModel('Evaluations');
        $this->loadModel('EvaluationItems');
        if($product->evaluations == null){
            $evaluation = $this->Evaluations->newEntity();
            $evaluation->product_id = $product->id;
        }else{
            $evaluation = $product->evaluations[0];
        }

        $evaluation->compared_product_name = $data['compared_product_name'];
        $evaluation->compared_model_number = $data['compared_model_number'];
        $evaluation->completed == 0;
        
        $evaluation = $this->Evaluations->save($evaluation);
        if(!$evaluation){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $evalId = $evaluation->id;
        $this->EvaluationItems->deleteAll(['evaluation_id' => $evalId]);

        foreach ($data['selected'] as $key => $value) {
            $this->_createEvaluationItem(
                $evalId,
                $key,
                isset($data['units'][$key]) ? $data['units'][$key] : null,
                isset($data['new_value'][$key]) ? $data['new_value'][$key] : null,
                isset($data['old_value'][$key]) ? $data['old_value'][$key] : null
            );
        }

        $product = $this->Products->get($product->id, ['contain' => ['Evaluations' => ['EvaluationItems'], 'Types']]);
        return $product;
    }

    private function _createEvaluationItem($evalId, $evalHeadId, $unit, $newValue, $oldValue){

        $this->loadModel('EvaluationItems');

        $evaluationItem = $this->EvaluationItems->find()
            ->where(['evaluation_id' => $evalId])
            ->where(['head_id' => $evalHeadId])
            ->first();

        if($evaluationItem == null)
            $evaluationItem = $this->EvaluationItems->newEntity();

        $evaluationItem->evaluation_id = $evalId;
        $evaluationItem->head_id = $evalHeadId;
        $evaluationItem->unit_id = $unit;
        $evaluationItem->value = $newValue;
        $evaluationItem->compared_value = $oldValue;

        if(!$this->EvaluationItems->save($evaluationItem)){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

    }

    public function save($id = null){
        $data = $this->request->data;
        $product = $this->_saveData($id, $data);
        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $this->Flash->success(__('製品情報が保存されました'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }


    public function submit($id = null){
        $data = $this->request->data;
        $product = $this->_saveData($id, $data);
        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        if(!$this->_validateProductEvaluation($product)){
            $this->Flash->error(__('必須項目が入力されていません。入力項目を確認してください。'));
            return $this->redirect(['controller' => 'Products', 'action' => 'edit', $product->id]);
        }

        $product->evaluations[0]->completed = 1;
        $this->loadModel('Evaluations');
        $this->Evaluations->save($product->evaluations[0]);

        return $this->redirect(['controller' => 'Products', 'action' => 'view', $product->id]);

    }

    private function _scoring($evaluationItems){
        $this->loadModel('EvaluationHeads');
        $evaluationHeads = $this->EvaluationHeads->find()->all()->toArray();

        foreach ($evaluationHeads as $evaluationHead) {
            $answers[$evaluationHead->large_type][$evaluationHead->small_type]['count'] = 0;
            $answers[$evaluationHead->large_type][$evaluationHead->small_type]['value'] = 0;
        }

        foreach ($evaluationItems as $evaluationItem){
            $evaluationHead = $evaluationItem->evaluation_head;
            $answers[$evaluationHead->large_type][$evaluationHead->small_type]['value'] += $this->_evaluateValues($evaluationHead->id, $evaluationItem->value, $evaluationItem->compared_value)['point'];
            $answers[$evaluationHead->large_type][$evaluationHead->small_type]['count'] += 1;
        }

        $scores = null;
        foreach ($answers as $key => $answer) {
            $sum = 0;
            $count = 0;
            foreach ($answer as $itemKey => $item) {
                $sum += $item['value'];
                $count += $item['count'] != 0 ? $item['count'] : 1;
            }
            $scores[$key] = $sum / ($count == 0 ? 1: $count);
        }

        return $scores;
    }

    public function register($id = null){
        $data = $this->request->data;
        $product = $this->Products->get($id, [
            'contain' => ['Companies', 'Types', 'Evaluations']
        ]);

        $this->set('product', $product);

        $this->loadModel('Types');
        $types = $this->Types->find()->all();
        $this->set('types', $types->toArray());

        $evaluation_type = isset($product->compared_product_name) && isset($product->compared_model_number);
        $this->set('evaluation_type', $evaluation_type);
    }

    public function publish($id = null){
        $data = $this->request->data;
        $product = $this->Products->get($id);
        $product->published = 1;
        if($this->Products->save($product)){
            $this->Flash->success(__('製品情報が更新されました'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }else{
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
    }

    public function unpublish($id = null)
    {
        $product = $this->Products->get($id);
        $product->published = 0;
        $this->Products->save($product);
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    public function delete($id = null)
    {
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('製品情報が削除されました'));
        } else {
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
        }
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    public function createPdf($id = null)
    {
        $product = $this->Products->get($id, ['contain' => ['Companies', 'Types', 'Evaluations']]);
        $product_info = $this->request->data['product_info'];
        $product->product_comment = $product_info;
        $product = $this->Products->save($product);
        $this->set('product', $product);

        $reported = $this->request->data['reported'];
        foreach ($reported as $key => $value) {
            $keyArr[] = $key;
        }
        $this->loadModel('EvaluationHeads');
        $evaluationHeads = $this->EvaluationHeads->find()->where(['id IN' => $keyArr ])->all()->toArray();
        $this->set('evaluationHeads', $evaluationHeads);


        $this->response->type('pdf');
        $this->response->charset('UTF-8');
        $this->response->download('receipt.pdf');
        $this->viewBuilder()->layout(false);
    }

    public function downloadCsv($id){

        $product = $this->Products->get($id, ['contain' => ['Types', 'Evaluations' => ['EvaluationItems' => [ 'Units','EvaluationHeads' => ['Allocations' => ['AllocationItems'] ] ] ] ] ]);

        if(!isset($product->evaluations[0])){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $filename = "評価データ_".$product->product_name."_".date('Ymd');
        $this->set('filename', $filename);

        $header = ['大分類', '中分類', '小分類', '項目', '単位', '値', '比較値'];
        $this->set('header', $header);

        foreach ($product->evaluations[0]->evaluation_items as $key => $evaluationItem) {

            $evaluationHead = $evaluationItem->evaluation_head;
            $unit = $evaluationItem->unit;
            $allocation = $evaluationHead->allocation;
            $allocationType = $allocation->allocation_type;
            
            $value = '';
            $comparedValue = '';
            if($allocationType != 0){
                $value = $evaluationItem->value;
                $comparedValue = $evaluationItem->compared_value;
            }else{
                $allocationItems = $allocation->allocation_items;
                foreach ($allocationItems as $allocationItem) {
                    if($allocationItem->id == $evaluationItem->value){
                        $value = $allocationItem->text;
                    }
                    if($allocationItem->id == $evaluationItem->compared_value){
                        $comparedValue = $allocationItem->text;
                    }
                }
            }

            $buffer['large_type'] = $evaluationHead->large_type;
            $buffer['medium_type'] = $evaluationHead->medium_type;
            $buffer['small_type'] = $evaluationHead->small_type;
            $buffer['item_description'] = $evaluationHead->item_description;
            $buffer['unit'] = !is_null($unit) ? $unit->name : '';
            $buffer['value'] = $value;
            $buffer['compared_value'] = $comparedValue;
            $data[] = $buffer;
        }
        $this->set('data', $data);

        $this->viewBuilder()->layout(false);
    }
}
