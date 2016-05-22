<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

    public function beforeFilter(Event $event){
        // 上位クラスの機能を使用
        parent::beforeFilter($event);
        // ユーザーによるログアウトを許可する
        $this->Auth->allow(['login', 'logout', 'register', 'resetPassword','test']);

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

        if($this->getAuthedUserId() != $id){
            $this->Flash->error(__('Invalid Access'));
            $this->redirect(['controller' => 'Top', 'action' => 'index']);
        }
    }

    public function view()
    {
        $id = $this->getAuthedUserId();

        $company = $this->Companies->get($id, [
            'contain' => ['Fomulas' => ['FomulaItems'], 'Products' => ['Types', 'Evaluations']]
        ]);

        $publishedProducts = null;
        $editingProducts = null;
        foreach ($company->products as $product) {
            if($product->published == 1){
                $publishedProducts[] = $product;
            }else{
                $editingProducts[] = $product;
            }
        }

        $this->set('publishedProducts', $publishedProducts);
        $this->set('editingProducts', $editingProducts);


        $completedFomulas = null;
        $editingFomulas = null;
        foreach ($company->fomulas as $fomula) {
            if($fomula->completed == 1)
                $completedFomulas[] = $fomula;
            else
                $editingFomulas[] = $fomula;
        }
        $this->set('completedFomulas', $completedFomulas);
        $this->set('editingFomulas', $editingFomulas);

        $this->set('company', $company);
        $this->set('_serialize', ['company']);

    }

    public function login(){
        if ($this->request->is('post')) {
            $company = $this->Auth->identify();
            if ($company) {
                $this->Flash->success(__('ログインしました'));
                $this->Auth->setUser($company);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('メールアドレスかパスワードが間違っています'));
            }
        }
    }

    public function logout(){
        $logoutUrl = $this->Auth->logout();
        $this->redirect($logoutUrl);
    }


    private function register(){
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $company = $this->Companies->newEntity();
            $company->email = $data['email'];
            $company->company_name = $data['company_name'];
            if($this->_exitEmail($company->email) != null){
                $this->Flash->error(__('すでに登録済みのメールアドレスです'));
                return $this->redirect(['action' => 'login']);
            }

            if ($this->Companies->save($company)) {
                $this->_sendRegisterMail($company);
                $this->Flash->success(__('入力されたメールアドレスに初期パスワードが送信されました'));
                return $this->redirect(['action' => 'login']);
            }else{
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            }
        }
    }

    // public function test(){
    //     $this->autoRender = false;
    // }

    private function _sendRegisterMail($company){
        $defaultPassword = $this->_makeRandStr(10);
        $company->password = $defaultPassword;
        $this->Companies->save($company);
        $email = $company->email;
        $company_name = $company->company_name;

        $message = <<< EOF
$company_name 様

この度は環境配慮バルブ登録制度に新規登録いただきありがとうございます。

----------------------------------
登録情報
----------------------------------
ログインID(メールアドレス): $email
初期パスワード: $defaultPassword

*このメールへの返信は必要ありません。
*このメールにお心当たりがない場合は下記連絡先にご連絡いただけると幸いです。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お問合せ先　：　●●●●事務局
　　mail　　：　●●●●●
企画運営　　：　株式会社●●●
Copyright c 2016 ●●●●●. All rights reserved.
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;

        $title = "環境配慮バルブ登録システム新規登録確認メッセージ";
        $this->_sendMail($email, $title, $message);
    }

    private function _exitEmail($email){
        $companies = $this->Companies->find()->where(['email' => $email])->all()->toArray();
        if(count($companies) != 0){
            return $companies;
        }else{
            return null;
        }
    }

    public function resetPassword(){
        if ($this->request->is('post')) {
            if(!isset($this->request->data['email']) || count($this->request->data['email']) <= 0 ){
                $this->Flash->success(__('メールアドレスを入力してください'));
                return $this->redirect(['action' => 'resetPassword']);
            }
            $email = $this->request->data['email'];
            $company = $this->_exitEmail($email)[0];
            if($company != null){
                $this->_sendResetMail($company);
                $this->Flash->success(__('入力されたメールアドレスに新しいパスワードが送信されました'));
            }else{
                $this->Flash->error(__('メールが登録されていません'));
            }
            return $this->redirect(['action' => 'login']);
        }
    }

    private function _sendResetMail($company){
        $defaultPassword = $this->_makeRandStr(10);
        $company->password = $defaultPassword;
        $this->Companies->save($company);
        $email = $company->email;
        $company_name = $company->company_name;

        $message = <<< EOF
$company_name 様

環境配慮バルブ登録制度のパスワードがリセットされました。

----------------------------------
登録情報
----------------------------------
ログインID(メールアドレス): $email
新しいパスワード: $defaultPassword

*このメールへの返信は必要ありません。
*このメールにお心当たりがない場合は下記連絡先にご連絡いただけると幸いです。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お問合せ先　：　●●●●事務局
　　mail　　：　●●●●●
企画運営　　：　株式会社●●●
Copyright c 2016 ●●●●●. All rights reserved.
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;

        $title = "環境配慮バルブ登録システムパスワードリセット確認メッセージ";
        $this->_sendMail($email, $title, $message);
    }


    private function _makeRandStr($length) {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }

    private function _sendMail($toAddress, $title, $message){
        $email = new Email('default');
        $email->to($toAddress)->subject($title)->send($message);
    }

    public function edit($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;

            //メールアドレスの重複チェック
            $sames = $this->_exitEmail($data['email']);
            if( !is_null($sames[0]) && $sames[0]->id != $id ){
                $this->Flash->error(__('入力したメールアドレスはすでに登録されています'));
                return $this->redirect(['action' => 'edit', $id]);
            }

            $company = $this->Companies->patchEntity($company, $data);
            $result = $this->Companies->save($company);
            if ($result) {
                $this->Flash->success(__('会社情報が更新されました'));
                $this->_sendEditedMessage($result);
                return $this->redirect(['action' => 'view']);
            } else {
                foreach ($company->errors() as $key => $value) {
                    $this->Flash->error($key.__(' が無効な値です。入力した値を確認してください。'));   
                }
            }
        }
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
    }

    public function editPassword($id = null){
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if( strlen($data['password']) == 0 || $data['password'] != $data['password-again'] ){
                $this->Flash->error(__('同じ値を入力してください。'));
                return $this->redirect($this->referer());
            }
            $company = $this->Companies->patchEntity($company, $data);
            $result = $this->Companies->save($company);
            if ($result) {
                $this->Flash->success(__('ログイン情報が更新されました。'));
                $this->_sendEditedMessage($result);
                return $this->redirect(['action' => 'view']);
            } else {
                foreach ($company->errors() as $key => $value) {
                    $this->Flash->error($key.__(' が無効な値です。入力した値を確認してください。'));   
                }
            }
        }
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
    }

    private function _sendEditedMessage($company){
        $email = $company->email;
        $company_name = $company->company_name;

        $message = <<< EOF
$company_name 様

環境配慮バルブ登録制度の会社情報が更新されました。

*このメールへの返信は必要ありません。
*このメールにお心当たりがない場合は下記連絡先にご連絡いただけると幸いです。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お問合せ先　：　●●●●事務局
　　mail　　：　●●●●●
企画運営　　：　株式会社●●●
Copyright c 2016 ●●●●●. All rights reserved.
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;

        $title = "環境配慮バルブ登録制度確認メッセージ";
        $this->_sendMail($email, $title, $message);
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('会社情報が削除されました。'));
        } else {
            $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
