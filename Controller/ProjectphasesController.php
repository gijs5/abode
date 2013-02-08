<?php
App::uses('AppController', 'Controller');

class ProjectphasesController extends AppController {

	public function index($projectstage_id=null) {
		$this->Projectphase->Projectstage->id = $projectstage_id;
		if (!$this->Projectphase->Projectstage->exists()) {
			throw new NotFoundException(__('Invalid projectstage'));
		}
		$this->Projectphase->Projectstage->contain(array(
			'Projectphase',
			'Projectstep'=>array(
				'Projectaction'
				),
			'Stage'
			));
		$projectstage = $this->Projectphase->Projectstage->read();
		$projectactions = Set::extract('/Projectstep/Projectaction', $projectstage);
		$projectactions = Set::filter($projectactions);
		$projectactions = Set::combine($projectactions, '{n}.Projectaction.id', '{n}.Projectaction', '{n}.Projectaction.projectphase_id');
		$this->set(compact('projectstage', 'projectactions'));
	}

	public function defaults($stage_id=null) {
		$this->Projectphase->Stage->id = $stage_id;
		if (!$this->Projectphase->Stage->exists()) {
			throw new NotFoundException(__('Invalid stage'));
		}
		$this->Projectphase->Stage->contain(array(
			'Projectphase',
			'Projectstep'=>array(
				'Projectaction'
				)
			));
		$stage = $this->Projectphase->Stage->read(null);
		$projectactions = Set::extract('/Projectstep/Projectaction', $stage);
		$projectactions = Set::filter($projectactions);
		$projectactions = Set::combine($projectactions, '{n}.Projectaction.id', '{n}.Projectaction', '{n}.Projectaction.projectphase_id');
		$this->set(compact('stage', 'projectactions'));
	}
	
	public function sort() {
		$neworder = explode(',', $this->params['data']['newOrder']);
		
		foreach ($neworder as $rank => $value) {
			if (substr($value, 0, 12)=='projectphase') {
				$id = str_replace('projectphase_', '', $value);
				$this->Projectphase->id = $id;
				$this->Projectphase->saveField('rank', $rank);
			}
		}
		echo 'saved';
		die;
	}

	public function view($id = null) {
		$this->Projectphase->id = $id;
		if (!$this->Projectphase->exists()) {
			throw new NotFoundException(__('Invalid projectphase'));
		}
		$this->set('projectphase', $this->Projectphase->read(null, $id));
	}

	public function adddefault($stage_id=null) {
		if ($this->request->is('post')) {
			$this->Projectphase->create();
			$this->request->data['Projectphase']['stage_id'] = $stage_id;
			if ($this->Projectphase->save($this->request->data)) {
				$this->Session->setFlash(__('The projectphase has been saved'));
				$this->redirect(array('action' => 'defaults', $stage_id));
			} else {
				$this->Session->setFlash(__('The projectphase could not be saved. Please, try again.'));
			}
		}
	}
	
	public function add($projectstage_id=null) {
		if ($this->request->is('post')) {
			$this->Projectphase->create();
			$this->request->data['Projectphase']['projectstage_id'] = $projectstage_id;
			if ($this->Projectphase->save($this->request->data)) {
				$this->Session->setFlash(__('The projectphase has been saved'));
				$this->redirect(array('action' => 'index', $projectstage_id));
			} else {
				$this->Session->setFlash(__('The projectphase could not be saved. Please, try again.'));
			}
		}
	}

	public function editdefault($id = null) {
		$this->Projectphase->id = $id;
		if (!$this->Projectphase->exists()) {
			throw new NotFoundException(__('Invalid projectphase'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectphase->save($this->request->data)) {
				$this->Session->setFlash(__('The projectphase has been saved'));
				$ps = $this->Projectphase->read('stage_id');
				$this->redirect(array('action' => 'defaults', $ps['Projectphase']['stage_id']));
			} else {
				$this->Session->setFlash(__('The projectphase could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectphase->read(null, $id);
		}
	}
	
	public function edit($id = null) {
		$this->Projectphase->id = $id;
		if (!$this->Projectphase->exists()) {
			throw new NotFoundException(__('Invalid projectphase'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectphase->save($this->request->data)) {
				$this->Session->setFlash(__('The projectphase has been saved'));
				$ps = $this->Projectphase->read('stage_id');
				$this->redirect(array('action' => 'index', $ps['Projectphase']['projectstage_id']));
			} else {
				$this->Session->setFlash(__('The projectphase could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectphase->read(null, $id);
		}
	}
	
	public function start($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectphase->id = $id;
		if (!$this->Projectphase->exists()) {
			throw new NotFoundException(__('Invalid projectphase'));
		}
		$this->Projectphase->start($id);
		$this->Session->setFlash(__('Projectphase is started'));
		$this->redirect($this->referer());
	}
	
	public function finish($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectphase->id = $id;
		if (!$this->Projectphase->exists()) {
			throw new NotFoundException(__('Invalid projectphase'));
		}
		
		if ($this->Projectphase->allActionsFinished($id)) {
			$this->Projectphase->saveField('state', 2);
			$this->Session->setFlash(__('Projectphase state is changed to finished'));
		}
		else {
			$this->Session->setFlash(__('Not all actions in the phase are finished'));
		}
		$this->redirect($this->referer());
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectphase->id = $id;
		if (!$this->Projectphase->exists()) {
			throw new NotFoundException(__('Invalid projectphase'));
		}
		
		if ($this->Projectphase->delete()) {
			$this->Session->setFlash(__('Projectphase deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Projectphase was not deleted'));
		$this->redirect($this->referer());
	}
}
