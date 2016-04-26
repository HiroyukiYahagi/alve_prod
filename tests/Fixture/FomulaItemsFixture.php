<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FomulaItemsFixture
 *
 */
class FomulaItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fomula_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'head_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'value' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'unit_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_fomula_items_fomula_id_idx' => ['type' => 'index', 'columns' => ['fomula_id'], 'length' => []],
            'fk_fomula_items_head_id_idx' => ['type' => 'index', 'columns' => ['head_id'], 'length' => []],
            'fk_fomula_items_unit_id_idx' => ['type' => 'index', 'columns' => ['unit_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_fomula_items_fomula_id' => ['type' => 'foreign', 'columns' => ['fomula_id'], 'references' => ['fomulas', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_fomula_items_head_id' => ['type' => 'foreign', 'columns' => ['head_id'], 'references' => ['fomula_heads', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_fomula_items_unit_id' => ['type' => 'foreign', 'columns' => ['unit_id'], 'references' => ['units', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'fomula_id' => 1,
            'head_id' => 1,
            'created' => '2016-04-21 16:57:01',
            'modified' => '2016-04-21 16:57:01',
            'deleted' => 1,
            'value' => 'Lorem ipsum dolor sit amet',
            'unit_id' => 1
        ],
    ];
}
