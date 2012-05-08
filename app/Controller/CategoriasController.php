<?php
App::uses('AppController', 'Controller');
/**
 * Categorias Controller
 *
 * @property Categoria $Categoria
 */
class CategoriasController extends AppController {

	public $components = array('RequestHandler');
	public $paginate = array(
		'order'=>'Categoria.id DESC'
	);

	public function beforeFilter() {
        parent::beforeFilter();

        $this->set('title_for_layout', 'Categorias');
    }
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Categoria->recursive = 0;
		$this->set('categorias', $this->paginate());

		$css_for_layout = array('admin/core/button');
		$this->set(compact('css_for_layout'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Categoria->id = $id;
		if (!$this->Categoria->exists()) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		$this->set('categoria', $this->Categoria->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if($this->request->is('ajax')){
			$this->layout     = 'ajax';
			$this->autoRender = false;
		}


		if ($this->request->is('post') || $this->request->is('ajax')) {

			$this->Categoria->set($this->request->data);
			$this->Categoria->validationSet = 'Cadastro';
			if($this->Categoria->validates()){
				// print_r($this->request->data);exit();
				$this->Categoria->create();
				if ($this->Categoria->save($this->request->data)) {
					
					if($this->request->is('ajax')){
						$json["status"] = "ok";
						$json["id"]     = $this->Categoria->id;
						$json["nome"]   = $this->request->data['Categoria']['nome'];
						die(json_encode($json));
					}else{
						$this->Session->setFlash(__('The categoria has been saved'));
						$this->redirect(array('action' => 'index'));
					}
				} else {
					if($this->request->is('ajax')){
						$json["status"] = "erro";
						$json["msg"]     = __('The %s could not be saved. Please, try again.','Categoria');
						die(json_encode($json));
					}
					else $this->Session->setFlash(__('The categoria could not be saved. Please, try again.'));
				}
			}
			else{
				if($this->request->is('ajax')){
					$json["msg"] = '';
					// print_r($this->Categoria->invalidFields());
					foreach ($this->Categoria->invalidFields() as $key => $value) {
						$json["msg"] .= $value[0].'<br />';
					}

					$json["status"] = "erro";
					die(json_encode($json));
				}
				else $this->set('invalidFields', $this->Categoria->invalidFields());
				// print_r($this->Categoria->invalidFields());exit();
			}
		}

		$title_for_layout = "Cadastrar nova Categoria";
		$css_for_layout   = array('admin/core/form','admin/core/button');
		$this->set(compact('title_for_layout','css_for_layout'));
	}//end action admin_add()

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Categoria->id = $id;
		if (!$this->Categoria->exists()) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$new_slug = strtolower( Inflector::slug( $this->request->data['Categoria']['nome'] ) );
			if($new_slug != $this->request->data['Categoria']['slug']) {
				$this->request->data['Categoria']['slug'] = strtolower( Inflector::slug( $this->request->data['Categoria']['nome'] ) );
			}
			unset($new_slug);

			$this->Categoria->set($this->request->data);
			$this->Categoria->validationSet = 'Cadastro';
			if($this->Categoria->validates()){
				if ($this->Categoria->save($this->request->data)) {
					$this->Session->setFlash(__('The categoria has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The categoria could not be saved. Please, try again.'));
				}
			}
			else{
				$this->set('invalidFields', $this->Categoria->invalidFields());
				// print_r($this->Categoria->invalidFields());exit();
			}
		} else {
			$this->Categoria->recursive = 0;
			$this->request->data = $this->Categoria->read(null, $id);
		}

		$title_for_layout = "Atualizar Categoria";
		$css_for_layout   = array('admin/core/form','admin/core/button');
		$this->set(compact('title_for_layout','css_for_layout'));

		$this->render('admin_add');
	}//end action admin_edit()

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
