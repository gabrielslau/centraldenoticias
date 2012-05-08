<?php
/**
 * goods.php - PHP implementation of Douglas Crockford's JSMin.
 *
 * Collection of a lot of useful functions to use in your application.
 *
 * --
 * Author: Gabriel Lau <twitter.com/okatsuralau>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * The Software shall be used for Good, not Evil.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * --
 *
 * @package Goods
 * @author Gabriel Lau <twitter.com/okatsuralau>
 * @copyright 2012 Gabriel Lau <twitter.com/okatsuralau>
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @version 1.0.0 (2012-05-04)
 * @link https://github.com/okatsuralau/goods/
 */

class Goods {
  /**
   * Constructor
   *
   */
  public function __construct() {}


  /*
  ** Transfere o arquivo para o destino final
  **
  ** @var array $imgtmp: array com as imagens
  ** @var string $tipo: tipo da galeria a ser cadastrada (galeria, obra, planta)
  ** @return boolean : Se cadastrou ou nao
  */
  public function moveFile($file, $newFile, $file_default = null, $para = 'files/'){
    $de = 'files/tmp/';
    
    if(!is_file($de.$file)){
      // die("Não foi possível transferir a imagem: ".$de.$file);
      CakeLog::write("debug", "Não foi possível transferir a imagem: ".$de.$file);
      // throw new GoodsException('Não foi possível transferir a imagem: $file.');
      return false;
    }
    /*
    ** Cria os diretórios e subdiretórios se não existirem
    */
    if(!is_dir($para)) {
      App::uses('Folder', 'Utility');
      $folder = new Folder();
      if(!$folder->create($para,0777)) {
        CakeLog::write("debug","Não deu pra criar o diretório: ".$para);
        // die("Não deu pra criar o diretório: ".$para);
        return false;
      }
    }
    /*if(!is_dir($para)) {
      $dir_path = explode('/',$para);
      $numpaths = count($dir_path);
      $new_path = '';
      foreach ($dir_path as $d => $dir) {
        if($d < $numpaths){
          if(!empty($new_path)) $new_path .= '/';
          $new_path .= $dir;
          if(!is_dir($new_path)) mkdir($new_path);  //Cria o diretório de destino
        }
      }
    }*/

    //Transfere o arquivo para o diretorio final
    if(!rename($de.$file, $para.$newFile)) { 
      CakeLog::write("debug","Houve um erro ao renomear o arquivo.");
      // die("Houve um erro ao renomear o arquivo.");
      // throw new GoodsException("Houve um erro ao renomear o arquivo.");
      return false;
    }
     //Apaga o arquivo antigo (se tiver)
    if(!empty($file_default)){
      $this->deleteFile($para.$file_default);
    }

    return true;
  }//end action moveFile()

/**
 * Apaga um arquivo do sistema
 *
 * @var string $filepath: caminho até o arquivo
 * @return boolean
 */
  public function deleteFile($filepath=null){
    if(empty($filepath)) return false;

    if(is_file($filepath)){
      App::uses('File', 'Utility');
      $file = new File($filepath);
      $file->delete();
      $file->close();
    }

    return true;
  }

  function css_browser_selector($ua=null) {
    $ua = ($ua) ? strtolower($ua) : strtolower($_SERVER['HTTP_USER_AGENT']);    

    $g = 'gecko';
    $w = 'webkit';
    $s = 'safari';
    $b = array();
    
    // browser
    if(!preg_match('/opera|webtv/i', $ua) && preg_match('/msie\s(\d)/', $ua, $array)) {
        $b[] = 'ie ie' . $array[1];
    } else if(strstr($ua, 'firefox/2')) {
        $b[] = $g . ' ff2';   
    } else if(strstr($ua, 'firefox/3.5')) {
        $b[] = $g . ' ff3 ff3_5';
    } else if(strstr($ua, 'firefox/3')) {
        $b[] = $g . ' ff3';
    } else if(strstr($ua, 'gecko/')) {
        $b[] = $g;
    } else if(preg_match('/opera(\s|\/)(\d+)/', $ua, $array)) {
        $b[] = 'opera opera' . $array[2];
    } else if(strstr($ua, 'konqueror')) {
        $b[] = 'konqueror';
    } else if(strstr($ua, 'chrome')) {
        $b[] = $w . ' ' . $s . ' chrome';
    } else if(strstr($ua, 'iron')) {
        $b[] = $w . ' ' . $s . ' iron';
    } else if(strstr($ua, 'applewebkit/')) {
        $b[] = (preg_match('/version\/(\d+)/i', $ua, $array)) ? $w . ' ' . $s . ' ' . $s . $array[1] : $w . ' ' . $s;
    } else if(strstr($ua, 'mozilla/')) {
        $b[] = $g;
    }

    // platform       
    if(strstr($ua, 'j2me')) {
        $b[] = 'mobile';
    } else if(strstr($ua, 'iphone')) {
        $b[] = 'iphone';    
    } else if(strstr($ua, 'ipod')) {
        $b[] = 'ipod';    
    } else if(strstr($ua, 'mac')) {
        $b[] = 'mac';   
    } else if(strstr($ua, 'darwin')) {
        $b[] = 'mac';   
    } else if(strstr($ua, 'webtv')) {
        $b[] = 'webtv';   
    } else if(strstr($ua, 'win')) {
        $b[] = 'win';   
    } else if(strstr($ua, 'freebsd')) {
        $b[] = 'freebsd';   
    } else if(strstr($ua, 'x11') || strstr($ua, 'linux')) {
        $b[] = 'linux';   
    }

    return join(' ', $b);
  }

