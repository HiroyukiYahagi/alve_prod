<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $components = [
        'Flash',
        'RequestHandler',
        //'Security',
        'Auth' => [
            // ログイン後の画面
           'loginAction'=>[
              'controller'=>'Companies',
              'action'=>'login'
            ],

            'loginRedirect' => [
                'controller' => 'Companies',
                'action' => 'view',
            ],

            // ログアウト後の画面→ログインページへ遷移
            'logoutRedirect' => [
                'controller' => 'Top',
                'action' => 'index',
            ],

            // 認証情報
            'authenticate' => [
                'Form' => [
                    // 使用モデル
                    'userModel' => 'Companies',
                    // フィールド
                    'fields' => [
                        'username' => 'email',
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

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // $this->loadComponent('RequestHandler');
        // $this->loadComponent('Flash');
    }


    public function beforeFilter(Event $event){
      
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        $this->set('isAuth', $this->isAuthed());
    }

    protected function isAdmin(){
        $id = $this->getAuthedUserId();
        $this->loadModule('Company');
        $company = $this->Companies->get($id);
        return ($company->isAdmin == 1);
    }

    protected function isAuthed(){
      if($this->getAuthedUserId() != null)
        return true;
      else
        return false;
    }

    protected function getAuthedUserId(){
        return $this->Auth->user()['id'];
    }

}
