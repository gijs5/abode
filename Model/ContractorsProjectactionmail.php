<?php
App::uses('AppModel', 'Model');

class ContractorsProjectactionmail extends AppModel {

	public $displayField = 'id';
	public $state_names = array(0=>'Pending', 1=>'Sending success', 2=>'Sending failed');

	public $validate = array(
		'state' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
	
	public $belongsTo = array('Contractor', 'Projectactionmail');
}
