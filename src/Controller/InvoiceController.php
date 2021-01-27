<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Invoice Controller
 *
 * @property \App\Model\Table\InvoiceTable $Invoice
 *
 * @method \App\Model\Entity\Invoice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoiceController extends AppController
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

        $invoices = $this->Invoice->find("all")->contain(['Orders', 'Clients'])->orderDesc('Orders.order_date');

        $this->set(compact('invoices'));
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoice->get($id, [
            'contain' => ['Orders', 'Clients']
        ]);

        $invoiceCigaretteTable = $this->loadModel('InvoiceCigarette');
        $invoiceCigarettes = $invoiceCigaretteTable->find("all")
            ->where(['invoice_id' => $id]);
        $this->set(compact("invoiceCigarettes", "invoice"));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id)
    {
        $this->isAllowed($this->Auth->user());
        $invoice = $this->Invoice->newEntity();
        $this->set(compact("invoice"));
        $usersTable = $this->loadModel('Users');;

        $this->loadModel('Clients');
        $clients = $this->Clients->find('all');
        $this->set(compact('clients'));

        $ordersTable = $this->loadModel('Orders');
        $order = $ordersTable->get($id);
        $orderUser = $usersTable->get($order->order_user);
        $this->set(compact('orderUser', 'order'));

        $orderCigarette = TableRegistry::getTableLocator()->get('OrderCigarette');
        $orderCigarettes = $orderCigarette->find('all')
            ->where(['order_id' => $id])
            ->contain(['Cigarette']);
        $this->set('orderCigarettes', $orderCigarettes);

        if ($order->order_status == "unviewed") {
            $order->order_status = "viewed";
            $this->Orders->save($order);
        }

        if ($this->request->is('post')) {
            $invoiceEntity = $this->Invoice->newEntity();
            $data = $this->request->getData();
            $jsonData = json_decode($data['submitData'], true);
            $client = $data['client'];
            $invoiceEntity->client_id = intval($client);
            $invoiceEntity->order_id = $order->order_id;
            $invoiceEntity->invoice_date = date("Y-m-d H:i:s");
            $result = $this->Invoice->save($invoiceEntity);
            if ($result) {
                foreach ($jsonData as $invoiceRecord) {
                    $invoiceCigaretteTable = $this->loadModel('InvoiceCigarette');
                    $invoiceRecord['invoice_id'] = $result->invoice_id;
                    $invoiceCigarette = $invoiceCigaretteTable->newEntity($invoiceRecord);
                    $cigaretteTable = $this->loadModel('Cigarette');
                    if($invoiceCigaretteTable->save($invoiceCigarette)){
                        $cigarettes = $cigaretteTable->find("all")->where(['Cig_brand' => $invoiceCigarette->cigarette_brand, 'Cig_size' => $invoiceCigarette->cigarette_size, 'Cig_flavor' => $invoiceCigarette->cigarette_flavor]);
                        $cigarette = $cigarettes->first();
                        $cigarette->Cig_warehouse_stock -= ($invoiceCigarette->packet_from_warehouse + $invoiceCigarette->carton_from_warehouse * $cigarette->Cig_packet_in_carton);
                        $cigarette->Cig_shop_stock -= ($invoiceCigarette->packet_from_shop + $invoiceCigarette->carton_from_shop * $cigarette->Cig_packet_in_carton);
                        $cigaretteTable->save($cigarette);
                    }
                }
            }
            return $this->redirect(['action' => 'view', $result->invoice_id]);
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoice->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoice->patchEntity($invoice, $this->request->getData());
            if ($this->Invoice->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $orders = $this->Invoice->Orders->find('list', ['limit' => 200]);
        $clients = $this->Invoice->Clients->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'orders', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoice->get($id);
        $result = $this->Invoice->delete($invoice);
        if ($result) {
            $invoiceCigaretteTable = $this->loadModel("InvoiceCigarette");
            $invoiceCigarettes = $invoiceCigaretteTable->find("all")->where(["invoice_id" => $id]);
            $cigaretteTable = $this->loadModel("Cigarette");
            foreach($invoiceCigarettes as $invoiceCigarette){
                $cigarette = $cigaretteTable->find("all")->where(["Cig_brand" => $invoiceCigarette->cigarette_brand, "Cig_size" => $invoiceCigarette->cigarette_size, "Cig_flavor" => $invoiceCigarette->cigarette_flavor])->first();
                $cigarette->Cig_shop_stock += ($invoiceCigarette->packet_from_shop + $invoiceCigarette->carton_from_shop * $cigarette->Cig_packet_in_carton);
                $cigarette->Cig_warehouse_stock += ($invoiceCigarette->packet_from_warehouse + $invoiceCigarette->carton_from_warehouse * $cigarette->Cig_packet_in_carton);
                $cigaretteTable->save($cigarette);
                $invoiceCigaretteTable->delete($invoiceCigarette);
            }
                $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
