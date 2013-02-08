<?php
App::uses('AppModel', 'Model');

class Projectaction extends AppModel {

	public $displayField = 'name';
	public $state_names = array(0=>'Pending', 1=>'Started', 2=>'Finished');
	public $order = 'Projectaction.rank ASC';
	public $validate = array(
		'duration' => array(
			'numeric' => array(
				'rule' => array('naturalNumber', true),
				'message' => 'Fill in a duration',
				'allowEmpty' => false
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		)
	);
	
	public $belongsTo = array(
		'Projectstep',
		'Projectphase',
		'Contractor',
		'Contractortype'
	);
	
	public $hasMany = array(
		'Projectactionmail'=>array(
			'dependent' => true
			),
		'Projectactionfile'
	);
	
	public function afterSave($create) {
		$this->contain(array('Projectstep'=>array('Projectstage')));
		$r = $this->read();
	    if (!empty($r['Projectstep']['Projectstage']['project_id']) && $create) {
			$this->setSingleDefaultContractors($this->id);
	    }
	}
	
	/*
	set default contractors in projectactions by projectstage
		*/
	public function setDefaultContractors($projectstage_id=null) {
		$this->Projectstep->Projectstage->contain(array('Project', 'Projectstep'=>array('Projectaction')));
		$projectstage = $this->Projectstep->Projectstage->read(null, $projectstage_id);
		$defaults_list = $this->Contractor->getDefaults($projectstage['Project']['council_id']);
		$projectactions = Set::extract('/Projectstep/Projectaction', $projectstage);
		foreach ($projectactions as $projectaction) {
			$found_contractor_id = @$defaults_list[$projectaction['Projectaction']['contractortype_id']];
			if (isset($projectaction['Projectaction']['id']) && isset($found_contractor_id)) {
				$this->id = $projectaction['Projectaction']['id'];
				$this->saveField('contractor_id', $found_contractor_id);
				$this->saveField('contractortype_id', 0); // unset contractortype, because not needed anymore
			}
		}
	}
	
	/*
	set default contractor in single projectaction
		*/
	public function setSingleDefaultContractors($id=null) {
		$this->id = $id;
		$this->contain(array('Projectstep'=>array('Projectstage'=>array('Project'))));
		$projectaction = $this->read();
		$defaults_list = $this->Contractor->getDefaults($projectaction['Projectstep']['Projectstage']['Project']['council_id']);
		$this->saveField('contractor_id', $defaults_list[$projectaction['Projectaction']['contractortype_id']]);
		$this->saveField('contractortype_id', 0); // unset contractortype, because not needed anymore
	}
	
	/*
	start projectaction
	1. change state
	2. start projectactionsmails
		*/
	public function start($id=null) {
		$this->id = $id;
		$this->saveField('state', 1);
		$this->contain(array('Projectactionmail'));
		$projectaction = $this->read();
		foreach ($projectaction['Projectactionmail'] as $projectactionmail) {
			$this->Projectactionmail->start($projectactionmail['id']);
		}
	}

}
