<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * CustomerOrder Controller
 *
 * @property \App\Model\Table\CustomerOrderTable $CustomerOrder
 *
 * @method \App\Model\Entity\CustomerOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomerOrderController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow('add');
        $this->set('authUser', $this->Auth->user());

    }

    public function index()
    {
        $this->isAllowed($this->Auth->user());
        $customerOrder = $this->paginate($this->CustomerOrder);

        $this->set(compact('customerOrder'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customerOrder = $this->CustomerOrder->get($id, [
            'contain' => []
        ]);

        $this->set('customerOrder', $customerOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customerOrder = $this->CustomerOrder->newEntity();
        if ($this->request->is('post')) {
            $customerOrder = $this->CustomerOrder->patchEntity($customerOrder, $this->request->getData());
            if ($this->CustomerOrder->save($customerOrder)) {
                $this->Flash->success(__('Your order has been placed.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->error(__('This order could not be saved. Please try again.'));
        }
        $this->set(compact('customerOrder'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerOrder = $this->CustomerOrder->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerOrder = $this->CustomerOrder->patchEntity($customerOrder, $this->request->getData());
            if ($this->CustomerOrder->save($customerOrder)) {
                $this->Flash->success(__('The customer order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer order could not be saved. Please, try again.'));
        }
        $this->set(compact('customerOrder'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customerOrder = $this->CustomerOrder->get($id);
        if ($this->CustomerOrder->delete($customerOrder)) {
            $this->Flash->success(__('The customer order has been deleted.'));
        } else {
            $this->Flash->error(__('The customer order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
