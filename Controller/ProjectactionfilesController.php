<?php
App::uses('AppController', 'Controller');

class ProjectactionfilesController extends AppController {


	public function index($projectaction_id=null) {
		$this->Projectactionfile->Projectaction->id = $projectaction_id;
		if (!$this->Projectactionfile->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		$this->Projectactionfile->Projectaction->contain(array(
			'Projectactionfile'=>array(
				'User'
				),
			'Projectphase'=>array(
				'Projectstage'=>array(
					'Stage',
					'Project'
					)
				)
			)
		);
		$projectaction = $this->Projectactionfile->Projectaction->read();
		$this->set(compact('projectaction'));
	}
	
	public function add($projectaction_id=null) {
		$this->Projectactionfile->Projectaction->id = $projectaction_id;
		if (!$this->Projectactionfile->Projectaction->exists()) {
			throw new NotFoundException(__('Invalid projectaction'));
		}
		
		if ($this->request->is('post')) {
			$this->request->data['Projectactionfile']['projectaction_id'] = $projectaction_id;
			$this->request->data['Projectactionfile']['user_id'] = $this->Auth->user('id');
			if ($this->Projectactionfile->save($this->request->data)) {
				$this->Session->setFlash(__('The file has been saved'));
				$this->redirect(array('action' => 'index', $projectaction_id));
			} else {
				$this->Session->setFlash(__('The file could not be saved. Please, try again.'));
			}
		}
	}
	
	public function edit($id = null) {
		$this->Projectactionfile->id = $id;
		if (!$this->Projectactionfile->exists()) {
			throw new NotFoundException(__('Invalid Projectactionfile'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projectactionfile->save($this->request->data)) {
				$this->Session->setFlash(__('The Projectactionfile has been saved'));
				$pa = $this->Projectactionfile->read('projectaction_id');
				$this->redirect(array('action' => 'index', $pa['Projectactionfile']['projectaction_id']));
			} else {
				$this->Session->setFlash(__('The Projectactionfile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Projectactionfile->read();
		}
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectactionfile->id = $id;
		if (!$this->Projectactionfile->exists()) {
			throw new NotFoundException(__('Invalid Projectactionfile'));
		}
		if ($this->Projectactionfile->delete()) {
			$this->Session->setFlash(__('Projectactionfile deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Projectactionfile was not deleted'));
		$this->redirect($this->referer());
	}
}
