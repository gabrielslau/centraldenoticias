<?php
App::uses('AppController', 'Controller');
/**
 * Noticias Controller
 *
 * @property Noticia $Noticia
 */
class NoticiasController extends AppController {

	public $components = array('Upload','RequestHandler','Json');
	public $helpers = array('Time', 'Text','CakePtbr.Formatacao','Thumbnail');
	public $paginate = array(
		'contain'=> array(
			'Categoria'=>array(
				'fields' => array('id', 'nome')
			)
		),
		/*'conditions'=>array(
			'Noticia.status'=>true
		),*/
		'order'=>'Noticia.id DESC'
	);

	public function beforeFilter() {
        parent::beforeFilter();
        $this->set('title_for_layout', 'Notícias');
        $this->Auth->allow('tempUploadCapa');
    }

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Noticia->recursive = -1;
		$this->Noticia->Behaviors->attach('Containable');
		$this->paginate['contain'] = array('Categoria','Tag');
		$this->set('noticias', $this->paginate());

		$css_for_layout = array('admin/core/button');
		$this->set(compact('css_for_layout'));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Noticia->id = $id;
		if (!$this->Noticia->exists()) {
			throw new NotFoundException(__('Invalid noticia'));
		}
		$this->set('noticia', $this->Noticia->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {

		// $this->Session->delete('DadosNoticiaAdd');
		$sessao_formulario = $this->Session->read('DadosNoticiaAdd'); // Sessão com os dados do formulário
		$tags = $this->Noticia->Tag->find('list');

		// print_r($sessao_formulario);exit();
		if ($this->request->is('post')) {
			App::import('Vendor', 'goods');
			$goods = new Goods();

			unset(
				$this->request->data['taglist'],
				$this->request->data['nome_Categoria'],
				$this->request->data['nome_Tag'],
				$this->request->data['Noticia']['Filedata']
			);
			// print_r($this->request->data);exit();

			$this->Session->write('DadosNoticiaAdd',$this->request->data); // Grava os dados do formulário para evitar perda de dados acidentais
			$sessao_formulario = $this->Session->read('DadosNoticiaAdd');

			// Filtra os valores vazios
			if(isset($this->request->data['Categoria'])) 
				$this->request->data['Categoria'] = array_filter(array_unique($this->request->data['Categoria']),'isEmpty');
			
			if(isset($this->request->data['Tag'])) 
				$this->request->data['Tag'] = array_filter(array_unique($this->request->data['Tag']),'isEmpty');

			// Organiza o array de assintates para salvar corretamente
			if(isset($this->request->data['Noticia']['SubscriberView']) && !empty($this->request->data['Noticia']['SubscriberView'])){
				$this->request->data['Subscriber']['Subscriber'][] = $this->request->data['Noticia']['SubscriberView'];
				unset($this->request->data['Noticia']['SubscriberView']);
			}

			// Adiciona uma categoria padrão, se nenhuma for informada
			if( !isset( $this->request->data['Categoria'] ) || empty( $this->request->data['Categoria'] ) ){
				$this->request->data['Categoria'][] = '11'; // Categoria GERAL
			}



			// $this->request->data['Noticia']['codigo'] = $this->geracodigo( 'GRL' );

			$codigo = $this->Noticia->Categoria->find('first',array('fields'=>array('codigo'),'conditions'=>array('Categoria.id'=>current($this->request->data['Categoria'])),'recursive'=>'-1'));
			$this->request->data['Noticia']['codigo'] = $this->geracodigo( $codigo['Categoria']['codigo'] );

			$this->request->data['Noticia']['imagem_tmp'] = $this->request->data['Noticia']['imagem'];
			$this->request->data['Noticia']['imagem'] = !empty($this->request->data['Noticia']['imagem']) ? $this->request->data['Noticia']['codigo'].'-'.$goods->geraSenha(2).'.jpg' : '';


			// print_r($this->request->data);exit();
			// Corrige as Tags;
			/*if( isset( $this->request->data['Tag']) ){
				$aux_tags = array();$i=0;
				foreach ($this->request->data['Tag'] as $id => $nome) {
					$aux_tags[$i]['nome'] = $nome;
					if( in_array($nome, $tags) ) $aux_tags[$i]['id'] = array_search($nome, $tags);
					$i++;
				}
				$this->request->data['Tag'] = $aux_tags;
				unset($aux_tags);
			}*/
			/*unset(
				$this->request->data['Noticia']['imagem_tmp'],
				$this->request->data['Noticia']['imagem_default']
			);*/
			// print_r($this->request->data);exit();


			$this->Noticia->set($this->request->data);
			$this->Noticia->validationSet = 'Cadastro';
			if($this->Noticia->validates()){

				$this->Noticia->create();
				if ($this->Noticia->save($this->request->data, array('deep' => true))) {
					$this->Session->delete('DadosNoticiaAdd'); 

					/*echo debug( $this->Noticia->invalidFields() );
					echo debug( $this->Noticia->Categoria->invalidFields() );
					echo debug( $this->Noticia->Tag->invalidFields() );*/


					/*
					** Salvou a notícia, agora transfere as imagens para o diretório final
					*/
					if(!empty( $this->request->data['Noticia']['imagem'] )){
						
						
						$goods->moveFile($this->request->data['Noticia']['imagem_tmp'], $this->request->data['Noticia']['imagem'], $this->request->data['Noticia']['imagem_default'], 'files'.DS.'image'.DS.'noticia'.DS.$this->request->data['Noticia']['codigo'].DS);
					}

					$this->Session->setFlash(__('A Notícia foi salva com sucesso'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('A Notícia não pôde ser salva.'));
				}
			}
			else{
				$this->set('invalidFields', $this->Noticia->invalidFields());
				// print_r($this->Tag->invalidFields());exit();
			}
		}
		// $users = $this->Noticia->User->find('list');
		$categorias = $this->Noticia->Categoria->find('list');
		$subscribers = $this->Noticia->Subscriber->find('list',array('conditions'=>array('id>1')));

		/*$taglist = array();
        foreach ($tags as $id => $nome) {
        	 $taglist[] = '{"id":"'.$id.'","label":"'.$nome.'","value":"'.$nome.'"}';
        }
		$taglist = "[".implode(',', $taglist)."]";*/

		$css_for_layout = array(
			'admin/core/form',
			'admin/core/button',
			'plugins/tipsy/tipsy', 
			'plugins/chosen/chosen', 
			'plugins/uploadify/uploadify', 
			// 'plugins/tagedit/jquery.tagedit',
			'plugins/mobile-switches/mobile-switches'
		);
		$js_for_layout = array(
			'ckeditor/ckeditor',
			'ckeditor/adapters/jquery',
			'plugins/swfobject',
			'plugins/uploadify/jquery.uploadify.v2.1.4.min',
			'plugins/chosen/chosen.jquery.min',
			'plugins/mobile-switches/mobile-switches',
			'plugins/tipsy/jquery.tipsy-min',
			// 'plugins/tagedit/jquery.autoGrowInput',
			// 'plugins/tagedit/jquery.tagedit',
			'View/noticias/admin_add'
		);
		$title_for_layout = 'Adicionar nova Notícia';

		$this->set(compact('categorias', 'tags', 'taglist', 'subscribers', 'css_for_layout','js_for_layout','sessao_formulario', 'title_for_layout'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Noticia->id = $id;
		if (!$this->Noticia->exists()) {
			throw new NotFoundException(__('Invalid noticia'));
		}

		$tags = $this->Noticia->Tag->find('list');

		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Session->write('DadosNoticiaEdit.'.$id,$this->request->data); // Grava os dados do formulário para evitar perda de dados acidentais
			// print_r($this->request->data);exit();
			$sessao_formulario = $this->Session->read('DadosNoticiaEdit.'.$id);

			if( !isset( $this->request->data['Categoria'] ) || empty( $this->request->data['Categoria'] ) ){
				$this->request->data['Categoria'][] = '11'; // Adiciona uma categoria padrão, se não informar nenhuma
			}
			$this->request->data['Categoria'] = array_filter(array_unique($this->request->data['Categoria']),'isEmpty');
			$this->request->data['Tag'] = array_filter(array_unique($this->request->data['Tag']),'isEmpty');//Elimina valores vazios

			App::import('Vendor', 'goods');
			$goods = new Goods();

			if( $this->request->data['Noticia']['imagem'] != $this->request->data['Noticia']['imagem_default'] ){
				$this->request->data['Noticia']['imagem_tmp'] = $this->request->data['Noticia']['imagem'];
				$this->request->data['Noticia']['imagem'] = !empty($this->request->data['Noticia']['imagem']) ? $this->request->data['Noticia']['codigo'].'-'.$goods->geraSenha(2).'.jpg' : '';
			}


			// Corrige as Tags;
			/*if( isset( $this->request->data['Tag']) ){
				$aux_tags = array();$i=0;
				foreach ($this->request->data['Tag'] as $id => $nome) {
					$aux_tags[$i]['nome'] = $nome;
					if( in_array($nome, $tags) ) $aux_tags[$i]['id'] = array_search($nome, $tags);
					$i++;
				}
				$this->request->data['Tag'] = array('Tag'=>$aux_tags);
				unset($aux_tags);
			}*/
			/*unset(
				$this->request->data['Noticia']['imagem_tmp'],
				$this->request->data['Noticia']['imagem_default']
			);*/
			// print_r($this->request->data);exit();



			$this->Noticia->set($this->request->data);
			$this->Noticia->validationSet = 'Cadastro';
			if($this->Noticia->validates()){
				if ($this->Noticia->saveAll($this->request->data)) {

					$this->Session->delete('DadosNoticiaEdit.'.$id);
					/*
					** Salvou a notícia, agora transfere as imagens para o diretório final
					*/
					if(!empty( $this->request->data['Noticia']['imagem']) && $this->request->data['Noticia']['imagem'] != $this->request->data['Noticia']['imagem_default'] ){
						$goods->moveFile($this->request->data['Noticia']['imagem_tmp'], $this->request->data['Noticia']['imagem'], $this->request->data['Noticia']['imagem_default'], 'files'.DS.'image'.DS.'noticia'.DS.$this->request->data['Noticia']['codigo'].DS);
					}

					$this->Session->setFlash(__('The noticia has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The noticia could not be saved. Please, try again.'));
				}
			}
		} else {
			$this->request->data = $this->Noticia->read(null, $id);
			// print_r($this->request->data);exit();
		}

		// $users = $this->Noticia->User->find('list');
		$categorias = $this->Noticia->Categoria->find('list');
		$subscribers = $this->Noticia->Subscriber->find('list',array('conditions'=>array('id>1')));

		/*$taglist = array();
        foreach ($tags as $id => $nome) {
        	 $taglist[] = '{"id":"'.$id.'","label":"'.$nome.'","value":"'.$nome.'"}';
        }
		$taglist = "[".implode(',', $taglist)."]";*/
		

		$css_for_layout = array(
			'admin/core/form',
			'admin/core/button',
			'plugins/tipsy/tipsy', 
			'plugins/chosen/chosen', 
			'plugins/uploadify/uploadify', 
			// 'plugins/tagedit/jquery.tagedit',
			'plugins/mobile-switches/mobile-switches'
		);
		$js_for_layout = array(
			'ckeditor/ckeditor',
			'ckeditor/adapters/jquery',
			'plugins/swfobject',
			'plugins/uploadify/jquery.uploadify.v2.1.4.min',
			'plugins/chosen/chosen.jquery.min',
			'plugins/mobile-switches/mobile-switches',
			'plugins/tipsy/jquery.tipsy-min',
			// 'plugins/tagedit/jquery.autoGrowInput',
			// 'plugins/tagedit/jquery.tagedit',
			'View/noticias/admin_add'
		);

		$this->set(compact('categorias','tags','taglist','subscribers','css_for_layout','js_for_layout','sessao_formulario'));

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
		$this->Noticia->id = $id;
		if (!$this->Noticia->exists()) {
			throw new NotFoundException(__('Invalid noticia'));
		}
		
		// $this->request->data = $this->Noticia->read();
		if ($this->Noticia->delete()) {
			/*App::uses('Folder', 'Utility');
			$folder = new Folder('files'.DS.'image'.DS.'noticia'.DS.$this->request->data['Noticia']['codigo'].DS);
			$folder->delete();
*/
			$this->Session->setFlash(__('Noticia deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Noticia was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 *	Função recursiva para criação de código da notícia
 */
	private function geracodigo($prefix = 'GRL'){
		App::import('Vendor', 'goods');

		$goods = new Goods();
		$newcod = $prefix.$goods->geraSenha(4);
		$jatem = $this->Noticia->findByCodigo($newcod);
		if(!empty($jatem)){
			//	Se o código criado já existir, cria um novo e testa novamente
			$newcod = $this->geracodigo($prefix);
		}
		return $newcod;
	}	

/**
 * tempUpload method
 *
 * Faz o upload de um arquivo para uma pasta temporaria
 * 
 * @return void
 */
	public function tempUploadCapa() {
        $this->layout = 'ajax';
        $this->autoRender = false;

        /*$json = array();
        $json["status"] = "erro";
		$json["msg"]    = "poiab";
		die(json_encode($json));*/

		//if (isset($this->params['form']['Filedata'])) {
		if (!empty($_FILES)) {	
			$json    = array();
			$minSize = "1024"; //1Kb
			$this->Upload->upload($_FILES['Filedata']);
			
			//Tamanhos minimos
			if($this->Upload->image_src_x < 100 || $this->Upload->image_src_y < 100 ){
				$json["status"] = "erro";
				$json["msg"]    = "Imagem muito pequena: tem que ter mais de 100px";
				die(json_encode($json));
			}
			if($this->Upload->file_src_size <= $minSize) {
				$json["status"] = "erro";
				$json["msg"]    = "O arquivo é muito pequeno: tem que ter mais de 1Kb";
				die(json_encode($json));
			}

			// $path                             = $this->webroot."app/webroot/files/tmp/";
			// $path                             = $this->webroot."files/tmp/";
			$path                             = "files/tmp/";
			$pathpreview                      = $this->webroot.$path;
			
			$this->Upload->file_name_body_pre = 'temporary_';
			$this->Upload->file_max_size      = '6291456'; //6MB
			$this->Upload->image_convert      = 'jpg';
			$this->Upload->jpeg_quality       = 100;
			// $this->Upload->image_resize       = true;
			$this->Upload->image_ratio        = true;
			// $this->Upload->image_ratio_y      = true;
			$this->Upload->image_x            = 1280;
			// $this->Upload->image_y            = 1280;
			$this->Upload->process($path); // Caminho a ser enviado o upload
			
			if ($this->Upload->processed) {
				//$json = array();
				$json["status"]  = "ok";
				$json["imagem"]  = $this->Upload->file_dst_name;
				$json['path']    = $path;
				$json["msg"]     = 'Deu certo';
				$json['preview'] = $pathpreview.$this->Upload->file_dst_name;
				$json["x"]       = $this->Upload->image_dst_x;
				$json["y"]       = $this->Upload->image_dst_y;
				$this->Upload->clean();
				
				die(json_encode($json));
			} else {
				$json["status"] = "erro";
				$json["msg"]    = $this->Upload->error;
				die(json_encode($json));
			}
		}//end if !DATA
		else{
			$json["status"] = "erro";
			$json["msg"]    = 'Nenhum arquivo foi selecionado';
			die(json_encode($json));
		}//end EMPTY $_FILES
	}//end action tempUpload()

}//edn class
