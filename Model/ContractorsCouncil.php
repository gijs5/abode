<?php
App::uses('AppModel', 'Model');

class ContractorsCouncil extends AppModel {

	public $displayField = 'id';
	public $validate = array(
		'contractortype_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
		),
		'contractor_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
			/*
			'unique_contractortype' => array(
				'rule' => array('unique_contractortype')
			)
				*/
		),
		'council_id' => array(
			'numeric' => array(
				'rule' => array('numeric')
			),
		)
	);
	
	/*
	check if combination of council_id and contractortype_id is unique
	DISABLED: because the data is deleted before every update
	public function unique_contractortype($data) {
		$res = $this->find('count', array(
			'conditions'=>array(
				'contractortype_id'=>$this->data['ContractorsCouncil']['contractortype_id'],
				'council_id'=>$this->data['ContractorsCouncil']['council_id']
				)
			));
		return ($res <= 0);
	}
	*/
}
