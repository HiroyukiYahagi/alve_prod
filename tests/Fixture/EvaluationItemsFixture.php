<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EvaluationItemsFixture
 *
 */
class EvaluationItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'evaluation_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'head_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'value' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'unit_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'compared_value' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_ evaluation_items_evaluation_id_idx' => ['type' => 'index', 'columns' => ['evaluation_id'], 'length' => []],
            'fk_ evaluation_items_head_id_idx' => ['type' => 'index', 'columns' => ['head_id'], 'length' => []],
            'fk_ evaluation_items_unit_id_idx' => ['type' => 'index', 'columns' => ['unit_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_ evaluation_items_evaluation_id' => ['type' => 'foreign', 'columns' => ['evaluation_id'], 'references' => ['evaluations', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_ evaluation_items_head_id' => ['type' => 'foreign', 'columns' => ['head_id'], 'references' => ['evaluation_heads', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_ evaluation_items_unit_id' => ['type' => 'foreign', 'columns' => ['unit_id'], 'references' => ['units', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'evaluation_id' => 1,
            'head_id' => 1,
            'created' => '2016-04-21 16:57:00',
            'modified' => '2016-04-21 16:57:00',
            'deleted' => 1,
            'value' => 'Lorem ipsum dolor sit amet',
            'unit_id' => 1,
            'compared_value' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
