<?php
App::uses('AppModel', 'Model');
/**
 * Categoria Model
 *
 * @property Noticia $Noticia
 */
class Categoria extends AppModel {

	public $displayField = 'nome';
	public $actsAs = array('HabtmCounterCache.HabtmCounterCache');

/**
 * Callbacks
 *
 * @var array
 */
	function afterFind($results) {
		return array_to_utf8($results);
	}

	function beforeValidate() {
		if (!empty($this->data)){
			$this->data['Categoria'] = array_to_utf8($this->data['Categoria'],true);

			if(isset( $this->data['Categoria']['codigo'] ) && !empty( $this->data['Categoria']['codigo'] ))
				$this->data['Categoria']['codigo'] = strtoupper($this->data['Categoria']['codigo']);
			else
				$this->data['Categoria']['codigo'] = $this->geracodigo($this->data['Categoria']['nome']);

			// Cria um Slug para a Categoria
			$this->data['Categoria']['slug'] = strtolower(Inflector::slug(utf8_encode($this->data['Categoria']['nome'])));
		}
		return true;
	}


/**
* geracodigo method
* Função recursiva para criação de código do Model
* @param string $char
* @return string
*/
	private $numTentativas = 0; // Guarda o número de tentativas de criar uma senha
	private function geracodigo($chars){
		App::import('Vendor', 'goods');
		$chars = ereg_replace("[^a-zA-Z]", "", strtr($chars, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC")); //Remove caracteres acentuados
		if($this->numTentativas >= 20 || empty($chars)) $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Inclui mais caracteres, caso chegue ao limite de possibilidades
		$chars = implode('',array_unique(str_split( str_replace(' ', '', strtoupper($chars)) )));

		$Goods = new Goods();
		$Goods->lmai = strtoupper($chars);

		$newcod = $Goods->geraSenha(3, false, true, false);//	Se o código criado já existir, cria um novo e testa novamente
		$jatem = $this->findByCodigo($newcod);
		if(!empty($jatem)){
			$this->numTentativas++;
			$newcod = $this->geracodigo($chars);
		}
		return $newcod;
	}//end function geracodigo()

/**
 * Validation rules
 *
 * @var array
 */
	public $validateCadastro = array(
		'codigo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Informe um código de 3 letras para a categoria',
				'allowEmpty' => false,
				'required' => true,
				// 'last' => true, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 3),
				'message' => 'O código da categoria deve conter no máximo 3 caracteres'
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Apenas letras e números são aceitos'
			),
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'Este código já está em uso'
			)
		),
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Informe o nome da categoria',
				'allowEmpty' => false,
				'required' => true,
				// 'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'O nome da categoria deve conter menos de 45 caracteres'
			),
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'Esta categoria já está em uso'
			)
		),
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O Slug da categoria não foi gerado automaticamente',
				//'allowEmpty' => false,
				'required' => true,
				'on' => 'create', // Limit validation to 'create' or 'update' operations
				//'last' => false, // Stop validation after this rule
			),
			'maxLength' => array(
				'rule' => array('maxLength', 45),
				'message' => 'O slug da categoria deve conter menos de 45 caracteres'
			),
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'Esta categoria já está em uso'
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
			'joinTable' => 'noticias_categorias',
			'foreignKey' => 'categoria_id',
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
