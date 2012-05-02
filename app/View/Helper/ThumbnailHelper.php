<?php
/**
 * Helper to generate thumbnail images dynamically by saving them to the cache.
 * Alternative to phpthumb.
 * 
 * Inspired in http://net.tutsplus.com/tutorials/php/image-resizing-made-easy-with-php/
 * 
 * @author Emerson Soares (dev.emerson@gmail.com)
 * @filesource https://github.com/emersonsoares/ThumbnailsHelper-for-CakePHP
 */
// App::import('Vendor', 'Upload' , array('file' => 'upload'.DS.'class.upload.php'));
class ThumbnailHelper extends AppHelper {

    private $absoluteCachePath = '';
    private $cachePath = '';
    private $newWidth = 150;
    private $newHeight = 225;
    private $srcWidth;
    private $srcHeight;
    private $quality = 80;
    private $path = 'files';
    private $srcImage = '';
    private $srcImageDefault = '/img/preview.jpg';
    private $resizeOption = 'auto';
    private $openedImage = '';
    private $imageResized = '';

    public function render($image, $params) {
        $this->setup($image, $params);

        $path = $this->fixDoubleSlash($this->absoluteCachePath . DS . $this->path . DS . $this->srcImage);        
        $cachePath = $this->fixDoubleSlash($this->absoluteCachePath . DS . $this->cachePath . DS . $this->srcImage);

        // die($path);

        if (file_exists(realpath($cachePath))) {
            return $this->pathSlash( DS .$this->cachePath . DS . $this->srcImage );
        } 
        elseif (file_exists($path)) {
            
            // $this->Upload = new UploadComponent();
            $this->Upload = new UploadComponent(new ComponentCollection());
            $this->Upload->upload($path);

            $this->Upload->file_overwrite = true;
            $this->Upload->file_safe_name = false;
            $this->Upload->image_resize = true;
            $this->Upload->image_convert = 'jpg';
            $this->Upload->jpeg_quality = $this->quality;
            // $this->Upload->image_ratio_y = true;

            $this->Upload->image_x = $this->newWidth;
            $this->Upload->image_y = $this->newHeight;

            switch ($this->resizeOption) {
                case 'crop':
                    $this->Upload->image_ratio_crop = 'C';
                    break;
            }

            $this->Upload->process($this->cachePath.DS); // Caminho a ser enviado o upload

            if (!$this->Upload->processed) {
                $this->error = $this->Upload->error;
               return $this->srcImageDefault; //Imagem padrão em caso de erro
            }

            return $this->pathSlash(DS .$this->cachePath . DS . $this->srcImage);
        }/*else{
            die('poia');
        }*/
    }

    private function setup($image, $params) {
        if (isset($params['path'])) {
            $this->path = $params['path'] . DS;
        }

        if (isset($params['newWidth'])) {
            $this->newWidth = $params['newWidth'];
        }

        if (isset($params['newHeight'])) {
            $this->newHeight = $params['newHeight'];
        }

        if (isset($params['quality'])) {
            $this->quality = $params['quality'];
        }

        if (isset($params['absoluteCachePath'])) {
            $this->absoluteCachePath = $params['absoluteCachePath'];
        } else {
            $this->absoluteCachePath = WWW_ROOT;
        }

        if (isset($params['resizeOption'])) {
            $this->resizeOption = strtolower($params['resizeOption']);
        }

        if (isset($params['cachePath'])) {
            $this->cachePath = $this->pathSlash($params['cachePath'] . DS . $this->newWidth . 'x' . $this->newHeight . DS . $this->quality . DS . $this->resizeOption);
        } else {
            $this->cachePath = $this->pathSlash('cache' . DS . $this->newWidth . 'x' . $this->newHeight . DS . $this->quality . DS . $this->resizeOption);
        }

        $this->srcImage = $image;
    }   

    private function ifExists($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //return the transfer as a string
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);// Pegar o código de resposta
        $header_out = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        
        if($response_code != '404' && $header_out == 'image/jpeg'){
            // header("Content-Type: image/jpeg");
            $this->openedImage = curl_exec($ch);
            return true;
        }

        return false;
    }

    /*
    ** Funções auxiliares para tratamento do path
    */
    private function fixDoubleSlash($path){
        $path = str_replace("\\\\", "\\", $path);
        $path = str_replace("//", "/", $path);
        return $path;
    }

    private function pathBackslash($path){
        $path = str_replace("/", "\\", $path);
        return $path;
    }

    private function pathSlash($path){
        $path = str_replace("\\", "/", $path);
        return $path;
    }

}//end helper