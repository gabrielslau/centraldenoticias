<?php
App::uses('AppController', 'Controller');
/**
 * NoticiasSubscribers Controller
 *
 * @property NoticiasSubscriber $NoticiasSubscriber
 */
class NoticiasSubscribersController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->NoticiasSubscriber->recursive = 0;
		$this->set('noticiasSubscribers', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->NoticiasSubscriber->id = $id;
		if (!$this->NoticiasSubscriber->exists()) {
			throw new NotFoundException(__('Invalid noticias subscriber'));
		}
		$this->set('noticiasSubscriber', $this->NoticiasSubscriber->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->NoticiasSubscriber->create();
			if ($this->NoticiasSubscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The noticias subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The noticias subscriber could not be saved. Please, try again.'));
			}
		}
		$noticias = $this->NoticiasSubscriber->Noticium->find('list');
		$subscribers = $this->NoticiasSubscriber->Subscriber->find('list');
		$this->set(compact('noticias', 'subscribers'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->NoticiasSubscriber->id = $id;
		if (!$this->NoticiasSubscriber->exists()) {
			throw new NotFoundException(__('Invalid noticias subscriber'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->NoticiasSubscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The noticias subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The noticias subscriber could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->NoticiasSubscriber->read(null, $id);
		}
		$noticias = $this->NoticiasSubscriber->Noticium->find('list');
		$subscribers = $this->NoticiasSubscriber->Subscriber->find('list');
		$this->set(compact('noticias', 'subscribers'));
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
		$this->NoticiasSubscriber->id = $id;
		if (!$this->NoticiasSubscriber->exists()) {
			throw new NotFoundException(__('Invalid noticias subscriber'));
		}
		if ($this->NoticiasSubscriber->delete()) {
			$this->Session->setFlash(__('Noticias subscriber deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Noticias subscriber was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
