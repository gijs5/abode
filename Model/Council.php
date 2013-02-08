<?php
App::uses('AppModel', 'Model');

class Council extends AppModel {

	public $displayField = 'name';

	public $validate = array(
		'councilarea_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	public $belongsTo = array(
		'Councilarea' => array(
			'className' => 'Councilarea',
			'foreignKey' => 'councilarea_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'Project',
		'ContractorsCouncil'
	);
	
	public $hasAndBelongsToMany = array(
		'Contractor'
		);
		
	/*
	Clear all CountractorsCouncil if contractor_id is not selected
		*/
	public function beforeValidate($options=array()){
		if (isset($this->data['ContractorsCouncil'])) {
			foreach ($this->data['ContractorsCouncil'] as $key => $cc) {
				if (empty($cc['contractor_id'])) {
					unset($this->data['ContractorsCouncil'][$key]);
				}
			}
		}
		return true;
	}
	
	/*
	delete all ContractorsCouncil before updating the council
	check Council.id to make sure it is an update and not a create
		*/
	public function beforeSave($options=array()) {
	    if (isset($this->data['Council']['id'])) {
	    	$this->ContractorsCouncil->deleteAll(array('ContractorsCouncil.council_id'=>$this->data['Council']['id']));
	    }
	    return true;
	}
}