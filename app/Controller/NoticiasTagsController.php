<?php
App::uses('AppController', 'Controller');
/**
 * NoticiasTags Controller
 *
 * @property NoticiasTag $NoticiasTag
 */
class NoticiasTagsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->NoticiasTag->recursive = 0;
		$this->set('noticiasTags', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->NoticiasTag->id = $id;
		if (!$this->NoticiasTag->exists()) {
			throw new NotFoundException(__('Invalid noticias tag'));
		}
		$this->set('noticiasTag', $this->NoticiasTag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->NoticiasTag->create();
			if ($this->NoticiasTag->save($this->request->data)) {
				$this->Session->setFlash(__('The noticias tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The noticias tag could not be saved. Please, try again.'));
			}
		}
		$noticias = $this->NoticiasTag->Noticium->find('list');
		$tags = $this->NoticiasTag->Tag->find('list');
		$this->set(compact('noticias', 'tags'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->NoticiasTag->id = $id;
		if (!$this->NoticiasTag->exists()) {
			throw new NotFoundException(__('Invalid noticias tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->NoticiasTag->save($this->request->data)) {
				$this->Session->setFlash(__('The noticias tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The noticias tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->NoticiasTag->read(null, $id);
		}
		$noticias = $this->NoticiasTag->Noticium->find('list');
		$tags = $this->NoticiasTag->Tag->find('list');
		$this->set(compact('noticias', 'tags'));
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
		$this->NoticiasTag->id = $id;
		if (!$this->NoticiasTag->exists()) {
			throw new NotFoundException(__('Invalid noticias tag'));
		}
		if ($this->NoticiasTag->delete()) {
			$this->Session->setFlash(__('Noticias tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Noticias tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
