<?php
App::uses('AppController', 'Controller');
/**
 * Stages Controller
 *
 * @property Stage $Stage
 */
class StagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Stage->recursive = 0;
		$this->set('stages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Stage->id = $id;
		if (!$this->Stage->exists()) {
			throw new NotFoundException(__('Invalid stage'));
		}
		$this->set('stage', $this->Stage->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Stage->create();
			if ($this->Stage->save($this->request->data)) {
				$this->Session->setFlash(__('The stage has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stage could not be saved. Please, try again.'));
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
		$this->Stage->id = $id;
		if (!$this->Stage->exists()) {
			throw new NotFoundException(__('Invalid stage'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Stage->save($this->request->data)) {
				$this->Session->setFlash(__('The stage has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stage could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Stage->read(null, $id);
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
		$this->Stage->id = $id;
		if (!$this->Stage->exists()) {
			throw new NotFoundException(__('Invalid stage'));
		}
		if ($this->Stage->delete()) {
			$this->Session->setFlash(__('Stage deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Stage was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
