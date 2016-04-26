<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AllocationItems Controller
 *
 * @property \App\Model\Table\AllocationItemsTable $AllocationItems
 */
class AllocationItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Allocations']
        ];
        $allocationItems = $this->paginate($this->AllocationItems);

        $this->set(compact('allocationItems'));
        $this->set('_serialize', ['allocationItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Allocation Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allocationItem = $this->AllocationItems->get($id, [
            'contain' => ['Allocations']
        ]);

        $this->set('allocationItem', $allocationItem);
        $this->set('_serialize', ['allocationItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allocationItem = $this->AllocationItems->newEntity();
        if ($this->request->is('post')) {
            $allocationItem = $this->AllocationItems->patchEntity($allocationItem, $this->request->data);
            if ($this->AllocationItems->save($allocationItem)) {
                $this->Flash->success(__('The allocation item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allocation item could not be saved. Please, try again.'));
            }
        }
        $allocations = $this->AllocationItems->Allocations->find('list', ['limit' => 200]);
        $this->set(compact('allocationItem', 'allocations'));
        $this->set('_serialize', ['allocationItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Allocation Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allocationItem = $this->AllocationItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allocationItem = $this->AllocationItems->patchEntity($allocationItem, $this->request->data);
            if ($this->AllocationItems->save($allocationItem)) {
                $this->Flash->success(__('The allocation item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allocation item could not be saved. Please, try again.'));
            }
        }
        $allocations = $this->AllocationItems->Allocations->find('list', ['limit' => 200]);
        $this->set(compact('allocationItem', 'allocations'));
        $this->set('_serialize', ['allocationItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Allocation Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allocationItem = $this->AllocationItems->get($id);
        if ($this->AllocationItems->delete($allocationItem)) {
            $this->Flash->success(__('The allocation item has been deleted.'));
        } else {
            $this->Flash->error(__('The allocation item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
