<?php
App::uses('AppController', 'Controller');
class GroupsController extends AppController {

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow(array('redirectLogin')); // allow all to redirectLogin
	}
	
	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}
	
	public function view($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
	}
	
	public function edit($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
		}
	}
	
	// checks logged in group and redirects
	public function redirectLogin() {
		if ($this->Session->read('Auth.User')) {
			echo 'Redirect group to right url.';
			die;
		}
		else {
			$this->Redirect($this->Auth->loginAction);
		}
	}
	
	public function setRights() {
	    $group = $this->Group;
	    //Allow admins to everything
	    $group->id = 1;
	    $this->Acl->allow($group, 'controllers');
	    
	    //Client rights
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    
	    //Contractor rights
	    $group->id = 4;
	    $this->Acl->allow($group, 'controllers');
	    die;
	    /*
		//allow managers to posts and widgets
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Posts');
	    $this->Acl->allow($group, 'controllers/Widgets');
	
	    //allow users to only add and edit on posts and widgets
	    $group->id = 3;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Posts/add');
	    $this->Acl->allow($group, 'controllers/Posts/edit');
	    $this->Acl->allow($group, 'controllers/Widgets/add');
	    $this->Acl->allow($group, 'controllers/Widgets/edit');
	    //we add an exit to avoid an ugly "missing views" error message
	    */
	}
}
