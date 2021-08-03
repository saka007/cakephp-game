<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\I18n\FrozenTime;

class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }

     public function index() {
       //$this->set('users', $this->Users->find('all'));
        $user_ID = $this->Auth->user('id');
        $this->set('user', $user_ID);

        //$user_data = $this->Users->find('all', array('conditions'=>array('users.id'=>$user_ID)));
        $user_data = $this->Users->findById($user_ID);
        
        
        $this->set(compact('user_data'));

        $history_data = TableRegistry::get('history');

        $query = $history_data->find('all', array(
            'conditions' => array('history.user_id' => $user_ID)
        ));

        $this->set('history',$query);
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registered successfully.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to register.'));
        }
        $this->set('user', $user);
    }

    public function history() {
        if ($this->request->is('post')) {
        $history_table = TableRegistry::get('history');
        $history = $history_table->newEntity($this->request->getData());
        
        $now = FrozenTime::parse('now');
        $time = $now->i18nFormat('yyyy-MM-dd-HH-mm-ss');

        $result = $this->request->getData('result');
        $user_id = $this->request->getData('uid');
        $file_name = $time.$user_id.'gamelog.log';
        $file_data = nl2br($this->request->getData('file_data'));

        $history->result = $result;
        $history->user_id = $user_id;
        $history->file_name = $file_name;

        $this->set('history', $history);
        if($history_table->save($history))
           $this->Flash->success(__('Data saved.'));
          

        Log::config('custom', [
            'className' => 'File',
            'path' => LOGS.'/gamelog/',
            'levels' => [],
            'scopes' => ['custom'],
            'file' =>  $file_name,
        ]);
        
        Log::debug($file_data, ['scope' => ['custom']]);


        }

        $this->set('user', $user);
    }

    public function edit($id = null){
        $user = $this->Users->get($id);
	        if ($this->request->is(['post', 'put'])) {
	            $this->Users->patchEntity($user, $this->request->data);
	            if ($this->Users->save($user)) {
	                $this->Flash->success(__('Your user has been updated.'));
	                return $this->redirect(['action' => 'index']);
	            }
	            $this->Flash->error(__('Unable to update your user.'));
	        }
	        $this->set('user', $user);
	    }
    public function delete($id){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
	        if ($this->Users->delete($user)) {
	            $this->Flash->success(__('The user with id: {0} has been deleted.', h($id)));
	            return $this->redirect(['action' => 'index']);
	        }
	    }
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}
