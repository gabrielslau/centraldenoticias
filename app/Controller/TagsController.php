<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 */
class TagsController extends AppController {

	public $components = array('RequestHandler','Json');

	public function beforeFilter() {
        parent::beforeFilter();

        $this->set('title_for_layout', 'Tags');
    }


    /*public function taglist(){
		$this->layout     = 'ajax';
		$this->autoRender = false;
		
		$tags             = $this->Tag->find('list');
		$taglist          = array();

        foreach ($tags as $id => $nome) {
        	 $taglist[] = '{"id":"'.$id.'","label":"'.$nome.'","value":"'.$id.'"}';
        }

		echo $this->Json->encode($taglist);
    }*/


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());

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
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if($this->request->is('ajax')){
			$this->layout     = 'ajax';
			$this->autoRender = false;
		}


		// print_r($this->request->data);exit;
		if ($this->request->is('post') || $this->request->is('ajax')) {

			$this->Tag->set($this->request->data);
			$this->Tag->validationSet = 'Cadastro';
			if($this->Tag->validates()){
				$this->Tag->create();
				if ($this->Tag->save($this->request->data)) {
					
					if($this->request->is('ajax')){
						$json["status"] = "ok";
						$json["id"]     = $this->Tag->id;
						$json["nome"]   = $this->request->data['Tag']['nome'];
						die(json_encode($json));
					}else{
						$this->Session->setFlash(__('The tag has been saved'));
						$this->redirect(array('action' => 'index'));
					}
				} else {
					if($this->request->is('ajax')){
						$json["status"] = "erro";
						$json["msg"]     = __('The %s could not be saved. Please, try again.','Tag');
						die(json_encode($json));
					}
					else $this->Session->setFlash(__('The categoria could not be saved. Please, try again.'));
				}
			}
			else{
				if($this->request->is('ajax')){
					$json["msg"] = '';
					foreach ($this->Tag->invalidFields() as $key => $value) {
						$json["msg"] .= $value[0].'<br />';
					}

					$json["status"] = "erro";
					die(json_encode($json));
				}
				else $this->set('invalidFields', $this->Tag->invalidFields());
				// print_r($this->Tag->invalidFields());exit();
			}
		}

		$title_for_layout = "Cadastrar nova Tag";
		$css_for_layout   = array('admin/core/form','admin/core/button');
		$this->set(compact('title_for_layout','css_for_layout'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$new_slug = strtolower( Inflector::slug( $this->request->data['Tag']['nome'] ) );
			if($new_slug != $this->request->data['Tag']['slug']) {
				$this->request->data['Tag']['slug'] = strtolower( Inflector::slug( $this->request->data['Tag']['nome'] ) );
			}
			unset($new_slug);

			$this->Tag->set($this->request->data);
			$this->Tag->validationSet = 'Cadastro';
			if($this->Tag->validates()){
				if ($this->Tag->save($this->request->data)) {
					$this->Session->setFlash(__('The tag has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The tag could not be saved. Please, try again.'));
				}
			}
			else{
				$this->set('invalidFields', $this->Tag->invalidFields());
				// print_r($this->Tag->invalidFields());exit();
			}
		} else {
			$this->Tag->recursive = 0;
			$this->request->data = $this->Tag->read(null, $id);
		}

		$title_for_layout = "Atualizar Tag";
		$css_for_layout   = array('admin/core/form','admin/core/button');
		$this->set(compact('title_for_layout','css_for_layout'));

		$this->render('admin_add');
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
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid tag'));
		}
		if ($this->Tag->delete()) {
			$this->Session->setFlash(__('Tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
