<?php
App::uses('AppController', 'Controller');

class ProjectactionmailsController extends AppController {
	
	public function index($projectaction_id=null) {
		$this->Projectactionmail->Projectaction->id = $projectaction_id;
		if (!$this->Projectactionmail->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		$this->Projectactionmail->Projectaction->contain(array('Contractor', 'Projectactionmail'=>array('Contractor'), 'Projectstep' => array('Projectstage'=>array('Project', 'Stage'))));
		$projectaction = $this->Projectactionmail->Projectaction->read();
		$this->set(compact('projectaction'));
	}
	
	public function defaults($projectaction_id=null) {
		$this->Projectactionmail->Projectaction->id = $projectaction_id;
		if (!$this->Projectactionmail->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		$this->Projectactionmail->Projectaction->contain(array('Projectactionmail'=>array('Contractortype'), 'Projectstep' => array('Stage')));
		$projectaction = $this->Projectactionmail->Projectaction->read();
		$this->set(compact('projectaction'));
	}
	
	public function view($id = null) {
		$this->Projectactionmail->id = $id;
		if (!$this->Projectactionmail->exists()) {
			throw new NotFoundException(__('Invalid projectactionmail'));
		}
		$preview = $this->Projectactionmail->preview($id);
		$this->set('preview', $preview);
		$this->layout = 'empty';
	}
	
	public function adddefault($projectaction_id=null) {
		$this->Projectactionmail->Projectaction->id = $projectaction_id;
		if (!$this->Projectactionmail->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		
		if ($this->request->is('post')) {
			$this->Projectactionmail->create();
			$this->request->data['Projectactionmail']['projectaction_id'] = $projectaction_id;
			if ($this->Projectactionmail->save($this->request->data)) {
				$this->Session->setFlash(__('The projectactionmail has been saved'));
				$this->redirect(array('action' => 'defaults', $projectaction_id));
			} else {
				$this->Session->setFlash(__('The projectactionmail could not be saved. Please, try again.'));
			}
		}
		$this->Projectactionmail->Projectaction->contain(array('Projectactionmail', 'Projectstep' => array('Stage')));
		$projectaction = $this->Projectactionmail->Projectaction->read();
		$contractortypes = $this->Projectactionmail->Contractortype->find('list');
		$this->set(compact('projectaction', 'contractortypes'));
	}
	
	public function add($projectaction_id=null) {
		$this->Projectactionmail->Projectaction->id = $projectaction_id;
		if (!$this->Projectactionmail->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		
		if ($this->request->is('post')) {
			$this->Projectactionmail->create();
			$this->request->data['Projectactionmail']['projectaction_id'] = $projectaction_id;
			if ($this->Projectactionmail->save($this->request->data)) {
				$this->Session->setFlash(__('Saved. Check the contractor below.'));
				$this->redirect(array('action' => 'edit', $this->Projectactionmail->id));
			} else {
				$this->Session->setFlash(__('The projectactionmail could not be saved. Please, try again.'));
			}
		}
		$this->Projectactionmail->Projectaction->contain(array('Projectactionmail', 'Projectstep' => array('Projectstage'=>array('Project', 'Stage'))));
		$projectaction = $this->Projectactionmail->Projectaction->read();
		$contractortypes = $this->Projectactionmail->Contractortype->find('list');
		$this->set(compact('projectaction', 'contractortypes'));
	}
	
	public function editdefault($id = null) {
		$this->Projectactionmail->id = $id;
		if (!$this->Projectactionmail->exists()) {
			throw new NotFoundException(__('Invalid projectactionmail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectactionmail->save($this->request->data)) {
				$this->Session->setFlash(__('The projectactionmail has been saved'));
				$pam = $this->Projectactionmail->read();
				$this->redirect(array('action' => 'defaults', $pam['Projectactionmail']['projectaction_id']));
			} else {
				$this->Session->setFlash(__('The projectactionmail could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectactionmail->read(null, $id);
		}
		$this->Projectactionmail->contain(array('Projectaction'=>array('Projectactionmail', 'Projectstep' => array('Stage'))));
		$projectactionmail = $this->Projectactionmail->read();
		$contractortypes = $this->Projectactionmail->Contractortype->find('list');
		$this->set(compact('projectactionmail', 'contractortypes'));
	}
	
	public function edit($id = null) {
		$this->Projectactionmail->id = $id;
		if (!$this->Projectactionmail->exists()) {
			throw new NotFoundException(__('Invalid projectactionmail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectactionmail->save($this->request->data)) {
				$this->Session->setFlash(__('The projectactionmail has been saved'));
				$pam = $this->Projectactionmail->read();
				$this->redirect(array('action' => 'index', $pam['Projectactionmail']['projectaction_id']));
			} else {
				$this->Session->setFlash(__('The projectactionmail could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectactionmail->read(null, $id);
		}
		$projectactionmail = $this->Projectactionmail->find('first', array(
			'contain'=>array('Projectaction'=>array('Projectactionmail', 'Projectstep' => array('Projectstage'=>array('Project', 'Stage')))),
			'conditions'=>array('Projectactionmail.id'=>$id)
			));
		$contractors = $this->Projectactionmail->Contractor->find('list');
		$this->set(compact('projectactionmail', 'contractors'));
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectactionmail->id = $id;
		if (!$this->Projectactionmail->exists()) {
			throw new NotFoundException(__('Invalid projectactionmail'));
		}
		if ($this->Projectactionmail->delete()) {
			$this->Session->setFlash(__('Projectactionmail deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Projectactionmail was not deleted'));
		$this->redirect($this->referer());
	}
	
	public function send_single($contractors_projectactionmail_id=null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectactionmail->ContractorsProjectactionmail->id = $contractors_projectactionmail_id;
		if (!$this->Projectactionmail->ContractorsProjectactionmail->exists()) {
			throw new NotFoundException(__('Invalid id'));
		}
		$this->Projectactionmail->send_single($contractors_projectactionmail_id);
		$this->redirect($this->referer());
	}
}
