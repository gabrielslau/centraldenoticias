<?php
App::uses('AppController', 'Controller');
/**
 * Anexos Controller
 *
 * @property Anexo $Anexo
 */
class AnexosController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Anexo->recursive = 0;
		$this->set('anexos', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Anexo->id = $id;
		if (!$this->Anexo->exists()) {
			throw new NotFoundException(__('Invalid anexo'));
		}
		$this->set('anexo', $this->Anexo->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Anexo->create();
			if ($this->Anexo->save($this->request->data)) {
				$this->Session->setFlash(__('The anexo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The anexo could not be saved. Please, try again.'));
			}
		}
		$noticias = $this->Anexo->Noticium->find('list');
		$this->set(compact('noticias'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Anexo->id = $id;
		if (!$this->Anexo->exists()) {
			throw new NotFoundException(__('Invalid anexo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Anexo->save($this->request->data)) {
				$this->Session->setFlash(__('The anexo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The anexo could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Anexo->read(null, $id);
		}
		$noticias = $this->Anexo->Noticium->find('list');
		$this->set(compact('noticias'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Anexo->id = $id;
		if (!$this->Anexo->exists()) {
			throw new NotFoundException(__('Invalid anexo'));
		}
		if ($this->Anexo->delete()) {
			$this->Session->setFlash(__('Anexo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Anexo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
