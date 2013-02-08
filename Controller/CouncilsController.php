<?php
App::uses('AppController', 'Controller');
/**
 * Councils Controller
 *
 * @property Council $Council
 */
class CouncilsController extends AppController {


	public function index() {
		$this->Council->recursive = 0;
		$this->set('councils', $this->paginate());
	}

	public function view($id = null) {
		$this->Council->id = $id;
		if (!$this->Council->exists()) {
			throw new NotFoundException(__('Invalid council'));
		}
		$this->set('council', $this->Council->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Council->create();
			if ($this->Council->save($this->request->data)) {
				$this->Session->setFlash(__('The council has been saved'));
				$this->redirect(array('action' => 'edit', $this->Council->id));
			} else {
				$this->Session->setFlash(__('The council could not be saved. Please, try again.'));
			}
		}
		$councilareas = $this->Council->Councilarea->find('list');
		$this->set(compact('councilareas'));
	}

	public function edit($id = null) {
		$this->Council->id = $id;
		if (!$this->Council->exists()) {
			throw new NotFoundException(__('Invalid council'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Council->saveAll($this->request->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('The council has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The council could not be saved. Please, try again.'));
			}
		}
		$this->Council->contain(array('ContractorsCouncil'));
		$this->request->data = $this->Council->read(null, $id);
		$councilareas = $this->Council->Councilarea->find('list');
		$contractortypes = $this->Council->Contractor->Contractortype->find('list');
		$contractors = $this->Council->Contractor->find('list', array('fields'=>array('id', 'name', 'contractortype_id')));
		$this->set(compact('councilareas', 'contractortypes', 'contractors'));
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Council->id = $id;
		if (!$this->Council->exists()) {
			throw new NotFoundException(__('Invalid council'));
		}
		if ($this->Council->delete()) {
			$this->Session->setFlash(__('Council deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Council was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function by_country_state($countrystate_id = null, $model) {
		$this->layout = 'ajax';
		$data = $this->Council->find('all', array(
			'conditions'=>array(
				'countrystate_id'=>$countrystate_id
				),
				'contain'=>array('Councilarea'),
				'fields'=>array('Councilarea.name', 'Council.id', 'Council.name')
			));
		foreach ($data as $c) {
			$councils[$c['Councilarea']['name']][$c['Council']['id']] = $c['Council']['name'];
		}
		
		$this->set(compact('councils', 'model'));
	}
}
