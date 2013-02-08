<?php
App::uses('AppModel', 'Model');
/**
 * State Model
 *
 * @property Project $Project
 */
class State extends AppModel {

	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		)
	);
	public $displayField = 'name';
	
	public $hasMany = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'state_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
