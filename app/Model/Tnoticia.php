<?php
App::uses('AppModel', 'Model');
/**
 * Noticia Model
 *
 * @property User $User
 * @property Anexo $Anexo
 * @property Categoria $Categoria
 * @property Subscriber $Subscriber
 * @property Tag $Tag
 */
class Tnoticia extends AppModel {

	public $useDbConfig = 'temoscasa';
	public $useTable = 'noticias';

	/**
	 * Define relacionamentos "Contém um"
	 *
	 * @var array
	 * @access public
	 * @link http://book.cakephp.org/pt/view/1041/hasOne
	 */
	public $hasOne = array(
		/**
		* 'Hack' para HABTM
		*/
		'Tnoticiascategoria' => array(
			'className'  => 'Tnoticiascategoria',
			'foreignKey' => false,
			'conditions' => 'Tnoticiascategoria.id = Tnoticia.categoria_id'
		)
	);

}
