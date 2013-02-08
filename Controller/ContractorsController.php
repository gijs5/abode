<?php
App::uses('AppController', 'Controller');

class ContractorsController extends AppController {

	public function index() {
		$this->Contractor->recursive = 0;
		$this->set('contractors', $this->paginate());
	}

	public function view($id = null) {
		$this->Contractor->id = $id;
		if (!$this->Contractor->exists()) {
			throw new NotFoundException(__('Invalid contractor'));
		}
		$this->set('contractor', $this->Contractor->read(null, $id));
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['User']['group_id'] = $this->Contractor->group_id;
			if ($this->Contractor->saveAll($this->request->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('The contractor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contractor could not be saved. Please, try again.'));
			}
		}
		$contractortypes = $this->Contractor->Contractortype->find('list');
		$countrystates = $this->Contractor->Council->Councilarea->Countrystate->find('list');
		$this->set(compact('countrystates', 'contractortypes'));
	}

	public function edit($id = null) {
		$this->Contractor->id = $id;
		if (!$this->Contractor->exists()) {
			throw new NotFoundException(__('Invalid contractor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contractor->saveAll($this->request->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('The contractor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contractor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Contractor->read(null, $id);
		}
		$contractortypes = $this->Contractor->Contractortype->find('list');
		$countrystates = $this->Contractor->Council->Councilarea->Countrystate->find('list');
		$this->set(compact('countrystates', 'contractortypes'));
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Contractor->id = $id;
		if (!$this->Contractor->exists()) {
			throw new NotFoundException(__('Invalid contractor'));
		}
		if ($this->Contractor->delete()) {
			$this->Session->setFlash(__('Contractor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contractor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
