<?php
App::uses('AppController', 'Controller');
/**
 * Subscribers Controller
 *
 * @property Subscriber $Subscriber
 */
class SubscribersController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Subscriber->recursive = 0;
		$this->set('subscribers', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		$this->set('subscriber', $this->Subscriber->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subscriber->create();
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		}
		$noticias = $this->Subscriber->Noticium->find('list');
		$this->set(compact('noticias'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Subscriber->read(null, $id);
		}
		$noticias = $this->Subscriber->Noticium->find('list');
		$this->set(compact('noticias'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->Subscriber->delete()) {
			$this->Session->setFlash(__('Subscriber deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Subscriber was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
