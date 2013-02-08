<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class Projectactionmail extends AppModel {

	public $displayField = 'id';

	public $validate = array(
		'subject' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'mail' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		)
	);

	public $belongsTo = array(
		'Projectaction' => array(
			'className' => 'Projectaction',
			'foreignKey' => 'projectaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Contractortype',
		'Contractor'
		);
		
	public $hasMany = array(
		'ContractortypesProjectactionmail',
		'ContractorsProjectactionmail'
		);
		
	
	public function afterSave($create) {
		$this->contain(array('Projectaction'=>array('Projectstep'=>array('Projectstage'))));
		$r = $this->read();
	    if (!empty($r['Projectaction']['Projectstep']['Projectstage']['project_id']) && $create) {
			$this->setSingleDefaultContractors($this->id);
	    }
	}
	
	/*
	set default contractors by contractortypes and the defaults of the council
	delete the contractortypes
		*/
	public function setDefaultContractors($projectstage_id=null) {
		$this->Projectaction->Projectstep->Projectstage->contain(array('Project', 'Projectstep'=>array('Projectaction'=>array('Projectactionmail'=>array('Contractortype')))));
		$projectstage = $this->Projectaction->Projectstep->Projectstage->read(null, $projectstage_id);
		$defaults_list = $this->Contractor->getDefaults($projectstage['Project']['council_id']);
		$projectactionmails = Set::extract('/Projectstep/Projectaction/Projectactionmail', $projectstage);
		$projectactionmails = Set::filter(Set::combine($projectactionmails, '{n}.Projectactionmail.id', '{n}.Projectactionmail.Contractortype.{n}.id'));
		$data = array(); $i=0; foreach ($projectactionmails as $projectactionmail_id => $contractortypes) {
			$data[$i]['Projectactionmail']['id'] = $projectactionmail_id;
			foreach ($contractortypes as $contractortype_id) {
				$contractor_id = $defaults_list[$contractortype_id];
				$data[$i]['Contractor']['Contractor'][] = $contractor_id;
			}
			$data[$i]['Contractortype']['Contractortype'] = array();
			$i++;
		}
		$this->saveAll($data, array('validate'=>false));
	}
	
	/*
	set default contractors by contractortype and the defaults of the council
	delete the contractortypes
		*/
	public function setSingleDefaultContractors($id=null) {
		$this->contain(array('Contractortype', 'Projectaction'=>array('Projectstep'=>array('Projectstage'=>array('Project')))));
		$projectactionmail = $this->read(null, $id);
		$defaults_list = $this->Contractor->getDefaults($projectactionmail['Projectaction']['Projectstep']['Projectstage']['Project']['council_id']);
		$data['Projectactionmail']['id'] = $id;
		foreach ($projectactionmail['Contractortype'] as $key => $contractortype) {
			if (isset($defaults_list[$contractortype['id']])) {
				$data['Contractor']['Contractor'] = $defaults_list[$contractortype['id']];
			}
		}
		$data['Contractortype']['Contractortype'] = array();
		$this->saveAll($data, array('validate'=>false));
	}
	
	/*
	start projectactionmail
	1. get contractor
	2. send mail
	3. change state
		*/
	public function start($id=null) {
		$this->id = $id;
		$this->contain(array('Contractor'));
		$projectactionmail = $this->read();
		$email = new CakeEmail();
		$email->subject('Abode: '.$projectactionmail['Projectactionmail']['mail']);
		foreach ($projectactionmail['Contractor'] as $contractor) {
			$this->ContractorsProjectactionmail->id = $contractor['ContractorsProjectactionmail']['id'];
			$email->to(array($contractor['email']=>$contractor['name']));
	    	$email->template('contractor_action');
			$email->config('default');
		    $email->viewVars(array('message'=>$projectactionmail['Projectactionmail']['mail']));
			try{
				$email->send();
				$this->ContractorsProjectactionmail->saveField('state', 1); // success
				$this->ContractorsProjectactionmail->saveField('last_send', DboSource::expression('NOW()'));
			}
			catch(Exception $e){
				$this->ContractorsProjectactionmail->saveField('state', 2); // failed
			}
			$email->reset();
		}
		return true;
	}
	
	/*
	render preview of mail
		*/
	public function preview($id=null) {
		$this->id = $id;
		$this->contain(array('Contractor'));
		$projectactionmail = $this->read();
		$email = new CakeEmail();
    	$email->template('contractor_action');
		$email->config('debug');
	    $email->viewVars(array('message'=>$projectactionmail['Projectactionmail']['mail']));
	    $send = $email->send();
	    return $send['message'];
	}
	
	public function send_single($contractors_projectactionmail_id=null) {
		$this->ContractorsProjectactionmail->id = $contractors_projectactionmail_id;
		$this->ContractorsProjectactionmail->contain(array('Contractor', 'Projectactionmail'));
		$projectactionmail = $this->ContractorsProjectactionmail->read();
		$email = new CakeEmail();
    	$email->template('contractor_action');
		$email->config('default');
		$email->to(array($projectactionmail['Contractor']['email']=>$projectactionmail['Contractor']['name']));
	    $email->viewVars(array('message'=>$projectactionmail['Projectactionmail']['mail']));
	    try{
			$email->send();
			$this->ContractorsProjectactionmail->saveField('state', 1); // success
			$this->ContractorsProjectactionmail->saveField('last_send', DboSource::expression('NOW()'));
		}
		catch(Exception $e){
			$this->ContractorsProjectactionmail->saveField('state', 2); // failed
		}
		return true;
	}
}
