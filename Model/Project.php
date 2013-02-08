<?php
App::uses('AppModel', 'Model');

class Project extends AppModel {

	public $displayField = 'description';
	public $virtualFields = array(
		'displayname' => 'CONCAT(Project.streetname, " ", Project.streetnumber, ", ", Project.suburb)', // name for displays
		'displaynumber' => 'CONCAT("AB00", Project.id)' // unique order number
	);
	public $default_state = 6;
	public $validate = array(
		'state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'client_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'countrystate_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'streettype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'streetsuffix_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'council_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'streetnumber' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'streetname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'suburb' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'contactname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'contactphone' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	public $belongsTo = array(
		'Client',
		'Countrystate',
		'State',
		'Streettype',
		'Streetsuffix',
		'Council'
	);
	
	public $hasMany = array(
		'Projectphoto',
		'Unit',
		'Projectstage'
	);
	
	public function beforeSave($options = array()) {
	    if (!empty($this->data['Project']['state_id'])) {
	        $this->data['Project']['state_id'] = $this->default_state;
	    }
	    return true;
	}
	
	/*
	Get defaults from: projectsteps, projectphases, projectactions, projectactionmails and contractortypes
	and save in projectstage and make a copy in same tables
	*/
	public function startInStage($id=null, $stage_id=null, $projectsteps=null) {
		if ($this->Projectstage->save(array('Projectstage'=>array('project_id'=>$id,'stage_id'=>$stage_id)))) {
			$projectstage_id = $this->Projectstage->id;
			$this->copyDefaults($projectstage_id, $projectsteps);
			$this->Projectstage->Projectstep->Projectaction->setDefaultContractors($projectstage_id);
			$this->Projectstage->Projectstep->Projectaction->Projectactionmail->setDefaultContractors($projectstage_id);
		}
	}
	
	/*
	copy values from projectsteps, projectactions, projectphases, projectactionmails and contractortypes
	1. Get default data
	2. Create copy of phases
	3. Adjust array with new projectphase_ids
	4. Delete table keys
	5. Save all new array
	*/
	public function copyDefaults($projectstage_id=null, $projectsteps=null) {
		$this->Projectstage->id = $projectstage_id;
		$this->Projectstage->contain(array(
			'Stage'=>array(
				'Projectstep'=>array(
					'conditions'=>array(
						'Projectstep.projectstage_id'=>0,
						'OR'=>array(
							'Projectstep.mandatory'=>1, 
							'Projectstep.id'=>$projectsteps
							)
						),
					'Projectaction'=>array(
						'Projectactionmail'=>array(
							'ContractortypesProjectactionmail'
							)
						)
					),
				'Projectphase'=>array(
					'conditions'=>array(
						'Projectphase.projectstage_id'=>0
						)
					)
				)
			));
		$projectstage = $this->Projectstage->read();
		$projectstage = $this->replaceKeysRecursive($projectstage, array('projectstage_id'), array($projectstage_id));
		foreach ($projectstage['Stage']['Projectphase'] as $projectphase) {
			$id = $projectphase['id'];
			unset($projectphase['id']);
			$this->Projectstage->Projectphase->id = null;
			$this->Projectstage->Projectphase->save($projectphase);
			$new_projectphases[$id] = $this->Projectstage->Projectphase->id;
		}
		foreach ($projectstage['Stage']['Projectstep'] as $key_a => $projectactions) {
			foreach ($projectactions['Projectaction'] as $key_b => $projectaction) {
				if (isset($new_projectphases[$projectaction['projectphase_id']])) {
					$projectstage['Stage']['Projectstep'][$key_a]['Projectaction'][$key_b]['projectphase_id'] = $new_projectphases[$projectaction['projectphase_id']];
				}
			}
		}
		$projectsteps = $this->removeKeysRecursive($projectstage['Stage']['Projectstep'], array('id', 'projectstep_id', 'projectaction_id', 'modified', 'created'));
		$this->Projectstage->Projectstep->saveAll($projectsteps, array('validate'=>false, 'deep'=>true));
	}

}
