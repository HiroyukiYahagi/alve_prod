<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EvaluationItems Controller
 *
 * @property \App\Model\Table\EvaluationItemsTable $EvaluationItems
 */
class EvaluationItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Evaluations', 'EvaluationHeads', 'Units']
        ];
        $evaluationItems = $this->paginate($this->EvaluationItems);

        $this->set(compact('evaluationItems'));
        $this->set('_serialize', ['evaluationItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Evaluation Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evaluationItem = $this->EvaluationItems->get($id, [
            'contain' => ['Evaluations', 'EvaluationHeads', 'Units']
        ]);

        $this->set('evaluationItem', $evaluationItem);
        $this->set('_serialize', ['evaluationItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evaluationItem = $this->EvaluationItems->newEntity();
        if ($this->request->is('post')) {
            $evaluationItem = $this->EvaluationItems->patchEntity($evaluationItem, $this->request->data);
            if ($this->EvaluationItems->save($evaluationItem)) {
                $this->Flash->success(__('The evaluation item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evaluation item could not be saved. Please, try again.'));
            }
        }
        $evaluations = $this->EvaluationItems->Evaluations->find('list', ['limit' => 200]);
        $evaluationHeads = $this->EvaluationItems->EvaluationHeads->find('list', ['limit' => 200]);
        $units = $this->EvaluationItems->Units->find('list', ['limit' => 200]);
        $this->set(compact('evaluationItem', 'evaluations', 'evaluationHeads', 'units'));
        $this->set('_serialize', ['evaluationItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evaluation Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evaluationItem = $this->EvaluationItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluationItem = $this->EvaluationItems->patchEntity($evaluationItem, $this->request->data);
            if ($this->EvaluationItems->save($evaluationItem)) {
                $this->Flash->success(__('The evaluation item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evaluation item could not be saved. Please, try again.'));
            }
        }
        $evaluations = $this->EvaluationItems->Evaluations->find('list', ['limit' => 200]);
        $evaluationHeads = $this->EvaluationItems->EvaluationHeads->find('list', ['limit' => 200]);
        $units = $this->EvaluationItems->Units->find('list', ['limit' => 200]);
        $this->set(compact('evaluationItem', 'evaluations', 'evaluationHeads', 'units'));
        $this->set('_serialize', ['evaluationItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evaluation Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evaluationItem = $this->EvaluationItems->get($id);
        if ($this->EvaluationItems->delete($evaluationItem)) {
            $this->Flash->success(__('The evaluation item has been deleted.'));
        } else {
            $this->Flash->error(__('The evaluation item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