  function in_array_r($needle, $haystack) {
      foreach ($haystack as $item) {
          if ($item == $needle || (is_array($item) && in_array_r($needle, $item))) {
              return true;
          }
      }

      return false;
  }

  /*
  ** Função recursiva para passar cada valor de um array para codificação UTF-8
  */
  function array_to_utf8($array = array(), $decode = false) {
    $newarray = array();
      if(!empty($array)){
        foreach ($array as $k=>$item) {
            if($decode){
              $newarray[utf8_decode($k)] = is_array($item) ? array_to_utf8($item, $decode) : utf8_decode($item);
            }else{
              $newarray[utf8_encode($k)] = is_array($item) ? array_to_utf8($item, $decode) : utf8_encode($item);
            }
        }
    }
      return $newarray;
  }

  /*
  ** Função recursiva para transformar um array em uma string;
  ** @param array $pieces : The array of strings to implode
  ** @param string $before : Element to include at the beginning of the string
  ** @param string $after : Element to include at the end of the string
  ** @param string $glue : Element to include among the pieces of string
  ** 
  ** @return string
  */
  function implode_r($params=array()){
    if(!is_array($params)) return false;
    else{
      if( !isset($params['pieces']) ) return false;
      else{
        $string = '';$i=0;$count = count($params['pieces']);
        foreach($params['pieces'] as $piece){
          if($i==0 && isset($params['before'])) $string .= $params['before'];
          
          if(is_array($piece)){
            $subparams = $params;
            $subparams['pieces'] = $piece;
            $string .= implode_r($subparams);
          }
          else $string .= $piece;

          if($i<$count-1 && isset($params['glue'])) $string .= $params['glue'];

          if($i==$count-1 && isset($params['after'])) $string .= $params['after'];
          $i++;
        }//end foreach
        return $string;
      }
    }
  }

  /*
  ** Retorna o IP do usuário
  */
  function getIp($ip2long = false){
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){$ip=$_SERVER['HTTP_CLIENT_IP'];/*Test if it is a shared client*/
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];/*Is it a proxy address*/
    }else{$ip=$_SERVER['REMOTE_ADDR'];}/*The value of $ip at this point would look something like: "192.0.34.166" */

    if($ip2long) $ip = ip2long($ip);

    return $ip;/*The $ip would now look something like: 1073732954*/
  }


     
  /**
  * Função para gerar senhas aleatórias
  *
  * @author    Thiago Belem <contato@thiagobelem.net>
  *
  * @param integer $tamanho Tamanho da senha a ser gerada
  * @param boolean $maiusculas Se terá letras maiúsculas
  * @param boolean $numeros Se terá números
  * @param boolean $simbolos Se terá símbolos
  *
  * @return string A senha gerada
  */

  public $lmin = 'abcdefghijklmnopqrstuvwxyz';
  public $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  public $num  = '1234567890';
  public $simb = '!@#$%*-';

  function geraSenha($tamanho = 8, $minusculas = true, $maiusculas = true, $numeros = true, $simbolos = false){
   /* $_lmin = 'abcdefghijklmnopqrstuvwxyz';
    $_lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $_num = '1234567890';
    $_simb = '!@#$%*-';*/

    $retorno = '';
    $caracteres = '';
    
    if ($minusculas) $caracteres .= $this->lmin;
    if ($maiusculas) $caracteres .= $this->lmai;
    if ($numeros)    $caracteres .= $this->num;
    if ($simbolos)   $caracteres .= $this->simb;
    
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
      $rand     = mt_rand(1, $len);
      $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
  }

   /***
   * Função para remover acentos de uma string
   *
   * @autor Thiago Belem <contato@thiagobelem.net>
   */
  function slug($string, $slug = '-') {
    $string = strtolower($string);

    // Código ASCII das vogais
    $ascii['a'] = range(224, 230);
    $ascii['e'] = range(232, 235);
    $ascii['i'] = range(236, 239);
    $ascii['o'] = array_merge(range(242, 246), array(240, 248));
    $ascii['u'] = range(249, 252);

    // Código ASCII dos outros caracteres
    $ascii['b'] = array(223);
    $ascii['c'] = array(231);
    $ascii['d'] = array(208);
    $ascii['n'] = array(241);
    $ascii['y'] = array(253, 255);

    foreach ($ascii as $key=>$item) {
      $acentos = '';
      foreach ($item AS $codigo) $acentos .= chr($codigo);
      $troca[$key] = '/['.$acentos.']/i';
    }

    $string = preg_replace(array_values($troca), array_keys($troca), $string);

    // Slug?
    if ($slug) {
      // Troca tudo que não for letra ou número por um caractere ($slug)
      $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
      // Tira os caracteres ($slug) repetidos
      $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
      $string = trim($string, $slug);
    }

    return $string;
  }//end  function removeAcentos()

  
}//end class

// -- Exceptions ---------------------------------------------------------------
class GoodsException extends Exception {}
?>