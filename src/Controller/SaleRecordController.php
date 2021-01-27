<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * SaleRecord Controller
 *
 * @property \App\Model\Table\SaleRecordTable $SaleRecord
 *
 * @method \App\Model\Entity\SaleRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaleRecordController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeFilter(Event $event)
    {
        $this->set('authUser', $this->Auth->user());
        $this->isAllowed($this->Auth->user());
    }

    public function index()
    {
        $saleRecords = $this->SaleRecord->find('all', [
            'order' => ['record_date' => 'DESC']
        ])->where(['record_date LIKE' => date('Y-m-d')."%"])->contain(['cigarette']);
        $this->set(compact('saleRecords'));
        $cigaretteTable = TableRegistry::getTableLocator()->get('Cigarette');
        $cigarettes = $cigaretteTable->find('all', [
            'order' => ['Cig_company' => 'ASC', 'Cig_brand' => 'ASC', 'Cig_size' => 'ASC', 'Cig_flavor' => 'ASC']
        ]);
        $this->set(compact('cigarettes'));


        $newSaleRecord = $this->SaleRecord->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $newSaleRecord = $this->SaleRecord->patchEntity($newSaleRecord, $data);
            $newSaleRecord->record_date = date("Y-m-d H:i:s");
            if ($this->SaleRecord->save($newSaleRecord)) {
                $cigaretteItems = $cigaretteTable->find('all')->where(['Cig_id' => $data['record_item']]);
                foreach ($cigaretteItems as $cigaretteItem){
                    $cigaretteItem->Cig_shop_stock = $cigaretteItem->Cig_shop_stock - $newSaleRecord['record_sold_quantity'];
                    $cigaretteTable->save($cigaretteItem);
                }
                $this->Flash->success(__('The sale record has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale record could not be saved. Please, try again.'));
        }
        $this->set(compact('newSaleRecord'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale Record id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function generateReport(){
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $this->redirect(['action' => 'report', $data['startDate'], $data['endDate']]);
        }
    }

    public function report($startDate, $endDate){
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute("select Cig_brand, Cig_size, Cig_flavor, sum(record_sold_quantity) as record_sold_quantity, Cig_retail_price from sale_record join cigarette where record_item = Cig_id AND CAST(record_date AS DATE) BETWEEN CAST('" . $startDate . "' AS DATE) AND CAST('" . $endDate. "' AS DATE) group by record_item");
            $saleRecords = $stmt->fetchAll('assoc');

            $this->set(compact('saleRecords', 'startDate', 'endDate'));
    }

    public function view($id = null)
    {
        $saleRecord = $this->SaleRecord->get($id, [
            'contain' => []
        ]);

        $this->set('saleRecord', $saleRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $saleRecord = $this->SaleRecord->newEntity();
        if ($this->request->is('post')) {
            $saleRecord = $this->SaleRecord->patchEntity($saleRecord, $this->request->getData());
            if ($this->SaleRecord->save($saleRecord)) {
                $this->Flash->success(__('The sale record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale record could not be saved. Please, try again.'));
        }
        $this->set(compact('saleRecord'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $saleRecord = $this->SaleRecord->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saleRecord = $this->SaleRecord->patchEntity($saleRecord, $this->request->getData());
            if ($this->SaleRecord->save($saleRecord)) {
                $this->Flash->success(__('The sale record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale record could not be saved. Please, try again.'));
        }
        $this->set(compact('saleRecord'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $saleRecord = $this->SaleRecord->get($id);
        if ($this->SaleRecord->delete($saleRecord)) {
            $cigaretteTable = $this->loadModel("Cigarette");
            $cigarette = $cigaretteTable->get($saleRecord->record_item);
            $cigarette->Cig_shop_stock+=$saleRecord->record_sold_quantity;
            if($cigaretteTable->save($cigarette)){
                $this->Flash->success(__('The sale record has been deleted.'));
            }
        } else {
            $this->Flash->error(__('The sale record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
