<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EvaluationHeads Controller
 *
 * @property \App\Model\Table\EvaluationHeadsTable $EvaluationHeads
 */
class EvaluationHeadsController extends AppController
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
        $evaluationHeads = $this->paginate($this->EvaluationHeads);

        $this->set(compact('evaluationHeads'));
        $this->set('_serialize', ['evaluationHeads']);
    }

    /**
     * View method
     *
     * @param string|null $id Evaluation Head id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evaluationHead = $this->EvaluationHeads->get($id, [
            'contain' => ['Allocations']
        ]);

        $this->set('evaluationHead', $evaluationHead);
        $this->set('_serialize', ['evaluationHead']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evaluationHead = $this->EvaluationHeads->newEntity();
        if ($this->request->is('post')) {
            $evaluationHead = $this->EvaluationHeads->patchEntity($evaluationHead, $this->request->data);
            if ($this->EvaluationHeads->save($evaluationHead)) {
                $this->Flash->success(__('The evaluation head has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evaluation head could not be saved. Please, try again.'));
            }
        }
        $allocations = $this->EvaluationHeads->Allocations->find('list', ['limit' => 200]);
        $this->set(compact('evaluationHead', 'allocations'));
        $this->set('_serialize', ['evaluationHead']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evaluation Head id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evaluationHead = $this->EvaluationHeads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evaluationHead = $this->EvaluationHeads->patchEntity($evaluationHead, $this->request->data);
            if ($this->EvaluationHeads->save($evaluationHead)) {
                $this->Flash->success(__('The evaluation head has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evaluation head could not be saved. Please, try again.'));
            }
        }
        $allocations = $this->EvaluationHeads->Allocations->find('list', ['limit' => 200]);
        $this->set(compact('evaluationHead', 'allocations'));
        $this->set('_serialize', ['evaluationHead']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evaluation Head id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evaluationHead = $this->EvaluationHeads->get($id);
        if ($this->EvaluationHeads->delete($evaluationHead)) {
            $this->Flash->success(__('The evaluation head has been deleted.'));
        } else {
            $this->Flash->error(__('The evaluation head could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
