<?php
App::uses('AppController', 'Controller');
/**
 * NoticiasCategorias Controller
 *
 * @property NoticiasCategoria $NoticiasCategoria
 */
class NoticiasCategoriasController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->NoticiasCategoria->recursive = 0;
		$this->set('noticiasCategorias', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->NoticiasCategoria->id = $id;
		if (!$this->NoticiasCategoria->exists()) {
			throw new NotFoundException(__('Invalid noticias categoria'));
		}
		$this->set('noticiasCategoria', $this->NoticiasCategoria->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->NoticiasCategoria->create();
			if ($this->NoticiasCategoria->save($this->request->data)) {
				$this->Session->setFlash(__('The noticias categoria has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The noticias categoria could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->NoticiasCategoria->id = $id;
		if (!$this->NoticiasCategoria->exists()) {
			throw new NotFoundException(__('Invalid noticias categoria'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->NoticiasCategoria->save($this->request->data)) {
				$this->Session->setFlash(__('The noticias categoria has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The noticias categoria could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->NoticiasCategoria->read(null, $id);
		}
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
		$this->NoticiasCategoria->id = $id;
		if (!$this->NoticiasCategoria->exists()) {
			throw new NotFoundException(__('Invalid noticias categoria'));
		}
		if ($this->NoticiasCategoria->delete()) {
			$this->Session->setFlash(__('Noticias categoria deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Noticias categoria was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
