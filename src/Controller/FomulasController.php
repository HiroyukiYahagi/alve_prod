<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fomulas Controller
 *
 * @property \App\Model\Table\FomulasTable $Fomulas
 */
class FomulasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Company']
        ];
        $fomulas = $this->paginate($this->Fomulas);

        $this->set(compact('fomulas'));
        $this->set('_serialize', ['fomulas']);
    }

    /**
     * View method
     *
     * @param string|null $id Fomula id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fomula = $this->Fomulas->get($id, [
            'contain' => ['Company', 'FomulaItems']
        ]);

        $this->set('fomula', $fomula);
        $this->set('_serialize', ['fomula']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fomula = $this->Fomulas->newEntity();
        if ($this->request->is('post')) {
            $fomula = $this->Fomulas->patchEntity($fomula, $this->request->data);
            if ($this->Fomulas->save($fomula)) {
                $this->Flash->success(__('The fomula has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fomula could not be saved. Please, try again.'));
            }
        }
        $company = $this->Fomulas->Company->find('list', ['limit' => 200]);
        $this->set(compact('fomula', 'company'));
        $this->set('_serialize', ['fomula']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fomula id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fomula = $this->Fomulas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fomula = $this->Fomulas->patchEntity($fomula, $this->request->data);
            if ($this->Fomulas->save($fomula)) {
                $this->Flash->success(__('The fomula has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fomula could not be saved. Please, try again.'));
            }
        }
        $company = $this->Fomulas->Company->find('list', ['limit' => 200]);
        $this->set(compact('fomula', 'company'));
        $this->set('_serialize', ['fomula']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fomula id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fomula = $this->Fomulas->get($id);
        if ($this->Fomulas->delete($fomula)) {
            $this->Flash->success(__('The fomula has been deleted.'));
        } else {
            $this->Flash->error(__('The fomula could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
