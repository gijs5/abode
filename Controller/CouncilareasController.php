<?php
App::uses('AppController', 'Controller');
/**
 * Councilareas Controller
 *
 * @property Councilarea $Councilarea
 */
class CouncilareasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Councilarea->recursive = 0;
		$this->set('councilareas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Councilarea->id = $id;
		if (!$this->Councilarea->exists()) {
			throw new NotFoundException(__('Invalid councilarea'));
		}
		$this->set('councilarea', $this->Councilarea->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Councilarea->create();
			if ($this->Councilarea->save($this->request->data)) {
				$this->Session->setFlash(__('The councilarea has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The councilarea could not be saved. Please, try again.'));
			}
		}
		$countrystates = $this->Councilarea->Countrystate->find('list');
		$this->set(compact('countrystates'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Councilarea->id = $id;
		if (!$this->Councilarea->exists()) {
			throw new NotFoundException(__('Invalid councilarea'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Councilarea->save($this->request->data)) {
				$this->Session->setFlash(__('The councilarea has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The councilarea could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Councilarea->read(null, $id);
		}
		$countrystates = $this->Councilarea->Countrystate->find('list');
		$this->set(compact('countrystates'));
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
		$this->Councilarea->id = $id;
		if (!$this->Councilarea->exists()) {
			throw new NotFoundException(__('Invalid councilarea'));
		}
		if ($this->Councilarea->delete()) {
			$this->Session->setFlash(__('Councilarea deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Councilarea was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
