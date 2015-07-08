<?php

namespace Croogo\Contacts\Model\Table;

use Croogo\Core\Model\Table\CroogoTable;

/**
 * Contact
 *
 * @category Model
 * @package  Croogo.Contacts.Model
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ContactsTable extends CroogoTable {

/**
 * Behaviors used by the Model
 *
 * @var array
 * @access public
 */
	public $actsAs = array(
		'Croogo.Cached' => array(
			'groups' => array(
				'contacts',
			),
		),
		'Croogo.Trackable',
	);

/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'This field cannot be left blank.',
		),
		'alias' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This alias has already been taken.',
			),
			'minLength' => array(
				'rule' => array('minLength', 1),
				'message' => 'Alias cannot be empty.',
			),
		),
		'email' => array(
			'rule' => 'email',
			'message' => 'Please provide a valid email address.',
		),
	);

	public function initialize(array $config) {
		parent::initialize($config);
		$this->entityClass('Croogo/Contacts.Contact');
		$this->addAssociations([
			'hasMany' => [
				'Message' => [
					'className' => 'Croogo/Contacts.Messages',
					'foreignKey' => 'contact_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '3',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => '',
				],
			],
		]);
	}

/**
 * Display fields for this model
 *
 * @var array
 */
	protected $_displayFields = array(
		'id',
		'title',
		'alias',
		'email',
	);
}