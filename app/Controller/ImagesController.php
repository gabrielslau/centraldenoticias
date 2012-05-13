<?php
App::uses('AppController', 'Controller');
/**
 * Noticias Controller
 *
 * @property Noticia $Noticia
 */
class ImagesController extends AppController {

	public $components = array('Upload','Thumbnail','RequestHandler');
	public $helpers = array('Thumbnail');
	public $uses = array();

	public function beforeFilter() {
                parent::beforeFilter();
                $this->set('title_for_layout', 'Imagens');
                $this->Auth->allow('*');
            }

/**
 * cache method
 * 
 * Retorna o endereco da imagem cacheda ou cria uma, para acessos via URL
 *
 * @return void
 */
	public function cache($codigo='',$filename='preview.jpg',$resizeOption='fill',$x=100,$y='') {
		$this->layout = 'ajax';
                $this->autoRender = false;

                $options = array();
                $options['path'] = 'img';
                $options['quality'] = 100;
                $options['newWidth'] = $x;
                $options['resizeOption'] = $resizeOption;

                
                // if($resizeOption == 'crop'){
                	$options['newHeight'] = !empty($y) ? $y : $x; // Iguala à $x para poder fazer o corte
                // }

                if(!empty($codigo) && $filename != 'preview.jpg'){
                	$options['path'] = 'files'.DS.'image'.DS.'noticia'.DS.$codigo;
                }

                $path = $this->Thumbnail->render($filename, $options);

                $respondHeader = true;
                if(!file_exists($path) && !empty($path)){
                        $options['path'] = 'img';
                        $path = $this->Thumbnail->render('preview-ligth.jpg', $options);
                        // $this->RequestHandler->respondAs('Content-type: ' . $this->Upload->file_src_mime);
                }

                if(!empty($path)){
                        $this->Upload = new UploadComponent(new ComponentCollection());
                        $this->Upload->upload($path);

                        header("Content-Type: ". $this->Upload->file_src_mime);
                        $content = $this->Upload->Process();

                        if (!$this->Upload->processed) {
                                echo $this->Upload->error;
                        }else{
                                echo $content;
                        }
                }else{
                        return '';
                }
	}//end method cache()

}//edn class
