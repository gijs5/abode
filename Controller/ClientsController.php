<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 */
class ClientsController extends AppController {

	public function index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->paginate());
	}
	
	public function view($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			$this->request->data['User']['group_id'] = $this->Client->group_id;
			if ($this->Client->saveAll($this->request->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('The client has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}
		$users = $this->Client->User->find('list');
		$this->set(compact('users'));
	}

	public function edit($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Client->saveAll($this->request->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('The client has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Client->read(null, $id);
		}
		$users = $this->Client->User->find('list');
		$this->set(compact('users'));
	}
}
