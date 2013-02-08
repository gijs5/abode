<?php
App::uses('AppController', 'Controller');
/**
 * Streettypes Controller
 *
 * @property Streettype $Streettype
 */
class StreettypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Streettype->recursive = 0;
		$this->set('streettypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Streettype->id = $id;
		if (!$this->Streettype->exists()) {
			throw new NotFoundException(__('Invalid streettype'));
		}
		$this->set('streettype', $this->Streettype->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Streettype->create();
			if ($this->Streettype->save($this->request->data)) {
				$this->Session->setFlash(__('The streettype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The streettype could not be saved. Please, try again.'));
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
		$this->Streettype->id = $id;
		if (!$this->Streettype->exists()) {
			throw new NotFoundException(__('Invalid streettype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Streettype->save($this->request->data)) {
				$this->Session->setFlash(__('The streettype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The streettype could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Streettype->read(null, $id);
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
		$this->Streettype->id = $id;
		if (!$this->Streettype->exists()) {
			throw new NotFoundException(__('Invalid streettype'));
		}
		if ($this->Streettype->delete()) {
			$this->Session->setFlash(__('Streettype deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Streettype was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
