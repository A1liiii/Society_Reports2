<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parties Controller
 *
 * @property \App\Model\Table\PartiesTable $Parties
 */
class PartiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $role = $this->Authentication->getIdentity()->get('role');
        $id = $this->Authentication->getIdentity()->get('id');
        if($role == 'admin'){
            $party = $this->paginate($this->Parties);
        }else if($role == 'officer'){
            $party = $this->paginate($this->Parties->find('all',['conditions'=>['OR'=>['id'=>$id,'role'=>'society']]]));
        }else{
            $party = $this->Parties->find('all',['conditions'=>['id'=>$id]]);
            $party = $this->paginate($party);
        }

        $this->set(compact('party'));
    }

    /**
     * View method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $party = $this->Parties->get($id, contain: ['Complaints', 'Responses']);
        $this->set(compact('party'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $party = $this->Parties->newEmptyEntity();
        if ($this->request->is('post')) {
            $party = $this->Parties->patchEntity($party, $this->request->getData());
            if ($this->Parties->save($party)) {
                $this->Flash->success(__('The party has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The party could not be saved. Please, try again.'));
        }
        $this->set(compact('party'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $party = $this->Parties->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $party = $this->Parties->patchEntity($party, $this->request->getData());
            if ($this->Parties->save($party)) {
                $this->Flash->success(__('The party has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The party could not be saved. Please, try again.'));
        }
        $this->set(compact('party'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $party = $this->Parties->get($id);
        $myid = $this->Authentication->getIdentity()->get('id');
        if($id!=$myid ){
            if ($this->Parties->delete($party)) {
                $this->Flash->success(__('The party has been deleted.'));
            } else {
                $this->Flash->error(__('The party could not be deleted. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('Tidak Bisa Menhapus Akun Diri Sendiri, Hubungi Admin Untuk Informasi Lebih Lanjut'));
        }
        

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login','register']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Complaints',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    // in src/Controller/UsersController.php
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Parties', 'action' => 'login']);
        }
    }
    public function register()
    {
        $party = $this->Parties->newEmptyEntity();
        if ($this->request->is('post')) {
            $party = $this->Parties->patchEntity($party, $this->request->getData());
            if ($this->Parties->save($party)) {
                $this->Flash->success(__('The party has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The party could not be saved. Please, try again.'));
        }
        $this->set(compact('party'));
    }
}
