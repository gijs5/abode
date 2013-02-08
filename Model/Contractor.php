<?php
App::uses('AppModel', 'Model');
/**
 * Contractor Model
 *
 * @property User $User
 * @property Council $Council
 * @property Contractortype $Contractortype
 * @property Projectstep $Projectstep
 */
class Contractor extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $group_id = 4;

/**
 * Validation rules
 *
 * @var array
 */
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
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'This name has already been taken.'
			),
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
			'email' => array(
				'rule' => array('email')
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'This name has already been taken.'
			),
		),
		'phone' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
			'phone' => array(
				'rule' => array('phone')
			)
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty')
			)
		),

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Contractortype'
	);
	
	public $hasAndBelongsToMany = array(
		'Council',
		'Projectactionmail'
		);
	
	public function beforeDelete($cascade = true) {
		$this->contain(false);
		$contractor = $this->read();
		$this->User->delete($contractor['Contractor']['user_id']);
		return true;
	}
	
	/*
	get default contractors by council
		*/
	public function getDefaults($council_id=null) {
		$cc = $this->Council->ContractorsCouncil->find('all', array(
			'conditions'=>array('ContractorsCouncil.council_id'=>$council_id)
			));
		return Set::combine($cc, '{n}.ContractorsCouncil.contractortype_id', '{n}.ContractorsCouncil.contractor_id');
	}

}
