<?php
App::uses('AppController', 'Controller');

class ProjectstepsController extends AppController {

	public function index($projectstage_id=null) {
		$this->Projectstep->Projectstage->id = $projectstage_id;
		if (!$this->Projectstep->Projectstage->exists()) {
			throw new NotFoundException(__('Invalid projectstage'));
		}
		$this->Projectstep->Projectstage->contain(array('Projectstep', 'Project', 'Stage'));
		$projectstage = $this->Projectstep->Projectstage->read(null);
		
		$this->set(compact('projectstage'));
	}
	
	public function defaults($stage_id=null) {
		$this->Projectstep->Stage->id = $stage_id;
		if (!$this->Projectstep->Stage->exists()) {
			throw new NotFoundException(__('Invalid stage'));
		}
		$this->Projectstep->Stage->contain(array('Projectstep'));
		$stage = $this->Projectstep->Stage->read(null);
		
		$this->set(compact('stage'));
	}
	
	public function adddefault($stage_id=null) {
		if ($this->request->is('post')) {
			$this->Projectstep->create();
			$this->request->data['Projectstep']['stage_id'] = $stage_id;
			if ($this->Projectstep->save($this->request->data)) {
				$this->Session->setFlash(__('The projectstep has been saved'));
				$this->redirect(array('action' => 'defaults', $stage_id));
			} else {
				$this->Session->setFlash(__('The projectstep could not be saved. Please, try again.'));
			}
		}
	}
	
	public function add($projectstage_id=null) {
		if ($this->request->is('post')) {
			$this->Projectstep->create();
			$this->request->data['Projectstep']['projectstage_id'] = $projectstage_id;
			if ($this->Projectstep->save($this->request->data)) {
				$this->Session->setFlash(__('The projectstep has been saved'));
				$this->redirect(array('action' => 'defaults', $stage_id));
			} else {
				$this->Session->setFlash(__('The projectstep could not be saved. Please, try again.'));
			}
		}
	}

	public function editdefault($id = null) {
		$this->Projectstep->id = $id;
		if (!$this->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectstep->save($this->request->data)) {
				$this->Session->setFlash(__('The projectstep has been saved'));
				$p = $this->Projectstep->read();
				$this->redirect(array('action' => 'defaults', $p['Projectstep']['stage_id']));
			} else {
				$this->Session->setFlash(__('The projectstep could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectstep->read(null, $id);
		}
	}
	
	public function edit($id = null) {
		$this->Projectstep->id = $id;
		if (!$this->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectstep->save($this->request->data)) {
				$this->Session->setFlash(__('The projectstep has been saved'));
				$p = $this->Projectstep->read();
				$this->redirect(array('action' => 'index', $p['Projectstep']['projectstage_id']));
			} else {
				$this->Session->setFlash(__('The projectstep could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectstep->read(null, $id);
		}
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectstep->id = $id;
		if (!$this->Projectstep->exists()) {
			throw new NotFoundException(__('Invalid projectstep'));
		}
		if ($this->Projectstep->delete()) {
			$this->Session->setFlash(__('Projectstep deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Projectstep was not deleted'));
		$this->redirect($this->referer());
	}
	
	public function sort() {
		$neworder = explode(',', $this->params['data']['newOrder']);
		
		foreach ($neworder as $rank => $value) {
			if (substr($value, 0, 11)=='projectstep') {
				$id = str_replace('projectstep_', '', $value);
				$this->Projectstep->id = $id;
				$this->Projectstep->saveField('rank', $rank);
			}
		}
		echo 'saved';
		die;
	}
}
