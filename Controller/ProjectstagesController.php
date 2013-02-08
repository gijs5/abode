<?php
App::uses('AppController', 'Controller');

class ProjectstagesController extends AppController {

	public function index($project_id=null) {
		$this->Projectstage->Project->id = $project_id;
		if (!$this->Projectstage->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->Projectstage->Project->contain(array('Projectstage'=>array('Stage')));
		$project = $this->Projectstage->Project->read(null);
		$state_names = $this->Projectstage->state_names;
		$stages = $this->Projectstage->Stage->find('list');
		$existing_stages = Set::extract($project, '/Projectstage/Stage/id');
		$stages = $this->Projectstage->removeKeysRecursive($stages, $existing_stages, false);
		$this->set(compact('project', 'state_names', 'stages'));
	}
	
	public function add($project_id=null, $stage_id=null) {
		$this->Projectstage->Project->id = $project_id;
		if (!$this->Projectstage->Project->exists()) {
			throw new NotFoundException(__('Invalid Project'));
		}
		$this->Projectstage->Stage->id = $stage_id;
		if (!$this->Projectstage->Stage->exists()) {
			throw new NotFoundException(__('Invalid Stage'));
		}
		
		if ($this->request->is('post')) {
			$projectsteps = $this->request->data['Projectsteps'];
			$this->Projectstage->Project->startInStage($project_id, $stage_id, $projectsteps);
			$this->redirect(array('action'=>'index', $project_id));
		}
		
		$this->Projectstage->Stage->contain(array('Projectstep'=>array('order'=>'mandatory DESC')));
		$stage = $this->Projectstage->Stage->read();
		$stage['Projectstep'] = Set::combine($stage['Projectstep'], '{n}.id', '{n}', '{n}.mandatory');
		$this->set(compact('stage'));
	}
	
	public function status_overview($id=null) {
		$this->Projectstage->id = $id;
		if (!$this->Projectstage->exists()) {
			throw new NotFoundException(__('Invalid projectstage'));
		}
		$this->Projectstage->contain(array(
			'Projectphase'=>array(
				'Projectaction'=>array(
					'Projectactionmail'=>array(
						'ContractorsProjectactionmail'=>array(
							'Contractor'
							),
						
						)
					)
				)
			),
			'Stage',
			'Project'
		);
		$projectstage = $this->Projectstage->read();
		$phase_state_names = $this->Projectstage->Projectphase->state_names;
		$action_state_names = $this->Projectstage->Projectphase->Projectaction->state_names;
		$mail_state_names = $this->Projectstage->Projectphase->Projectaction->Projectactionmail->ContractorsProjectactionmail->state_names;
		$this->set(compact('projectstage', 'phase_state_names', 'action_state_names', 'mail_state_names'));
	}
	
	public function check($id=null) {
		$this->Projectstage->id = $id;
		if (!$this->Projectstage->exists()) {
			throw new NotFoundException(__('Invalid projectstage'));
		}
		$this->Projectstage->contain(array(
			'Projectstep'=>array(
				'Projectaction'=>array(
					'conditions'=>array('Projectaction.projectphase_id'=>0)
					)
				)
			),
			'Stage'
		);
		$projectstage = $this->Projectstage->read();
		$actions_not_in_phase = Set::extract($projectstage, '/Projectstep/Projectaction/name');
		$this->set(compact('actions_not_in_phase', 'projectstage'));
	}
	
	/*
	activate projectstage
	1. start projectstage by changing state
		*/
	public function start() {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Projectstage->id = $this->request->data['Projectstage']['id'];
		if (!$this->Projectstage->exists()) {
			throw new NotFoundException(__('Invalid projectstage'));
		}
		$this->Projectstage->start($this->Projectstage->id);
		$this->redirect(array('action'=>'status_overview', $this->Projectstage->id));
	}
}