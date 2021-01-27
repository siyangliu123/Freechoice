<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
//        $orders = $this->paginate($this->Orders);
        $uid = $this->Auth->user('user_id');
        $orders = $this->Orders->find('all')
            ->where(['order_user' => $uid])
            ->order(['order_date' => 'DESC']);
        $this->set(compact('orders'));
    }

    public function adminList()
    {
        $this->isAllowed($this->Auth->user());

        $this->loadModel('Users');
        $users = $this->Users->find('all');
        $this->set(compact('users'));


        $recent_orders = $this->Orders->find("all")
            ->orderDesc('order_date')
            ->limit(10);
        $this->set(compact('recent_orders'));

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $selectedUser = $data['userSelection'];
            $user_orders = $this->Orders->find("all")
                ->where(["order_user" => $selectedUser])->orderDesc('order_date');
            $this->set(compact('user_orders'));
        }
    }


    public function adminView($id = null)
    {
        $this->isAllowed($this->Auth->user());

        $this->loadModel('Users');
        $users = $this->Users->find('all');
        $this->set(compact('users'));

        $this->loadModel('Clients');
        $clients = $this->Clients->find('all');
        $this->set(compact('clients'));

        $order = $this->Orders->get($id);
        $this->set('order', $order);
        $orderCigarette = TableRegistry::getTableLocator()->get('OrderCigarette');
        $orderCigarettes = $orderCigarette->find('all')
            ->where(['order_id' => $id])
        ->contain(['Cigarette']);
        $this->set('orderCigarettes', $orderCigarettes);

        if ($order->order_status == "unviewed") {
            $order->order_status = "viewed";
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('Order marked as viewed'));
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $orderId = $data['orderSelection'];
            $order = $this->Orders->get($orderId);
            $this->set('order', $order);
            $orderCigarette = TableRegistry::getTableLocator()->get('OrderCigarette');
            $orderCigarettes = $orderCigarette->find('all')
                ->where(['order_id' => $orderId])
            ->contain(['Cigarette']);
            $this->set('orderCigarettes', $orderCigarettes);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cigarettes = $this->loadModel('cigarette');
        $query = $cigarettes->find('all', [
            'order' => ['cigarette.Cig_company' => 'ASC', 'cigarette.Cig_brand' => 'ASC', 'cigarette.Cig_size' => 'ASC']
        ]);
        $this->set('query', $query);
        $announcementTable = $this->loadModel('announcement');
        $announcements = $announcementTable->find('all', [
            'order' => ['announcement.announcement_date' => 'DESC'],
            'limit' => 1
        ]);
        foreach ($announcements as $announcement) {
            $this->set('announcement', $announcement);
        }
        /*$order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $this->set(compact('order'));
        */

    }

    public function confirm()
    {
        $cigarettes = $this->loadModel('cigarette');
        $query = $cigarettes->find('all', [
            'order' => ['cigarette.Cig_company' => 'ASC', 'cigarette.Cig_brand' => 'ASC', 'cigarette.Cig_size' => 'ASC']
        ]);
        $this->set('query', $query);
        $submittedData = $this->request->getData('submitData');
        $this->set('data', $submittedData);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (isset($data['action']) && $data['action'] == "modify") {
                $this->set('modifyData', $data['modifyData']);
                return $this->redirect(['action' => 'add']);
            } else if (isset($data['action']) && $data['action'] == "complete") {
                $orderDetail = json_decode($data['orderData']);
                $order = $this->Orders->newEntity();
                $order->order_date = date("Y-m-d H:i:s");
                $order->order_user = $this->Auth->user('user_id');
                $order->order_comment = $orderDetail->Comment;
                if ($this->Orders->save($order)) {
                    $this->Flash->success(__('Your order has been placed.'));
                } else {
                    $this->Flash->error(__('Your order cannot be saved. Please try again'));
                }

                for ($i = 0; $i < count($orderDetail->Brand); $i++) {
                    $orderCigaretteTable = TableRegistry::getTableLocator()->get('OrderCigarette');
                    $orderCigarette = $orderCigaretteTable->newEntity();
                    $orderCigarette->order_id = $order->order_id;
                    $orderCigarette->cigarette_id = $orderDetail->ID[$i];
                    $orderCigarette->packet_price = $orderDetail->PacketPrice[$i];
                    $orderCigarette->packet_quantity = $orderDetail->PacketQuantity[$i];
                    $orderCigarette->carton_price = $orderDetail->CartonPrice[$i];
                    $orderCigarette->carton_quantity = $orderDetail->CartonQuantity[$i];
                    $orderCigaretteTable->save($orderCigarette);
                }
                $to = "dslynlsy@gmail.com";
                $to2 = "greensborough@freechoice.com.au";
                $to3 = "siyangoog1e@gmail.com";
                $users = $this->loadModel('Users');
                $user = $users->get($order->order_user);
                $userName = $user->username;
                $userCompany = $user->user_company;
                $subject = "New order from " . $userCompany;
                $txt = "User " . $userName . " from " . $userCompany . " has placed an order on " . $order->order_date . ".";
                $headers = "From: greensborough@freechoice.com.au";
                mail($to, $subject, $txt, $headers);
                mail($to2, $subject, $txt, $headers);
                mail($to3, $subject, $txt, $headers);
                return $this->redirect(['action' => 'add']);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->isAllowed($this->Auth->user());
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $this->set(compact('order'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->isAllowed($this->Auth->user());
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'admin-list']);
    }

    public function selectDate(){
        $this->isAllowed($this->Auth->user());

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if(!isset($data['selected-orders'])){
                $conn = ConnectionManager::get('default');
                $stmt = $conn->execute("select orders.order_id, users.user_company, order_date, order_comment from orders join users where orders.order_user = users.user_id AND CAST(orders.order_date AS DATE) BETWEEN CAST('" . $data['startDate'] . "' AS DATE) AND CAST('" . $data['endDate']. "' AS DATE)");
                $orders = $stmt->fetchAll('assoc');
                $this->set('orders', $orders);
            }
            else{
                $orderList = $data['selected-orders'];
            }
        }
    }

    public function viewOrders(){
        $this->isAllowed($this->Auth->user());

        $orderListStr = $this->request->getData('selected-orders');
        $orderList = json_decode($orderListStr, true);
        $orderIds = '(' . implode(',', $orderList) .')';
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("select users.user_company, orders.order_date, orders.order_comment, cigarette.Cig_brand, cigarette.Cig_size, cigarette.Cig_flavor, order_cigarette.packet_quantity , order_cigarette.carton_quantity from orders join order_cigarette,cigarette,users where orders.order_id = order_cigarette.order_id and cigarette.Cig_id = order_cigarette.cigarette_id and orders.order_user = users.user_id and orders.order_id IN " . $orderIds . " order by cigarette.Cig_company, cigarette.Cig_brand, cigarette.Cig_size, cigarette.Cig_flavor");
        $orders = $stmt->fetchAll('assoc');
        $this->set('orders', $orders);
    }
}
