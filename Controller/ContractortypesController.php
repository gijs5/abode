<?php
App::uses('AppController', 'Controller');
/**
 * Contractortypes Controller
 *
 * @property Contractortype $Contractortype
 */
class ContractortypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Contractortype->recursive = 0;
		$this->set('contractortypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Contractortype->id = $id;
		if (!$this->Contractortype->exists()) {
			throw new NotFoundException(__('Invalid contractortype'));
		}
		$this->set('contractortype', $this->Contractortype->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contractortype->create();
			if ($this->Contractortype->save($this->request->data)) {
				$this->Session->setFlash(__('The contractortype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contractortype could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Contractortype->id = $id;
		if (!$this->Contractortype->exists()) {
			throw new NotFoundException(__('Invalid contractortype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contractortype->save($this->request->data)) {
				$this->Session->setFlash(__('The contractortype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contractortype could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Contractortype->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Contractortype->id = $id;
		if (!$this->Contractortype->exists()) {
			throw new NotFoundException(__('Invalid contractortype'));
		}
		if ($this->Contractortype->delete()) {
			$this->Session->setFlash(__('Contractortype deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contractortype was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
