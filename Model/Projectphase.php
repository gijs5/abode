<?php
App::uses('AppModel', 'Model');

class Projectphase extends AppModel {

	public $displayField = 'name';
	public $order = 'Projectphase.rank ASC';
	public $state_names = array(0=>'Pending', 1=>'Started', 2=>'Finished');
	
	public $validate = array(
		'stage_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'project_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'rank' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'state' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	
	public $belongsTo = array(
		'Stage',
		'Projectstage'
	);
	public $hasMany = array(
		'Projectaction'
	);
	
	public function beforeDelete($cascade = true) {
		// get all child actions and reset the projectphase_id
		$this->contain(array('Projectaction'));
		$projectphase = $this->read();
		foreach ($projectphase['Projectaction'] as $projectaction) {
			$this->Projectaction->id = $projectaction['id'];
			$this->Projectaction->saveField('projectphase_id', 0);
		}
		return true;
	}
	
	/*
	start projectphase
	1. change state
	2. start projectactions
		*/
	public function start($id=null) {
		$this->id = $id;
		$this->saveField('state', 1);
		$this->contain(array('Projectaction'));
		$projectphase = $this->read();
		foreach ($projectphase['Projectaction'] as $projectaction) {
			$this->Projectaction->start($projectaction['id']);
		}
	}
	
	public function allActionsFinished($id=null) {
		$count = $this->Projectaction->find('count', array(
			'contain'=>false,
			'conditions'=>array('projectphase_id'=>$id, 'state !='=>2)
			));
		return ($count==0);
	}

}
