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

    private function _setEvaluationHeadsDetailByTypeId($type_id){
        $this->loadModel("TypeHeadRelations");
        $typeHeadRelations = $this->TypeHeadRelations->find()->where(['type_id' => $type_id])->contain(['EvaluationHeads' => [ 'Allocations' => ['AllocationItems']]])->all()->toArray();

        foreach ($typeHeadRelations as $typeHeadRelation) {
            $evaluationHead = $typeHeadRelation->evaluation_head;
            $evaluationHeadsMap[$evaluationHead->large_type][$evaluationHead->medium_type.' - '.$evaluationHead->small_type][] = $evaluationHead;
        }

        $this->set('evaluationHeadsMap', isset($evaluationHeadsMap)? $evaluationHeadsMap : null );
        return $evaluationHeadsMap;        
    }

    public function selectType($id = null)
    {
        $this->loadModel("Types");
        $types = $this->Types->find();
        $this->set('types', $types);

        if($id != null){
            $product = $this->Products->get($id, [
                'contain' => ['Types']]);
            $this->set('product', $product);
        }
    }

    public function edit($id = null)
    {
        $this->_setUnitMap();

        if($id == null){
            $this->set('title', __('製品評価'));

            if(!isset($this->request->data['type_id'])){
                $this->Flash->error(__('製品種別を選択してください'));
                return $this->redirect($this->referer());
            }
            $type_id = $this->request->data['type_id'];

        }else{
            $this->set('title', __('製品評価の編集'));
            $product = $this->Products->get($id, [
                'contain' => ['Types', 'Evaluations' => [ 'EvaluationItems' => ['Units'] ] ]
            ]);
            $this->set('product', $product);

            if(isset($this->request->data['type_id'])){
                $type_id = $this->request->data['type_id'];
            }else{
                $type_id = $product->type_id;
            }

            $selectedUnits=null;
            $selectedValues=null;
            $selectedCompValues=null;
            $selectedOptValues=null;
            foreach ($product->evaluations[0]->evaluation_items as $evaluation_item) {
                $selectedUnits[$evaluation_item->head_id] = $evaluation_item->unit_id;
                $selectedValues[$evaluation_item->head_id] = $evaluation_item->value;
                $selectedCompValues[$evaluation_item->head_id] = $evaluation_item->compared_value;
                $selectedOptValues[$evaluation_item->head_id] = $evaluation_item->other_unit;
            }

            $this->set('selectedUnits', $selectedUnits);
            $this->set('selectedValues', $selectedValues);
            $this->set('selectedCompValues', $selectedCompValues);
            $this->set('selectedOptValues', $selectedOptValues);
        }

        $this->loadModel("Types");
        $type = $this->Types->get($type_id);
        $this->set('type', $type);

        $companyId = $this->getAuthedUserId();
        $this->loadModel('Fomulas');
        $fomulas = $this->Fomulas->find()->where(['company_id' => $companyId])->where(['completed' => 1])->order(['modified'=>'DESC'])->all()->toArray();
        if(isset($fomulas[0])){
            $fomulaDate = $fomulas[0]->modified;
            $this->set('fomulaDate', $fomulaDate);
        }

        $this->_setEvaluationHeadsDetailByTypeId($type_id);
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
            if($candidate->range_max === null || $candidate->range_max > $rate ){
                if($candidate->range_min === null || $candidate->range_min <= $rate ){

                    if($rate == 0){
                        return ['result' => round($rate, 1), 'point' => '0'];
                    }else{
                        return ['result' => round($rate, 1), 'point' => $candidate->point];
                        //return ['result' => $candidate->range_max, 'point' => $candidate->range_min];
                    }
                }
            }
        }
        return ['result' => round($rate, 1), 'point' => '-1'];
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

        if(count($data) == 0){
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

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
        $evaluation->compared_url = $data['compared_url'];
        $evaluation->compared_sales_date = $data['compared_sales_date'];
        $evaluation->completed == 0;
        
        $evaluation = $this->Evaluations->save($evaluation);
        if(!$evaluation){
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        $evalId = $evaluation->id;
        $this->EvaluationItems->deleteAll(['evaluation_id' => $evalId]);

        if(isset($data['selected'])){
            foreach ($data['selected'] as $key => $value) {
                $this->_createEvaluationItem(
                    $evalId,
                    $key,
                    isset($data['units'][$key]) ? $data['units'][$key] : null,
                    isset($data['new_value'][$key]) ? $data['new_value'][$key] : null,
                    isset($data['old_value'][$key]) ? $data['old_value'][$key] : null,
                    isset($data['other_unit'][$key]) ? $data['other_unit'][$key] : null
                );
            }
        }

        $product = $this->Products->get($product->id, ['contain' => ['Evaluations' => ['EvaluationItems'], 'Types']]);
        return $product;
    }

    private function _createEvaluationItem($evalId, $evalHeadId, $unit, $newValue, $oldValue, $option){

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
        $evaluationItem->other_unit = $option;

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

        $this->_changeCompleted($product->evaluations[0], false);

        $this->Flash->success(__('製品情報が保存されました'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }


    public function submit($id = null){
        $data = $this->request->data;
        //var_dump($data);

        $product = $this->_saveData($id, $data);
        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        if(!$this->_validateProductEvaluation($product)){
            $this->_changeCompleted($product->evaluations[0], false);
            $this->Flash->error(__('必須項目が入力されていません。入力項目を確認してください。'));
            return $this->redirect(['controller' => 'Products', 'action' => 'edit', $product->id]);
        }

        $this->_changeCompleted($product->evaluations[0], true);

        //return $this->redirect(['controller' => 'Products', 'action' => 'register', $product->id]);
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

    private function _savaAdvancedData($product, $data){
        if(isset($data['register_date']) && strlen($data['register_date']) ){
            $product->register_date = $data['register_date'];
        }
        if(isset($data['register_update_date']) && strlen($data['register_update_date']) ){
            $product->register_update_date = $data['register_update_date'];
        }
        $this->Products->save($product);
    }

    public function register($id = null){
        $product = $this->Products->get($id, ['contain' => ['Companies', 'Evaluations' => ['EvaluationItems'], 'Types']]);
        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        if(!$this->_validateProductEvaluation($product)){
            $this->_changeCompleted($product->evaluations[0], false);
            $this->Flash->error(__('必須項目が入力されていません。入力項目を確認してください。'));
            return $this->redirect(['controller' => 'Products', 'action' => 'edit', $product->id]);
        }

        $this->_savaAdvancedData($product, $this->request->data);

        $this->set('product', $product);

        $reported = $this->request->data['reported'];
        foreach ($reported as $key => $value) {
            $keyArr[] = $key;
        }
        $this->loadModel('EvaluationHeads');
        $evaluationHeads = $this->EvaluationHeads->find()->where(['id IN' => $keyArr ])->all()->toArray();
        $this->set('evaluationHeads', $evaluationHeads);

        $this->_setEvaluationType($product);
    }

    private function _setEvaluationType($product){
        $evaluation_type = isset($product->evaluations[0]->compared_product_name) && isset($product->evaluations[0]->compared_model_number) && strlen($product->evaluations[0]->compared_product_name);
        $this->set('evaluation_type', $evaluation_type);
    }

    public function confirm($id = null){
        $product = $this->Products->get($id, ['contain' => ['Companies']]);
        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
        $this->set("product", $product);
    }


    private function _checkPublishable($product, $data){
        if(!isset($data['register_name'])){
            return false;
        }else{
            $product->register_name = $data['register_name'];
        }
        if(!isset($data['register_department'])){
            return false;
        }else{
            $product->register_department = $data['register_department'];
        }
        if(!isset($data['register_email'])){
            return false;
        }else{
            $product->register_email = $data['register_email'];
        }
        if(!isset($data['register_tel'])){
            return false;
        }else{
            $product->register_tel = $data['register_tel'];
        }
        return $product;
    }

    private function _sendRegistrationMail($product){
        $this->loadModel('Admins');
        $admins = $this->Admins->find()->all()->toArray();
        foreach ($admins as $key => $admin) {
            $this->__sendEach($admin->email, $product);
        }
    }

    private function __sendEach($email, $product){
        $user = $product->company->user_id;
        $company_name = $product->company->company_name;
        $company_email = $product->company->email;
        $product_name = $product->product_name;
        $register_name = $product->register_name;
        $register_department = $product->register_department;
        $register_email = $product->register_email;
        $operator_email = $product->operator_email;
        $register_tel = $product->register_tel;
        
        $title = "製品が登録されました";
        $message = <<< EOF
環境配慮バルブ登録制度にて以下の製品が登録・更新されました。

----------------------------------
登録情報
----------------------------------
ユーザID: $user
会社名: $company_name
登録製品名: $product_name
登録担当者氏名: $register_name
登録担当者所属・役職: $register_department
登録担当者メールアドレス: $register_email
登録担当者電話番号: $register_tel

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お問合せ先　：　●●●●事務局
　　mail　　：　●●●●●
企画運営　　：　株式会社●●●
Copyright c 2016 ●●●●●. All rights reserved.
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;

        $this->_sendMail($email, $title, $message);
        

        $title = "環境配慮バルブ登録システム確認メッセージ";
        $message = <<< EOF
$company_name 様

この度は環境配慮バルブ登録制度をご利用いただきありがとうございます。
以下の情報で登録・更新されましたのでご確認お願いします。

----------------------------------
登録情報
----------------------------------
ユーザID: $user
登録製品名: $product_name
登録担当者氏名: $register_name
登録担当者所属・役職: $register_department

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お問合せ先　：　●●●●事務局
　　mail　　：　●●●●●
企画運営　　：　株式会社●●●
Copyright c 2016 ●●●●●. All rights reserved.
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;
        if(isset($company_email)){
            $this->_sendMail($company_email, $title, $message);
        }
        if(isset($register_email)){
           $this->_sendMail($register_email, $title, $message);
        }
        if(isset($operator_email)){
            $this->_sendMail($operator_email, $title, $message);
        }
    }

    public function publish($id = null){
        $product = $this->Products->get($id, ['contain' => ['Companies', 'Evaluations' => ['EvaluationItems'], 'Types']]);

        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        if(!$this->_validateProductEvaluation($product)){
            $this->_changeCompleted($product->evaluations[0], false);
            $this->Flash->error(__('必須項目が入力されていません。入力項目を確認してください。'));
            return $this->redirect(['controller' => 'Products', 'action' => 'edit', $product->id]);
        }

        $data = $this->request->data;
        $product = $this->_checkPublishable($product, $data);
        if(!$product){
            $this->Flash->error(__('必須項目が入力されていません。入力項目を確認してください。'));
            return $this->redirect(['controller' => 'Products', 'action' => 'confirm', $product->id]);
        }

        $this->_sendRegistrationMail($product);

        $product->published = 1;

        if(!isset($product->published_date)){
            $product->published_date = new Time('Asia/Tokyo');
        }

        if($this->Products->save($product)){
            return $this->redirect(['action' => 'finished']);
        }else{
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }
    }

    public function finished(){
    }

    private function _changeCompleted($evaluation, $shouldComplete)
    {
        if($shouldComplete)
            $evaluation->completed = 1;
        else
            $evaluation->completed = 0;

        $this->loadModel('Evaluations');
        return $this->Evaluations->save($evaluation);
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
        $product = $this->Products->get($id, ['contain' => ['Companies', 'Types', 'Evaluations' => ['EvaluationItems'] ]]);

        if($product == null){
            $this->Flash->error(__('不正なアクセスです'));
            return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
        }

        if(!$this->_validateProductEvaluation($product)){
            $this->_changeCompleted($product->evaluations[0], false);
            $this->Flash->error(__('必須項目が入力されていません。入力項目を確認してください。'));
            return $this->redirect(['controller' => 'Products', 'action' => 'edit', $product->id]);
        }
        
        $this->set('product', $product);

        $this->set('evaluationHeadsText', $this->request->data['evaluationHeads']);

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

        $this->loadModel('Companies');
        $company = $this->Companies->get($this->getAuthedUserId());
        $companyInfo = [$company->user_id, $company->company_name, $company->name_kana, $company->tel, $company->email, $company->url];
        $this->set('companyInfo', $companyInfo);

        $header = ['大分類', '中分類', '小分類', '項目', '単位', '値', '比較値', '備考'];
        $this->set('header', $header);


        $this->loadModel("Types");
        $type = $this->Types->get($product->type_id, ['contain' => ["TypeHeadRelations" => ['EvaluationHeads'] ] ]);

        foreach ($type->type_head_relations as $key => $type_head_relation) {
            
            $evaluationHead = $type_head_relation->evaluation_head;

            $buffer['large_type'] = $evaluationHead->large_type;
            $buffer['medium_type'] = $evaluationHead->medium_type;
            $buffer['small_type'] = $evaluationHead->small_type;
            $buffer['item_description'] = $evaluationHead->item_description;
            $buffer['unit'] = '';
            $buffer['value'] = '';
            $buffer['compared_value'] = '';
            $buffer['option'] = '';
            $data[$evaluationHead->id] = $buffer;
        }

        $evaluationItems = $product->evaluations[0]->evaluation_items;
        foreach ($evaluationItems as $key => $evaluationItem) {

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
            $buffer['option'] = !is_null($evaluationItem->other_unit)? $evaluationItem->other_unit : '' ;
            $data[$evaluationHead->id] = $buffer;
        }
        $this->set('data', $data);

        $this->viewBuilder()->layout(false);
    }


}
