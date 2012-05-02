<?php
App::uses('AppModel', 'Model');
/**
 * NoticiasCategoria Model
 *
 * @property Noticia $Noticia
 * @property Categoria $Categoria
 */
class NoticiasCategoria extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'noticia_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'categoria_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Noticia' => array(
			'className' => 'Noticia',
			'foreignKey' => 'noticia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
