<?php
App::uses('AppModel', 'Model');
/**
 * Categoria Model
 *
 * @property Noticia $Noticia
 */
class Tnoticiascategoria extends AppModel {

	public $useDbConfig = 'temoscasa';
	public $useTable = 'noticiascategorias';


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Tnoticia' => array(
			'className' => 'Tnoticia',
			'foreignKey' => 'categoria_id'
		)
	);

}
