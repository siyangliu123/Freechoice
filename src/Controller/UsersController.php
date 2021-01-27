<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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
        $users = $this->Users->find('all');

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->isAllowed($this->Auth->user());
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your registration has been sent'));
                $to = "dslynlsy@gmail.com";
                $to2 = "greensborough@freechoice.com.au";
                $to3 = "siyangoog1e@gmail.com";
                $subject = "New user" . $user->user_company;
                $txt = "New user " . $user->username . " from " . $user->user_company . " has registered. \n
To approve, please click ausio.xyz/users" ;
                $headers = "From: greensborough@freechoice.com.au";

                mail($to, $subject, $txt, $headers);
                mail($to2, $subject, $txt, $headers);
                mail($to3, $subject, $txt, $headers);
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->isAllowed($this->Auth->user());
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }


    public function activate($id = null)
    {
        $this->isAllowed($this->Auth->user());
        $this->request->allowMethod(['post', 'activate']);
        if ($id == 1) {
            $this->Flash->error(__('You cannot deactive yourself'));
        } else {
            $user = $this->Users->get($id);
            if ($user['user_status'] == 0) {
                $user['user_status'] = 1;
            } else {
                $user['user_status'] = 0;
            }

            if ($this->Users->save($user)) {
                return $this->redirect(['action' => 'index']);
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->isAllowed($this->Auth->user());
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['user_status'] == 0) {
                    $this->Flash->error(__('This account is not yet activated'));
                } else if ($user['user_id'] == 1) {
                    $this->Auth->setUser($user);
                    if($this->Auth->redirectUrl()){
                        return $this->redirect($this->Auth->redirectUrl());
                    }
                    else{
                        return $this->redirect(["controller" => "users", "action" => "admin"]);
                    }
                } else {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error(__('Username/Password is invalid.'));
            }
        }
    }

    public function logout()
    {
        $session = $this->getRequest()->getSession();
        $session->delete("user");
        return $this->redirect($this->Auth->logout());
    }

    public function admin()
    {
        $this->isAllowed($this->Auth->user());

        $this->loadModel('Users');
        $users = $this->Users->find('all');
        $this->set(compact('users'));

        $this->loadModel('Orders');
        $unviewed_orders = $this->Orders->find("all")
            ->orderDesc('order_date')
            ->limit(10);
        $this->set(compact('unviewed_orders'));

    }


}
