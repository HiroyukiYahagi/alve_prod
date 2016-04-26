<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllocationItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AllocationItemsTable Test Case
 */
class AllocationItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AllocationItemsTable
     */
    public $AllocationItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allocation_items',
        'app.allocations',
        'app.evaluation_heads',
        'app.fomula_heads'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AllocationItems') ? [] : ['className' => 'App\Model\Table\AllocationItemsTable'];
        $this->AllocationItems = TableRegistry::get('AllocationItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AllocationItems);

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
