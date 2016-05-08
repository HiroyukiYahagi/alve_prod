<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
        $this->Auth->allow(['login']);

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
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('パスワードが更新されました。'));
                return $this->redirect(['action' => 'view']);
            } else {
                $this->Flash->error(__('システムエラーが発生しました。管理者に確認してください。'));
            }
        }
        $this->set('company', $company);
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
