<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FomulaHeadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FomulaHeadsTable Test Case
 */
class FomulaHeadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FomulaHeadsTable
     */
    public $FomulaHeads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fomula_heads',
        'app.allocations',
        'app.allocation_items',
        'app.evaluation_heads'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FomulaHeads') ? [] : ['className' => 'App\Model\Table\FomulaHeadsTable'];
        $this->FomulaHeads = TableRegistry::get('FomulaHeads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FomulaHeads);

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
