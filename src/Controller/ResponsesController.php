<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Responses Controller
 *
 * @property \App\Model\Table\ResponsesTable $Responses
 */
class ResponsesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Responses->find()
            ->contain(['Parties', 'Complaints']);
        $responses = $this->paginate($query);

        $this->set(compact('responses'));
    }

    /**
     * View method
     *
     * @param string|null $id Response id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $response = $this->Responses->get($id, contain: ['Parties', 'Complaints']);
        $this->set(compact('response'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $response = $this->Responses->newEmptyEntity();
        if ($this->request->is('post')) {
            $response = $this->Responses->patchEntity($response, $this->request->getData());
            if ($this->Responses->save($response)) {
                $this->Flash->success(__('The response has been saved.'));

                return $this->redirect(['controller'=>'Complaints','action' => 'view/'.$response->complaint_id]);
            }
            $this->Flash->error(__('The response could not be saved. Please, try again.'));
        }
        $parties = $this->Responses->Parties->find('list', limit: 200)->all();
        $complaints = $this->Responses->Complaints->find('list', limit: 200)->all();
        $this->set(compact('response', 'parties', 'complaints'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Response id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $response = $this->Responses->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $response = $this->Responses->patchEntity($response, $this->request->getData());
            if ($this->Responses->save($response)) {
                $this->Flash->success(__('The response has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The response could not be saved. Please, try again.'));
        }
        $parties = $this->Responses->Parties->find('list', limit: 200)->all();
        $complaints = $this->Responses->Complaints->find('list', limit: 200)->all();
        $this->set(compact('response', 'parties', 'complaints'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Response id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = $this->Responses->get($id);
        if ($this->Responses->delete($response)) {
            $this->Flash->success(__('The response has been deleted.'));
        } else {
            $this->Flash->error(__('The response could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
