<?php
App::uses('AppModel', 'Model');

class Stage extends AppModel {
	public $displayField = 'name';

	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public $hasMany = array(
		'Projectstage',
			// All projectsteps linked to a projectstage are defaults
		'Projectstep' => array(
			'className' => 'Projectstep',
			'conditions'=>array('projectstage_id'=>0),
			'order'=>'Projectstep.rank ASC'
			),
			// All projectphases linked to a projectstage are defaults
		'Projectphase' => array(
			'className' => 'Projectphase',
			'conditions'=>array('projectstage_id'=>0),
			'order'=>'Projectphase.rank ASC'
			)
	);

}
