<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeHeadRelationsFixture
 *
 */
class TypeHeadRelationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'evaluation_head_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_type_head_relations_type_id_idx' => ['type' => 'index', 'columns' => ['type_id'], 'length' => []],
            'fk_type_head_relations_evaluation_head_id_idx' => ['type' => 'index', 'columns' => ['evaluation_head_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_type_head_relations_type_id' => ['type' => 'foreign', 'columns' => ['type_id'], 'references' => ['types', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_type_head_relations_evaluation_head_id' => ['type' => 'foreign', 'columns' => ['evaluation_head_id'], 'references' => ['evaluation_heads', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'type_id' => 1,
            'evaluation_head_id' => 1
        ],
    ];
}
