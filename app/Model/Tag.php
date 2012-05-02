<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Noticia $Noticia
 */
class Tag extends AppModel {

	public $actsAs = array('HabtmCounterCache.HabtmCounterCache');

/**
 * CALLBACKS
 *
 * @var array
 */
	function afterFind($results) {
		return array_to_utf8($results);
	}

	function beforeSave() {
		if (!empty($this->data)){
			$this->data['Tag'] = array_to_utf8($this->data['Tag'],true);
		}
		return true;
	} 

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
