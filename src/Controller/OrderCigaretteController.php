<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * OrderCigarette Controller
 *
 * @property \App\Model\Table\OrderCigaretteTable $OrderCigarette
 *
 * @method \App\Model\Entity\OrderCigarette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderCigaretteController extends AppController
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
            'contain' => ['Orders']
        ];
        $orderCigarette = $this->paginate($this->OrderCigarette);

        $this->set(compact('orderCigarette'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Cigarette id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderCigarette = $this->OrderCigarette->get($id, [
            'contain' => ['Orders', 'Cigarette']
        ]);

        $this->set('orderCigarette', $orderCigarette);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderCigarette = $this->OrderCigarette->newEntity();
        if ($this->request->is('post')) {
            $orderCigarette = $this->OrderCigarette->patchEntity($orderCigarette, $this->request->getData());
            if ($this->OrderCigarette->save($orderCigarette)) {
                $this->Flash->success(__('The order cigarette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order cigarette could not be saved. Please, try again.'));
        }
        $orders = $this->OrderCigarette->Orders->find('list', ['limit' => 200]);
        $this->set(compact('orderCigarette', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Cigarette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderCigarette = $this->OrderCigarette->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderCigarette = $this->OrderCigarette->patchEntity($orderCigarette, $this->request->getData());
            if ($this->OrderCigarette->save($orderCigarette)) {
                $this->Flash->success(__('The order cigarette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order cigarette could not be saved. Please, try again.'));
        }
        $orders = $this->OrderCigarette->Orders->find('list', ['limit' => 200]);
        $this->set(compact('orderCigarette', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Cigarette id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderCigarette = $this->OrderCigarette->get($id);
        if ($this->OrderCigarette->delete($orderCigarette)) {
            $this->Flash->success(__('The order cigarette has been deleted.'));
        } else {
            $this->Flash->error(__('The order cigarette could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
