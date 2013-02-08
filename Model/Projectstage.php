<?php
App::uses('AppModel', 'Model');

class Projectstage extends AppModel {
	public $displayField = 'id';
	public $state_names = array(0=>'Pending', 1=>'Started', 2=>'Finished');
	
	var $validate = array( 
		"project_id"=>array( 
			"unique"=>array( 
				"rule"=>array("checkUnique", array("project_id", "stage_id")), 
				"message"=>"This project is already started in this stage" 
			) 
		),
		"stage_id"=>array( 
			"unique"=>array( 
				"rule"=>array("checkUnique", array("project_id", "stage_id")), 
				"message"=>"This project is already started in this stage" 
			) 
		)
	); 
	
	public $hasMany = array(
		'Projectstep'=>array(
			'order'=>'Projectstep.rank ASC'
			),
		'Projectphase'=>array(
			'order'=>'Projectphase.rank ASC'
			)
	);
	
	public $belongsTo = array(
		'Project',
		'Stage'
		);
		
	/*
	start projectstage
	1. change state
	3. get first projectphase
	2. start first projectphase
		*/
	public function start($id=null) {
		$this->id = $id;
		$this->saveField('state', 1);
		$first_projectphase = $this->Projectphase->find('first', array(
			'conditions'=>array('projectstage_id'=>$this->id),
			'contain'=>false
			)
		);
		$this->Projectphase->start($first_projectphase['Projectphase']['id']);
	}
}