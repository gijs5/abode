<?php
App::uses('AppController', 'Controller');

class ProjectsController extends AppController {

	public function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}
	
	public function view($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->set('project', $this->Project->read(null, $id));
	}
	
	/*
	select existing client or add new client before creating a new project
	*/
	public function select_client() {
		if ($this->request->is('post')) {
			if ($this->request->data['Type']['type']=='new') {
				if ($this->Project->Client->saveAll($this->request->data, array('validate'=>'first'))) {
					$this->Session->setFlash(__('The client has been saved'));
					$this->redirect(array('action' => 'add', $this->Project->Client->id));
				} else {
					$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
				}
			}
			else{
				$this->redirect(array('action' => 'add', $this->request->data['Client']['client_id']));
			}
		}
		
		$clients = $this->Project->Client->find('list');
		$this->set(compact('clients'));
	}
	
	public function add($client_id=null) {
		$this->Project->Client->id = $client_id;
		if (!$this->Project->Client->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		
		if ($this->request->is('post')) {
			$this->Project->create();
			$this->request->data['Project']['client_id'] = $client_id;
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved'));
				$this->redirect(array('controller'=>'projectstages', 'action' => 'index', $this->Project->id));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
		$client = $this->Project->Client->read();
		$countrystates = $this->Project->Countrystate->find('list');
		$streettypes = $this->Project->Streettype->find('list');
		$streetsuffixes = $this->Project->Streetsuffix->find('list');
		$this->set(compact('countrystates', 'streettypes', 'streetsuffixes', 'client'));
	}

	public function edit($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}
		$countrystates = $this->Project->Countrystate->find('list');
		$states = $this->Project->State->find('list');
		$streettypes = $this->Project->Streettype->find('list');
		$streetsuffixes = $this->Project->Streetsuffix->find('list');
		$this->set(compact('countrystates', 'states', 'streettypes', 'streetsuffixes'));
	}
}
