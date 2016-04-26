<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FomulaHeads Controller
 *
 * @property \App\Model\Table\FomulaHeadsTable $FomulaHeads
 */
class FomulaHeadsController extends AppController
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
        $fomulaHeads = $this->paginate($this->FomulaHeads);

        $this->set(compact('fomulaHeads'));
        $this->set('_serialize', ['fomulaHeads']);
    }

    /**
     * View method
     *
     * @param string|null $id Fomula Head id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fomulaHead = $this->FomulaHeads->get($id, [
            'contain' => ['Allocations']
        ]);

        $this->set('fomulaHead', $fomulaHead);
        $this->set('_serialize', ['fomulaHead']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fomulaHead = $this->FomulaHeads->newEntity();
        if ($this->request->is('post')) {
            $fomulaHead = $this->FomulaHeads->patchEntity($fomulaHead, $this->request->data);
            if ($this->FomulaHeads->save($fomulaHead)) {
                $this->Flash->success(__('The fomula head has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fomula head could not be saved. Please, try again.'));
            }
        }
        $allocations = $this->FomulaHeads->Allocations->find('list', ['limit' => 200]);
        $this->set(compact('fomulaHead', 'allocations'));
        $this->set('_serialize', ['fomulaHead']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fomula Head id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fomulaHead = $this->FomulaHeads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fomulaHead = $this->FomulaHeads->patchEntity($fomulaHead, $this->request->data);
            if ($this->FomulaHeads->save($fomulaHead)) {
                $this->Flash->success(__('The fomula head has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fomula head could not be saved. Please, try again.'));
            }
        }
        $allocations = $this->FomulaHeads->Allocations->find('list', ['limit' => 200]);
        $this->set(compact('fomulaHead', 'allocations'));
        $this->set('_serialize', ['fomulaHead']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fomula Head id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fomulaHead = $this->FomulaHeads->get($id);
        if ($this->FomulaHeads->delete($fomulaHead)) {
            $this->Flash->success(__('The fomula head has been deleted.'));
        } else {
            $this->Flash->error(__('The fomula head could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
