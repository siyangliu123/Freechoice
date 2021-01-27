<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Announcement Controller
 *
 * @property \App\Model\Table\AnnouncementTable $Announcement
 *
 * @method \App\Model\Entity\Announcement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnnouncementController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->isAllowed($this->Auth->user());
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $announcements = $this->paginate($this->Announcement);
        $this->set(compact('announcements'));
    }

    public function view()
    {
        $announcements = $this->paginate($this->Announcement);
        $this->set(compact('announcements'));
    }

    /**
     * View method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $announcement = $this->Announcement->newEntity();
        if ($this->request->is('post')) {
            $announcement = $this->Announcement->patchEntity($announcement, $this->request->getData());
            $announcement->announcement_date = date("Y-m-d h:i:s");
            if ($this->Announcement->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
        }
        $this->set(compact('announcement'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $announcement = $this->Announcement->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $announcement = $this->Announcement->patchEntity($announcement, $this->request->getData());
            if ($this->Announcement->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
        }
        $this->set(compact('announcement'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $announcement = $this->Announcement->get($id);
        if ($this->Announcement->delete($announcement)) {
            $this->Flash->success(__('The announcement has been deleted.'));
        } else {
            $this->Flash->error(__('The announcement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
