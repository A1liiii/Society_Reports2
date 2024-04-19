<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Complaints Controller
 *
 * @property \App\Model\Table\ComplaintsTable $Complaints
 */
class ComplaintsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Complaints->find()
            ->contain(['Parties']);
        $complaints = $this->paginate($query);

        $this->set(compact('complaints'));
    }

    /**
     * View method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $complaint = $this->Complaints->get($id, contain: ['Parties', 'Responses']);
        $this->set(compact('complaint'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complaint = $this->Complaints->newEmptyEntity();
        if ($this->request->is('post')) {
            $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
            $file = $this->request->getUploadedFiles();

            $complaint->evidence = $file['images']->getClientFilename();
            $file['images']->moveTo(WWW_ROOT . 'img' . DS . 'pengaduan' . DS . $complaint->evidence);
            if ($this->Complaints->save($complaint)) {
                $this->Flash->success(__('The complaint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint could not be saved. Please, try again.'));
        }
        $parties = $this->Complaints->Parties->find('list', limit: 200)->all();
        $this->set(compact('complaint', 'parties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $complaint = $this->Complaints->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
            $file = $this->request->getUploadedFiles();

            if(!empty($file['images']->getClientFilename())){
                $complaint->evidence = $file['images']->getClientFilename();
                $file['images']->moveT(WWW_ROOT . 'img' . DS . 'pengaduan' . DS . $complaint->evidence);
            }
            if ($this->Complaints->save($complaint)) {
                $this->Flash->success(__('The complaint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint could not be saved. Please, try again.'));
        }
        $parties = $this->Complaints->Parties->find('list', limit: 200)->all();
        $this->set(compact('complaint', 'parties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complaint = $this->Complaints->get($id);
        $checkresp = $this->Complaints->Responses->find()->where(['complaint_id'=>$id])->count();
        if(empty($checkresp)){
            if ($this->Complaints->delete($complaint)) {
                $this->Flash->success(__('The complaint has been deleted.'));
            } else {
                $this->Flash->error(__('The complaint could not be deleted. Please, try again.'));
            }
        }else{
            $this->Flash->warning(__('Tidak Bisa Dihapus,Sepertinya Kamu Masih Memiliki data Tanggapan, Coba Dicek Kembali'));
        }
        

        return $this->redirect(['action' => 'index']);
    }
}
