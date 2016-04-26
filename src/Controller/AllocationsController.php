<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Allocations Controller
 *
 * @property \App\Model\Table\AllocationsTable $Allocations
 */
class AllocationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $allocations = $this->paginate($this->Allocations);

        $this->set(compact('allocations'));
        $this->set('_serialize', ['allocations']);
    }

    /**
     * View method
     *
     * @param string|null $id Allocation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allocation = $this->Allocations->get($id, [
            'contain' => ['AllocationItems', 'EvaluationHeads', 'FomulaHeads']
        ]);

        $this->set('allocation', $allocation);
        $this->set('_serialize', ['allocation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allocation = $this->Allocations->newEntity();
        if ($this->request->is('post')) {
            $allocation = $this->Allocations->patchEntity($allocation, $this->request->data);
            if ($this->Allocations->save($allocation)) {
                $this->Flash->success(__('The allocation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allocation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allocation'));
        $this->set('_serialize', ['allocation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Allocation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allocation = $this->Allocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allocation = $this->Allocations->patchEntity($allocation, $this->request->data);
            if ($this->Allocations->save($allocation)) {
                $this->Flash->success(__('The allocation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allocation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allocation'));
        $this->set('_serialize', ['allocation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Allocation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allocation = $this->Allocations->get($id);
        if ($this->Allocations->delete($allocation)) {
            $this->Flash->success(__('The allocation has been deleted.'));
        } else {
            $this->Flash->error(__('The allocation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
