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
    }    

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Company', 'Types']
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
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


    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Company', 'Types', 'Evaluations']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel("Types");
        $types = $this->Types->find();
        $this->set('types', $types);

        $this->_setEvaluationHeads();
        $this->_setUnitMap();

    }

    private function _setEvaluationHeads(){
        $this->loadModel("EvaluationHeads");
        $evaluationHeads = $this->EvaluationHeads->find('all')->contain(['Allocations' => ['AllocationItems']]);

        foreach ($evaluationHeads as $evaluationHead) {
            $evaluationHeadsMap[$evaluationHead->large_type][] = $evaluationHead;
        }
        $this->set('evaluationHeadsMap', $evaluationHeadsMap);
    }

    public function evaluate(){

        $id = $this->request->data['id'];

        $json = json_encode(['id' => $id ,'data' => ['result' => 'OK', 'point' => 'OK' ]]);
        echo $json;

        $this->autoRender = false;
    }


    public function save(){
        $this->Flash->success(__('Product has been saved.'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    public function submit(){
        $this->Flash->success(__('Product has been submitted.'));
        return $this->redirect(['controller' => 'Companies', 'action' => 'view']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $company = $this->Products->Company->find('list', ['limit' => 200]);
        $types = $this->Products->Types->find('list', ['limit' => 200]);
        $this->set(compact('product', 'company', 'types'));
        $this->set('_serialize', ['product']);
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
