<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


/**
 * StockRecord Controller
 *
 * @property \App\Model\Table\StockRecordTable $StockRecord
 *
 * @method \App\Model\Entity\StockRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockRecordController extends AppController
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
        $stockRecords = $this->StockRecord->find('all');
        $this->set(compact('stockRecords'));


        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("select DISTINCT SUBSTRING(stock_record_date,1,10) AS stock_record_date from stock_record order by stock_record_date DESC ;");
        $recordDates = $stmt ->fetchAll('assoc');

        $this->set(compact('recordDates'));

    }

    /**
     * View method
     *
     * @param string|null $id Stock Record id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockRecord = $this->StockRecord->get($id, [
            'contain' => []
        ]);

        $this->set('stockRecord', $stockRecord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addShop()
    {
        $cigaretteTable = TableRegistry::getTableLocator()->get('Cigarette');
        $cigarettes = $cigaretteTable->find('all', [
            'order' => ['Cig_company' => 'ASC', 'Cig_brand' => 'ASC', 'Cig_size' => 'ASC', 'Cig_flavor' => 'ASC']
        ]);
        $this->set(compact('cigarettes'));

        $stockRecords = $this->StockRecord->newEntity();
        $this->set(compact('stockRecords'));

        if ($this->request->is('post')) {
            $stockRecords = $this->request->getData();
            $stockRecordsArray = json_decode($stockRecords['json'], true);

            foreach ($stockRecordsArray as $stockRecordItem) {
                $stockRecord = $this->StockRecord->newEntity();
                $stockRecord->stock_record_item = $stockRecordItem["stockItem"];
                $stockRecord->stock_record_quantity = $stockRecordItem["stockQuantity"];
                $stockRecord->stock_location = 1;
                $stockRecord->stock_record_date = date("Y-m-d H:i:s");
                if ($this->StockRecord->save($stockRecord)) {
                    $this->Flash->success($stockRecordItem["stockQuantity"] ." of " . $stockRecordItem["stockItem"] . " has been saved.");
                    $cigarette = $cigaretteTable->get($stockRecordItem["stockId"]);
                    $cigarette->Cig_shop_stock += $stockRecordItem["stockQuantity"];
                    $cigaretteTable->save($cigarette);
                } else {
                    $this->Flash->error(__('The stock record could not be saved. Please, try again.'));
                }
            }
        }
    }

    public function addWarehouse()
    {

        $cigaretteTable = TableRegistry::getTableLocator()->get('Cigarette');
        $cigarettes = $cigaretteTable->find('all', [
            'order' => ['Cig_company' => 'ASC', 'Cig_brand' => 'ASC', 'Cig_size' => 'ASC', 'Cig_flavor' => 'ASC']
        ]);
        $this->set(compact('cigarettes'));

        $stockRecords = $this->StockRecord->newEntity();
        $this->set(compact('stockRecords'));

        if ($this->request->is('post')) {
            $stockRecords = $this->request->getData();
            $stockRecordsArray = json_decode($stockRecords['json'],true);

            foreach ($stockRecordsArray as $stockRecordItem){
                $stockRecord = $this->StockRecord->newEntity();
                $stockRecord->stock_record_item = $stockRecordItem["stockItem"];
                $stockRecord->stock_record_quantity = $stockRecordItem["stockQuantity"];
                $stockRecord->stock_location = 0;
                $stockRecord->stock_record_date = date("Y-m-d H:i:s");
                if ($this->StockRecord->save($stockRecord)) {
                    $this->Flash->success($stockRecordItem["stockQuantity"] ." of " . $stockRecordItem["stockItem"] . " has been saved.");
                    $cigarette = $cigaretteTable->get($stockRecordItem["stockId"]);
                    $cigarette->Cig_warehouse_stock += $stockRecordItem["stockQuantity"];
                    $cigaretteTable->save($cigarette);
                    }
                else {
                    $this->Flash->error(__('The stock record could not be saved. Please, try again.'));
                }
            }

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Record id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockRecord = $this->StockRecord->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockRecord = $this->StockRecord->patchEntity($stockRecord, $this->request->getData());
            if ($this->StockRecord->save($stockRecord)) {
                $this->Flash->success(__('The stock record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock record could not be saved. Please, try again.'));
        }
        $this->set(compact('stockRecord'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Record id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockRecord = $this->StockRecord->get($id);
        if ($this->StockRecord->delete($stockRecord)) {
            $cigaretteTable = $this->loadModel("Cigarette");
            $cigarette = $cigaretteTable->find("all")->where(["CONCAT(Cig_brand,' ',Cig_size,' ',Cig_flavor) = " => $stockRecord->stock_record_item])->first();
            if($stockRecord->stock_location == 0){
                $cigarette->Cig_warehouse_stock-=$stockRecord->stock_record_quantity;
            }
            else{
                $cigarette->Cig_shop_stock-=$stockRecord->stock_record_quantity;
            }
            $cigaretteTable->save($cigarette);
            $this->Flash->success(__('The stock record has been deleted.'));
        } else {
            $this->Flash->error(__('The stock record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
