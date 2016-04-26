<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FomulaItems Controller
 *
 * @property \App\Model\Table\FomulaItemsTable $FomulaItems
 */
class FomulaItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fomulas', 'FomulaHeads', 'Units']
        ];
        $fomulaItems = $this->paginate($this->FomulaItems);

        $this->set(compact('fomulaItems'));
        $this->set('_serialize', ['fomulaItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Fomula Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fomulaItem = $this->FomulaItems->get($id, [
            'contain' => ['Fomulas', 'FomulaHeads', 'Units']
        ]);

        $this->set('fomulaItem', $fomulaItem);
        $this->set('_serialize', ['fomulaItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fomulaItem = $this->FomulaItems->newEntity();
        if ($this->request->is('post')) {
            $fomulaItem = $this->FomulaItems->patchEntity($fomulaItem, $this->request->data);
            if ($this->FomulaItems->save($fomulaItem)) {
                $this->Flash->success(__('The fomula item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fomula item could not be saved. Please, try again.'));
            }
        }
        $fomulas = $this->FomulaItems->Fomulas->find('list', ['limit' => 200]);
        $fomulaHeads = $this->FomulaItems->FomulaHeads->find('list', ['limit' => 200]);
        $units = $this->FomulaItems->Units->find('list', ['limit' => 200]);
        $this->set(compact('fomulaItem', 'fomulas', 'fomulaHeads', 'units'));
        $this->set('_serialize', ['fomulaItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fomula Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fomulaItem = $this->FomulaItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fomulaItem = $this->FomulaItems->patchEntity($fomulaItem, $this->request->data);
            if ($this->FomulaItems->save($fomulaItem)) {
                $this->Flash->success(__('The fomula item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fomula item could not be saved. Please, try again.'));
            }
        }
        $fomulas = $this->FomulaItems->Fomulas->find('list', ['limit' => 200]);
        $fomulaHeads = $this->FomulaItems->FomulaHeads->find('list', ['limit' => 200]);
        $units = $this->FomulaItems->Units->find('list', ['limit' => 200]);
        $this->set(compact('fomulaItem', 'fomulas', 'fomulaHeads', 'units'));
        $this->set('_serialize', ['fomulaItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fomula Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fomulaItem = $this->FomulaItems->get($id);
        if ($this->FomulaItems->delete($fomulaItem)) {
            $this->Flash->success(__('The fomula item has been deleted.'));
        } else {
            $this->Flash->error(__('The fomula item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
