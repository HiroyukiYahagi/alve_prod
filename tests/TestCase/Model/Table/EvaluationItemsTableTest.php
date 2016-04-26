<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvaluationItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvaluationItemsTable Test Case
 */
class EvaluationItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EvaluationItemsTable
     */
    public $EvaluationItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.evaluation_items',
        'app.evaluations',
        'app.products',
        'app.company',
        'app.fomulas',
        'app.fomula_items',
        'app.fomula_heads',
        'app.allocations',
        'app.allocation_items',
        'app.evaluation_heads',
        'app.units',
        'app.types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EvaluationItems') ? [] : ['className' => 'App\Model\Table\EvaluationItemsTable'];
        $this->EvaluationItems = TableRegistry::get('EvaluationItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EvaluationItems);

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
