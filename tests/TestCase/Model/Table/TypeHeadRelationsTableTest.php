<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeHeadRelationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeHeadRelationsTable Test Case
 */
class TypeHeadRelationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeHeadRelationsTable
     */
    public $TypeHeadRelations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_head_relations',
        'app.types',
        'app.products',
        'app.companies',
        'app.fomulas',
        'app.fomula_items',
        'app.fomula_heads',
        'app.allocations',
        'app.allocation_items',
        'app.evaluation_heads',
        'app.units',
        'app.evaluation_items',
        'app.evaluations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TypeHeadRelations') ? [] : ['className' => 'App\Model\Table\TypeHeadRelationsTable'];
        $this->TypeHeadRelations = TableRegistry::get('TypeHeadRelations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeHeadRelations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
