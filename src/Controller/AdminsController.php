<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 */
class AdminsController extends AppController
{

    public $components = [
        'Flash',
        'RequestHandler',
        //'Security',
        'Auth' => [
            // ログイン後の画面
           'loginAction'=>[
              'controller'=>'Admins',
              'action'=>'login'
            ],

            'loginRedirect' => [
                'controller' => 'Admins',
                'action' => 'view',
            ],

            // ログアウト後の画面→ログインページへ遷移
            'logoutRedirect' => [
                'controller' => 'Admins',
                'action' => 'login',
            ],

            // 認証情報
            'authenticate' => [
                'Form' => [
                    // 使用モデル
                    'userModel' => 'Admins',
                    // フィールド
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    // パスワード認証方法
                    'passwordHasher' => [
                        'className' => 'Default',
                    ]
                ]
            ],
        ]
    ];

    public function beforeFilter(Event $event){
        // 上位クラスの機能を使用
        parent::beforeFilter($event);
        // ユーザーによるログアウトを許可する
        $this->Auth->allow(['login', 'logout']);

        $this->viewBuilder()->layout('admin');
    }

    public function index(){
        return $this->redirect(['action' => 'login']);
    }

    public function login(){

        if ($this->request->is('post')) {
            $admin = $this->Auth->identify();
            if ($admin) {
                $this->Flash->success(__('ログインしました'));
                $this->Auth->setUser($admin);
                return $this->redirect(['action' => 'view' , $admin['id']]);
            } else {
                if($this->Admins->find()->count() == 0){
                    $this->_register();
                    $this->Flash->success(__('初回ログインのため管理用ユーザが作成されました。'));
                    return $this->redirect(['action' => 'login']);
                }else{
                    $this->Flash->error(__('ユーザ名かパスワードが間違っています'));
                }
            }
        }
    }

    private function _register(){
        $admin = $this->Admins->newEntity();
        $admin->username = 'admin';
        $admin->password = 'admin';
        $this->Admins->save($admin);
    }

    public function logout(){
        $logoutUrl = $this->Auth->logout();
        $this->redirect($logoutUrl);
    }

    public function view($id = null)
    {
        if(is_null($id)){
            $id = $this->getAuthedUserId();
        }

        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);

        $this->set('admin', $admin);
        $this->set('_serialize', ['admin']);
        
        $this->loadModel('Companies');
        $companies = $this->Companies->find()->all()->toArray();
        $this->set('companies', $companies);
    }

    public function edit($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);

        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->data);
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('管理者情報が編集されました。'));
                return $this->redirect(['action' => 'view', $admin->id]);
            } else {
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            }
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
    }


    public function editCompany($id = null)
    {
        $this->loadModel('Companies');
        $company = $this->Companies->get($id);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $company = $this->Companies->patchEntity($company, $data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('パスワードが更新されました。'));
                $this->_sendAccountInfoMail($company->company_name, $company->email, $data['password']);
                return $this->redirect(['action' => 'view']);
            } else {
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            }
        }
        $this->set('company', $company);
    }


    public function addCompany(){
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->loadModel('Companies');
            $company = $this->Companies->newEntity();
            $company = $this->Companies->patchEntity($company, $data);

            if(!$this->_validateCompany($company)){
                $this->Flash->error(__('全ての項目を入力してください'));
                return $this->redirect(['action' => 'addCompany']);
            }

            if($this->_existEmail($company->email) != null){
                $this->Flash->error(__('すでに登録済みのメールアドレスです'));
                return $this->redirect(['action' => 'view']);
            }
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('新規登録されました'));

                $this->_sendAccountInfoMail($company->company_name, $company->email, $data['password']);

                return $this->redirect(['action' => 'view']);
            }else{
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            }
        }
    }

    private function _validateCompany($company){
        if ( is_null($company->company_name) || strlen($company->company_name) <= 0 ){
            return false;
        }
        if ( is_null($company->name_kana) || strlen($company->name_kana) <= 0 ){
            return false;   
        }
        if ( is_null($company->email) || strlen($company->email) <= 0 ){
            return false;
        }
        if ( is_null($company->password) || strlen($company->password) <= 0 ){
            return false;
        }
        return true;
    }

    private function _existEmail($email){
        $this->loadModel('Companies');
        $companies = $this->Companies->find()->where(['email' => $email])->all()->toArray();
        if(count($companies) != 0){
            return $companies[0];
        }else{
            return null;
        }
    }

    private function _sendAccountInfoMail($company_name, $email, $password){

        $title = "環境配慮バルブ登録システム確認メッセージ";

        $message = <<< EOF
$company_name 様

この度は環境配慮バルブ登録制度をご利用いただきありがとうございます。
以下の情報で登録・更新されましたのでご確認お願いします。

----------------------------------
登録情報
----------------------------------
ログインID(メールアドレス): $email
初期パスワード: $password

*このメールへの返信は必要ありません。
*このメールにお心当たりがない場合は下記連絡先にご連絡いただけると幸いです。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お問合せ先　：　●●●●事務局
　　mail　　：　●●●●●
企画運営　　：　株式会社●●●
Copyright c 2016 ●●●●●. All rights reserved.
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;

        $this->_sendMail($email, $title, $message);
        $this->Flash->success(__('アカウント情報が送信されました'));
    }

    private function _sendMail($toAddress, $title, $message){
        $email = new Email('default');
        $email->to($toAddress)->subject($title)->send($message);
    }


    public function deleteCompany($id = null)
    {
        $this->loadModel('Companies');
        $company = $this->Companies->get($id);
        $this->Companies->delete($company);
        $this->Flash->success(__('会社情報が削除されました。'));
        return $this->redirect(['action' => 'view']);
    }    
}
