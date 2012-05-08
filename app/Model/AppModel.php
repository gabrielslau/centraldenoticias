<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

/**
* Função para validação personalizada
* @link http://snook.ca/archives/cakephp/multiple_validation_sets_cakephp
*/
	function validates($options = array()) {
	    // copy the data over from a custom var, otherwise
	    $actionSet = 'validate' . Inflector::camelize(Router::getParam('action'));
	    if (isset($this->validationSet)) {
	        $temp = $this->validate;
	        $param = 'validate' . $this->validationSet;
	        $this->validate = $this->{$param};
	    } elseif (isset($this->{$actionSet})) {
	        $temp = $this->validate;
	        $param = $actionSet;
	        $this->validate = $this->{$param};
	    } 

	    $errors = $this->invalidFields($options);

	    // copy it back
	    if (isset($temp)) {
	        $this->validate = $temp;
	        unset($this->validationSet);
	    }
	    
	    if (is_array($errors)) {
	        return count($errors) === 0;
	    }
	    return $errors;
	}
	
}
