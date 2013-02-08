<?php
App::uses('AppController', 'Controller');
/**
 * Streetsuffixes Controller
 *
 * @property Streetsuffix $Streetsuffix
 */
class StreetsuffixesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Streetsuffix->recursive = 0;
		$this->set('streetsuffixes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Streetsuffix->id = $id;
		if (!$this->Streetsuffix->exists()) {
			throw new NotFoundException(__('Invalid streetsuffix'));
		}
		$this->set('streetsuffix', $this->Streetsuffix->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Streetsuffix->create();
			if ($this->Streetsuffix->save($this->request->data)) {
				$this->Session->setFlash(__('The streetsuffix has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The streetsuffix could not be saved. Please, try again.'));
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
		$this->Streetsuffix->id = $id;
		if (!$this->Streetsuffix->exists()) {
			throw new NotFoundException(__('Invalid streetsuffix'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Streetsuffix->save($this->request->data)) {
				$this->Session->setFlash(__('The streetsuffix has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The streetsuffix could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Streetsuffix->read(null, $id);
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
		$this->Streetsuffix->id = $id;
		if (!$this->Streetsuffix->exists()) {
			throw new NotFoundException(__('Invalid streetsuffix'));
		}
		if ($this->Streetsuffix->delete()) {
			$this->Session->setFlash(__('Streetsuffix deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Streetsuffix was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
