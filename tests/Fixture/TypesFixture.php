<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypesFixture
 *
 */
class TypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type_name' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'fomula' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'purpose' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'type_name' => 'Lorem ipsum dolor sit amet',
            'fomula' => 'Lorem ipsum dolor sit amet',
            'purpose' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-04-21 16:57:01',
            'modified' => '2016-04-21 16:57:01',
            'deleted' => 1
        ],
    ];
}
