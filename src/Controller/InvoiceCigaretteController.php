<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * InvoiceCigarette Controller
 *
 * @property \App\Model\Table\InvoiceCigaretteTable $InvoiceCigarette
 *
 * @method \App\Model\Entity\InvoiceCigarette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoiceCigaretteController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->set('authUser', $this->Auth->user());
        $this->isAllowed($this->Auth->user());
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Orders']
        ];
        $invoiceCigarette = $this->paginate($this->InvoiceCigarette);

        $this->set(compact('invoiceCigarette'));
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Cigarette id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceCigarette = $this->InvoiceCigarette->get($id, [
            'contain' => ['Clients', 'Orders']
        ]);

        $this->set('invoiceCigarette', $invoiceCigarette);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoiceCigarette = $this->InvoiceCigarette->newEntity();
        if ($this->request->is('post')) {
            $invoiceCigarette = $this->InvoiceCigarette->patchEntity($invoiceCigarette, $this->request->getData());
            if ($this->InvoiceCigarette->save($invoiceCigarette)) {
                $this->Flash->success(__('The invoice cigarette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice cigarette could not be saved. Please, try again.'));
        }
        $clients = $this->InvoiceCigarette->Clients->find('list', ['limit' => 200]);
        $orders = $this->InvoiceCigarette->Orders->find('list', ['limit' => 200]);
        $this->set(compact('invoiceCigarette', 'clients', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Cigarette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceCigarette = $this->InvoiceCigarette->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceCigarette = $this->InvoiceCigarette->patchEntity($invoiceCigarette, $this->request->getData());
            if ($this->InvoiceCigarette->save($invoiceCigarette)) {
                $this->Flash->success(__('The invoice cigarette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice cigarette could not be saved. Please, try again.'));
        }
        $clients = $this->InvoiceCigarette->Clients->find('list', ['limit' => 200]);
        $orders = $this->InvoiceCigarette->Orders->find('list', ['limit' => 200]);
        $this->set(compact('invoiceCigarette', 'clients', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Cigarette id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceCigarette = $this->InvoiceCigarette->get($id);
        if ($this->InvoiceCigarette->delete($invoiceCigarette)) {
            $this->Flash->success(__('The invoice cigarette has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice cigarette could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
