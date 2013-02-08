<?php
App::uses('AppModel', 'Model');

class Projectactionfile extends AppModel {

	public $actsAs = array('FileModel'=>array(
		'dir'=>array('files/projectaction'),
		'file_field'=>array('file'),
		'file_db_file'=>array('filename'),
		'file_type_field'=>array('filetype'),
		)
	);

	public $displayField = 'file';

	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'projectaction_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		)
	);

	public $belongsTo = array(
		'User',
		'Projectaction'
	);

}
