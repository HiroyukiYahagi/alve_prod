<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Company Controller
 *
 * @property \App\Model\Table\CompanyTable $Company
 */
class TopController extends AppController
{

    public function beforeFilter(Event $event){
        // 上位クラスの機能を使用
        parent::beforeFilter($event);
        // ユーザーによるログアウトを許可する
        $this->Auth->allow(['index', 'test']);

    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    }

    /**
     * Test method
     *
     * @return \Cake\Network\Response|null
     */
    public function test()
    {
    }

}
