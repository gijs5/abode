<?php
App::uses('AppController', 'Controller');
/**
 * Countrystates Controller
 *
 * @property Countrystate $Countrystate
 */
class CountrystatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Countrystate->recursive = 0;
		$this->set('countrystates', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Countrystate->id = $id;
		if (!$this->Countrystate->exists()) {
			throw new NotFoundException(__('Invalid countrystate'));
		}
		$this->set('countrystate', $this->Countrystate->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Countrystate->create();
			if ($this->Countrystate->save($this->request->data)) {
				$this->Session->setFlash(__('The countrystate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The countrystate could not be saved. Please, try again.'));
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
		$this->Countrystate->id = $id;
		if (!$this->Countrystate->exists()) {
			throw new NotFoundException(__('Invalid countrystate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Countrystate->save($this->request->data)) {
				$this->Session->setFlash(__('The countrystate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The countrystate could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Countrystate->read(null, $id);
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
		$this->Countrystate->id = $id;
		if (!$this->Countrystate->exists()) {
			throw new NotFoundException(__('Invalid countrystate'));
		}
		if ($this->Countrystate->delete()) {
			$this->Session->setFlash(__('Countrystate deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Countrystate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
