<?php
App::uses('AppController', 'Controller');

class ProjectactionsController extends AppController {

	/*
	default projectactions
		*/
	public function defaults($projectstep_id=null) {
		$this->Projectaction->Projectstep->id = $projectstep_id;
		if (!$this->Projectaction->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		$this->Projectaction->Projectstep->contain(array(
			'Stage', 
			'Projectaction'=>array(
				'Projectphase'=>array(
					'order'=>'Projectphase.rank'
					)
				)
			)
		);
		$projectstep = $this->Projectaction->Projectstep->read();
		$this->set(compact('projectstep'));
	}
	
	/*
	projectactions by project
		*/
	public function index($projectstep_id=null) {
		$this->Projectaction->Projectstep->id = $projectstep_id;
		if (!$this->Projectaction->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		$this->Projectaction->Projectstep->contain(array(
			'Projectstage'=>array(
				'Stage',
				'Project'
				),
			'Projectaction'=>array(
				'Projectphase'=>array(
					'order'=>'Projectphase.rank'
					)
				)
			)
		);
		$projectstep = $this->Projectaction->Projectstep->read();
		$this->set(compact('projectstep'));
	}
	
	public function view($id = null) {
		$this->Projectaction->id = $id;
		if (!$this->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		$this->set('projectaction', $this->Projectaction->read(null, $id));
	}
	
	public function adddefault($projectstep_id=null) {
		$this->Projectaction->Projectstep->id = $projectstep_id;
		if (!$this->Projectaction->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		if ($this->request->is('post')) {
			$this->Projectaction->create();
			$this->request->data['Projectaction']['projectstep_id'] = $projectstep_id;
			if ($this->Projectaction->save($this->request->data)) {
				$this->Session->setFlash(__('The projectaction has been saved'));
				$this->redirect(array('action' => 'defaults', $projectstep_id));
			} else {
				$this->Session->setFlash(__('The projectaction could not be saved. Please, try again.'));
			}
		}
		$this->Projectaction->Projectstep->contain('Stage');
		$projectstep = $this->Projectaction->Projectstep->read();
		$contractortypes = $this->Projectaction->Contractortype->find('list');
		$this->set(compact('projectstep', 'contractortypes'));
	}
	
	public function add($projectstep_id=null) {
		$this->Projectaction->Projectstep->id = $projectstep_id;
		if (!$this->Projectaction->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		if ($this->request->is('post')) {
			$this->Projectaction->create();
			$this->request->data['Projectaction']['projectstep_id'] = $projectstep_id;
			if ($this->Projectaction->save($this->request->data)) {
				$this->Session->setFlash(__('Saved. Check the contractor below.'));
				$this->redirect(array('action' => 'edit', $this->Projectaction->id));
			} else {
				$this->Session->setFlash(__('The projectaction could not be saved. Please, try again.'));
			}
		}
		$this->Projectaction->Projectstep->contain(array('Projectstage'=>array('Project', 'Stage')));
		$projectstep = $this->Projectaction->Projectstep->read();
		$contractortypes = $this->Projectaction->Contractortype->find('list');
		$this->set(compact('projectstep', 'contractortypes'));
	}
	
	public function editdefault($id = null) {
		$this->Projectaction->id = $id;
		if (!$this->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectaction->save($this->request->data)) {
				$this->Session->setFlash(__('The projectaction has been saved'));
				$p = $this->Projectaction->read('projectstep_id');
				$this->redirect(array('action' => 'defaults', $p['Projectaction']['projectstep_id']));
			} else {
				$this->Session->setFlash(__('The projectaction could not be saved. Please, try again.'));
			}
		} else {
			$this->Projectaction->contain(array('Projectstep'=>array('Stage')));
			$this->request->data = $this->Projectaction->read(null, $id);
		}
		$contractortypes = $this->Projectaction->Contractortype->find('list');
		$this->set(compact('contractortypes'));
	}
	
	public function edit($id = null) {
		$this->Projectaction->id = $id;
		if (!$this->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectaction->save($this->request->data)) {
				$this->Session->setFlash(__('The projectaction has been saved'));
				$p = $this->Projectaction->read('projectstep_id');
				$this->redirect(array('action' => 'index', $p['Projectaction']['projectstep_id']));
			} else {
				$this->Session->setFlash(__('The projectaction could not be saved. Please, try again.'));
			}
		} else {
			$this->Projectaction->contain(array('Contractor', 'Projectstep'=>array('Projectstage'=>array('Project', 'Stage'))));
			$this->request->data = $this->Projectaction->read(null, $id);
		}
		$contractors = $this->Projectaction->Contractor->find('list');
		$this->set(compact('contractors'));
	}
	
	public function files($id = null) {
		$this->Projectaction->id = $id;
		if (!$this->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectaction->id = $id;
		if (!$this->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		if ($this->Projectaction->delete()) {
			$this->Session->setFlash(__('Projectaction deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Projectaction was not deleted'));
		$this->redirect($this->referer());
	}
	
	public function finish($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectaction->id = $id;
		if (!$this->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		$this->Projectaction->saveField('state', 2);
		$this->Session->setFlash(__('Projectaction state is changed to finished'));
		$this->redirect($this->referer());
	}
	
	public function sort() {
		$neworder = $this->params['data'];
		foreach ($neworder as $phase => $actions) {
			$projectphase_id = str_replace('projectphase_', '', $phase);
			foreach ($actions as $rank => $action) {
				$projectaction_id = str_replace('projectaction_', '', $action);
				$this->Projectaction->id = $projectaction_id;
				$this->Projectaction->saveField('rank', $rank);
				$this->Projectaction->saveField('projectphase_id', $projectphase_id);
			}
		}
		echo 'saved';
		die;
	}
}
