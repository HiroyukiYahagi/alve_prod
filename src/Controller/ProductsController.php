<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{

    public function beforeFilter(Event $event){
        // 上位クラスの機能を使用
        parent::beforeFilter($event);
        // ユーザーによるログアウトを許可する
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
            $this->Flash->error(__('Invalid Access'));
            $this->redirect(['controller' => 'Top', 'action' => 'index']);
        }
    }


    public function search()
    {
        $this->loadModel("Types");
        $types = $this->Types->find();
        $this->set('types', $types);

        $data = $this->request->query;
        if ($this->request->is('get') && isset($data['condition'])) {
            $products = $this->Products->findByConditions($data['condition'], isset($data['options'])? $data['options'] : null );
            $this->set('products', $products);            
        }

        $this->viewBuilder()->layout(false);

    }

    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Companies', 'Types', 'Evaluations']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
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

    public function edit($id = null)
    {
        $this->loadModel("Types");
        $types = $this->Types->find();
        $this->set('types', $types);

        $this->_setEvaluationHeads();
        $this->_setUnitMap();

        if($id == null){
            $this->set('title', __('New Product'));
        }else{
            $this->set('title', __('Edit Product'));
            $product = $this->Products->get($id, [
                'contain' => ['Types', 'Evaluations' => [ 'EvaluationItems' => ['Units'] ] ]
            ]);
            $this->set('product', $product);
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
                    return ['result' => round($rate,1), 'point' => $candidate->point];
                }
            }
        }
        return ['result' => $rate, 'point' => '0'];
    }

    private function _valueEvaluation($newValue, $candidates){
        foreach ($candidates as $candidate) {
            if($newValue == $candidate->id){
                return ['result' => '-', 'point' => $candidate->point];
                
            }
        }
        return ['result' => '-', 'point' => '-'];
    }

    private function _validateProductEvaluation($data){
        if ($article->errors()) {
            foreach ($article->errors() as $key => $error) {
                $this->Flash->error(__('Error:').$error);
            }
            return false;
        }
        return true;
    }

    private function _saveData($data){
        $companyId = $this->getAuthedUserId();
        if(!isset($data['id'])){
            $product = $this->Products->newEntity();
            $product->company_id = $companyId;
        }else{
            $id = $data['id'];
            $product = $this->Products->get($id, ['contain' => ['Evaluations' => ['EvaluationItems'], 'Types']]);
        }
        $product = $this->Products->patchEntity($product,$data);

        if(!$this->Products->save($product)){
            $this->Flash->error(__('Server Error'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $this->loadModel('Evaluations');
        if($product->evaluations == null){
            $evaluation = $this->Evaluations->newEntity();
            $evaluation->product_id = $product->id;
        }else{
            $evaluation = $product->evaluations[0];
        }

        $evaluation->compared_product_name = $data['compared_product_name'];
        $evaluation->compared_model_number = $data['compared_model_number'];
        $evaluation->completed == 0;
        
        if(!$this->Evaluations->save($evaluation)){
            $this->Flash->error(__('Server Error'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $evalId = $evaluation->id;
        foreach ($data['selected'] as $key => $value) {
            $this->_createEvaluationItem(
                $evalId,
                $key,
                isset($data['units'][$key]) ? $data['units'][$key] : null,
                isset($data['new_value'][$key]) ? $data['new_value'][$key] : null,
                isset($data['old_value'][$key]) ? $data['old_value'][$key] : null
            );
        }

        $product = $this->Products->get($id, ['contain' => ['Evaluations' => ['EvaluationItems'], 'Types']]);
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
            $this->Flash->error(__('Server Error'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }   

    }

    public function save(){
        $data = $this->request->data;
        $product = $this->_saveData($data);
        if($product == null){
            $this->Flash->error(__('Invalid Access.'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $this->Flash->success(__('Product has been saved.'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }


    public function submit(){
        $data = $this->request->data;
        $product = $this->_saveData($data);
        if($product == null){
            $this->Flash->error(__('Invalid Access.'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        if(!$this->_validateProductEvaluation($data)){
            $this->Flash->error(__('Not completed.'));
            return $this->redirect(['controller' => 'Products', 'action' => 'edit'], $product->id);
        }

        $product = $this->Products->get($id, ['contain' => ['Evaluations' => ['EvaluationItems' => ['EvaluationHeads'] ], 'Types']] );
        $this->set('product', $product);

        //set answer
        $answers = $this->_setEvaluationHeads();
        $this->set('answersMap', $answers);

        //set results
        $results = [
            '省エネルギー' => '2',
            'リデュース' => '3',
            'リユース' => '2.5',
            'リサイクル' => '3',
            '環境・安全' => '1',
            '情報提供' => '0',
            '情報提供' => '-1'
        ];
        $this->set('results', $results);

        $this->render('view');
    }

    public function register(){
        $data = $this->request->data;
        $id = $data['id'];

        $product = $this->Products->get($id, [
            'contain' => ['Companies', 'Types', 'Evaluations']
        ]);
        $this->set('product', $product);

        $this->loadModel('Types');
        $types = $this->Types->find()->all();
        $this->set('types', $types->toArray());

        if(isset($data['status'])){
            $evaluation_type = $data['evaluation_type'];
            $this->set('evaluation_type', $evaluation_type);
            $this->render('confirm');
        }

    }

    public function publish(){
        $data = $this->request->data;
        $id = $data['id'];
        $product = $this->Products->get($id);
        $product->published = 1;
        if($this->Products->save($product)){
            $this->Flash->success(__('Successfully Published'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }else{
            $this->Flash->error(__('Please Inform Administrator'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
