<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Noticia $Noticia
 */
class Tag extends AppModel {

	public $displayField = 'nome';
	public $actsAs = array('HabtmCounterCache.HabtmCounterCache');

/**
 * CALLBACKS
 *
 * @var array
 */
	function afterFind($results) {
		return array_to_utf8($results);
	}

	function beforeValidate() {
		if (!empty($this->data['Tag'])){
			$this->data['Tag'] = array_to_utf8($this->data['Tag'],true);
			if (isset($this->data['Tag']['nome']) && !empty($this->data['Tag']['nome'])){				
				$this->data['Tag']['slug'] = strtolower(Inflector::slug(utf8_encode($this->data['Tag']['nome'])));
			}

		}
		return true;
	} 

	/*function beforeSave() {
		// print_r($this->data);exit();
		if (isset($this->data['Tag']['nome']) && !empty($this->data['Tag']['nome'])){
			$this->data['Tag']['slug'] = strtolower(Inflector::slug($this->data['Tag']['nome']));
		}
		return true;
	} */

/**
 * Validation rules
 *
 * @var array
 */
	public $validateCadastro = array(
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Informe o nome da tag',
				'allowEmpty' => false,
				'required' => true,
				// 'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'O nome da tag deve conter menos de 45 caracteres'
			),
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'Esta tag já está em uso'
			)
		),
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O Slug da tag não foi gerado automaticamente',
				'allowEmpty' => false,
				'required' => true,
				'on' => 'create', // Limit validation to 'create' or 'update' operations
				//'last' => false, // Stop validation after this rule
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'O slug da tag deve conter menos de 45 caracteres'
			),
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'Esta tag já está em uso'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Noticia' => array(
			'className' => 'Noticia',
			'joinTable' => 'noticias_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'noticia_id',
			'unique' => 'keepExisting',
			'counterCache' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
