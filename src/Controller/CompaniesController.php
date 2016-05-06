<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
    }


    public function view()
    {
        $id = $this->getAuthedUserId();

        $company = $this->Companies->get($id, [
            'contain' => ['Fomulas' => ['FomulaItems'], 'Products' => ['Types', 'Evaluations']]
        ]);

        $completedProducts = null;
        $editingProducts = null;
        foreach ($company->products as $product) {
            if($product->published == 1)
                $completedProducts[] = $product;
            else
                $editingProducts[] = $product;

        }
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
                $this->Flash->success(__('login successful'));
                $this->Auth->setUser($company);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Email or password is incorrect'));
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
                $this->Flash->success(__('register successful'));
                $this->Auth->setUser($company->toArray());
                return $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->Flash->error(__('register error'));
            }
        }
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
                $this->Flash->success(__('The company has been saved.'));
                return $this->redirect(['action' => 'view']);
            } else {
                foreach ($company->errors() as $key => $value) {
                    $this->Flash->error($key.__(' is Invalid.'));   
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
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
