<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Cigarette Controller
 *
 * @property \App\Model\Table\CigaretteTable $Cigarette
 *
 * @method \App\Model\Entity\Cigarette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CigaretteController extends AppController
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
        $cigarette = $this->Cigarette->find('all', [
            'order' => ['Cig_company' => 'ASC', 'Cig_brand' => 'ASC', 'Cig_size' => 'ASC']
        ]);

        $this->set(compact('cigarette'));
    }

    public function stock()
    {
        $cigarette = $this->Cigarette->find('all', [
            'order' => ['Cig_company' => 'ASC', 'Cig_brand' => 'ASC', 'Cig_size' => 'ASC']
        ]);

        $this->set(compact('cigarette'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $cigarettes = $this->request->getData();

            $cigarettesArray = json_decode($cigarettes['json'],true);
            $list = $this->Cigarette->find('all')->toList();
            $entities = $this->Cigarette->patchEntities($list,$cigarettesArray);

            if ($this->Cigarette->saveMany($entities)) {
                $this->Flash->success(__('The stock has been updated.'));
            }
            else{
                $this->Flash->error(__('The stock cannot be updated.'));

            }
        }
    }

    public function convert(){
        $cigarette = $this->Cigarette->find('all', [
            'order' => ['Cig_company' => 'ASC', 'Cig_brand' => 'ASC', 'Cig_size' => 'ASC']
        ]);

        $this->set(compact('cigarette'));
    }

    /**
     * View method
     *
     * @param string|null $id Cigarette id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cigarette = $this->Cigarette->get($id, [
            'contain' => []
        ]);

        $this->set('cigarette', $cigarette);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cigarette = $this->Cigarette->newEntity();
        if ($this->request->is('post')) {
            $cigarette = $this->Cigarette->patchEntity($cigarette, $this->request->getData());
            if ($this->Cigarette->save($cigarette)) {
                $this->Flash->success(__('The cigarette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cigarette could not be saved. Please, try again.'));
        }
        $this->set(compact('cigarette'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cigarette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cigarette = $this->Cigarette->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cigarette = $this->Cigarette->patchEntity($cigarette, $this->request->getData());
            if ($this->Cigarette->save($cigarette)) {
                $this->Flash->success(__('The cigarette has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cigarette could not be saved. Please, try again.'));
        }
        $this->set(compact('cigarette'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cigarette id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cigarette = $this->Cigarette->get($id);
        if ($this->Cigarette->delete($cigarette)) {
            $this->Flash->success(__('The cigarette has been deleted.'));
        } else {
            $this->Flash->error(__('The cigarette could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function update()
    {
        if ($this->request->is('post')) {
            //load data from csv save it into cigarette_price
            $data = $this->request->getData();
            $csvData = $data['csvData'];
            $jsonCsvData = json_decode($csvData);
            for ($x = 1; $x < count($jsonCsvData) - 1; $x++) {
                $cigarettes = $this->Cigarette->find('all')->where([
                    "Cig_brand" => $jsonCsvData[$x][0],
                    "Cig_size" => $jsonCsvData[$x][1]
                ]);
                $numCigarette = $cigarettes->count();
                if($numCigarette==0){
                    $this->Flash->error(__('Cannot find '.$jsonCsvData[$x][0]." ".$jsonCsvData[$x][1]).' from Cigarettes');
                    return $this->redirect(['action' => 'update']);
                }
                else{
                    foreach($cigarettes as $cigarette){
                        $cigarette->Cig_packet_price = $jsonCsvData[$x][2];
                        $cigarette->Cig_carton_price = $jsonCsvData[$x][3];
                        $cigarette->Cig_retail_price = $jsonCsvData[$x][4];
                        $this->Cigarette->save($cigarette);
                    }
                }
            }
            return $this->redirect(['action' => 'index']);
        }
    }


}
