<?php
App::uses('AppController', 'Controller');
/**
 * Categorias Controller
 *
 * @property Categoria $Categoria
 */
class CategoriasController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Categoria->recursive = 0;
		$this->set('categorias', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Categoria->id = $id;
		if (!$this->Categoria->exists()) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		$this->set('categoria', $this->Categoria->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Categoria->create();
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash(__('The categoria has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categoria could not be saved. Please, try again.'));
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
		$this->Categoria->id = $id;
		if (!$this->Categoria->exists()) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash(__('The categoria has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categoria could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Categoria->read(null, $id);
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
		$this->Categoria->id = $id;
		if (!$this->Categoria->exists()) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		if ($this->Categoria->delete()) {
			$this->Session->setFlash(__('Categoria deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Categoria was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
