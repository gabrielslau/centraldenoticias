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
class Noticia extends AppModel {

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
			$this->data['Noticia'] = array_to_utf8($this->data['Noticia'],true);

			$this->data['Noticia']['titulo'] = ucfirst( strtolower($this->data['Noticia']['titulo']) ); // Capitalize
		}

		return true;
	}

	/*function beforeValidate() {
		// parent::beforeSave(); 
		
		if (!empty($this->data)){
			$this->data['Noticia'] = array_to_utf8($this->data['Noticia'],true);

			$this->data['Noticia']['titulo'] = ucfirst( strtolower($this->data['Noticia']['titulo']) ); // Capitalize
		}
		return true;
		// return parent::beforeSave(); 
	}*/

	// Exclui qualquer arquivo relacionado à notícia, que esteja cadastrado em sua pasta
	function afterDelete() {
	    App::uses('Folder', 'Utility');
		$folder = new Folder('files'.DS.'image'.DS.'noticia'.DS.$this->data['Noticia']['codigo'].DS);
		$folder->delete();
	}



/**
 * Validation rules
 *
 * @var array
 */
	public $validateCadastro = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'codigo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O código da notícia não foi especificado',
				'required' => true,
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 7),
				'message' => 'O código deve conter menos de 7 caracteres'
			)
		),
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O título da notícia deve ser informado',
				'required' => true,
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 250),
				'message' => 'O título deve conter menos de 250 caracteres'
			)
		),
		'resumo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O resumo da notícia deve ser informado',
				'required' => false,
				'allowEmpty' => true,
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 500),
				'message' => 'O texto de chamada deve conter menos de 500 caracteres'
			)
		),
		'conteudo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'O conteúdo da notícia deve ser informado',
				'required' => true,
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'imagem' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'O nome da imagem deve conter menos de 60 caracteres'
			)
		),
		'fonte' => array(
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				'message' => 'O nome da fonte deve conter menos de 60 caracteres'
			)
		),
		'destaque' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'O valor de destaque precisa ser booleano'
			),
		),
		'status' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'O valor de status precisa ser booleano'
			),
		),
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'O formato da data da notícia não é válida',
				'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Anexo' => array(
			'className' => 'Anexo',
			'foreignKey' => 'noticia_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Categoria' => array(
			'className' => 'Categoria',
			'joinTable' => 'noticias_categorias',
			'foreignKey' => 'noticia_id',
			'associationForeignKey' => 'categoria_id',
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
		),
		'Subscriber' => array(
			'className' => 'Subscriber',
			'joinTable' => 'noticias_subscribers',
			'foreignKey' => 'noticia_id',
			'associationForeignKey' => 'subscriber_id',
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
		),
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'noticias_tags',
			'foreignKey' => 'noticia_id',
			'associationForeignKey' => 'tag_id',
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
