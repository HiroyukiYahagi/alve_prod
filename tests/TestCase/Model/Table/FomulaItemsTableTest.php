<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FomulaItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FomulaItemsTable Test Case
 */
class FomulaItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FomulaItemsTable
     */
    public $FomulaItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fomula_items',
        'app.fomulas',
        'app.company',
        'app.products',
        'app.types',
        'app.evaluations',
        'app.evaluation_items',
        'app.evaluation_heads',
        'app.allocations',
        'app.allocation_items',
        'app.fomula_heads',
        'app.units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FomulaItems') ? [] : ['className' => 'App\Model\Table\FomulaItemsTable'];
        $this->FomulaItems = TableRegistry::get('FomulaItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FomulaItems);

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
