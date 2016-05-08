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
        $this->Auth->allow(['login', 'logout', 'register']);

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
        $completedProducts = null;
        $editingProducts = null;
        foreach ($company->products as $product) {
            if($product->published == 1){
                $publishedProducts[] = $product;
            }else if(isset($product->evaluations[0]) && $product->evaluations[0]->completed == 1 ){
                $completedProducts[] = $product;
            }else{
                $editingProducts[] = $product;
            }

        }

        $this->set('publishedProducts', $publishedProducts);
        $this->set('completedProducts', $completedProducts);
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


    public function register(){
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $company = $this->Companies->newEntity();
            $company->email = $data['email'];
            $company->password = $data['password'];
            if ($this->Companies->save($company)) {
                //$this->_sendRegisterMail($company);
                //$this->Flash->success(__('入力されたメールアドレスに初期パスワードが送信されました'));
                $this->Flash->success(__('新規登録されました'));
                return $this->redirect(['action' => 'login']);
            }else{
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            }
        }
    }

    public function test(){
        //$this->_sendMail("yahagi1989@gmail.com", "testmail", "test messages");
        
    }

    private function _sendRegisterMail($company){
        $defaultPassword = $this->_makeRandStr(10);
        $company->password = $defaultPassword;
        $this->Companies->save($company);
        $email = $company->email;

        $message = <<< EOF
この度は環境配慮バルブ登録システムに新規登録いただきありがとうございます。

----------------------------------
登録情報
----------------------------------
ユーザ名(メールアドレス): $email
一時パスワード: $defaultPassword

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
            $company = $this->Companies->patchEntity($company, $this->request->data);
            $result = $this->Companies->save($company);
            //var_dump($result);
            if ($result) {
                $this->Flash->success(__('会社情報が更新されました'));
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
                $this->Flash->success(__('パスワードが更新されました。'));
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
