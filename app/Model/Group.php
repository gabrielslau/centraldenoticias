<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {

	public $actsAs = array('Acl' => array('type' => 'requester'));

/**
 * CALLBACKS
 */
    public function parentNode() {
        return null;
    }

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
			$this->data['Group'] = array_to_utf8($this->data['Group'],true);
			$this->data['Tag']['slug'] = strtolower(Inflector::slug($this->data['Tag']['nome']));
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
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

}
