<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvaluationHeadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvaluationHeadsTable Test Case
 */
class EvaluationHeadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EvaluationHeadsTable
     */
    public $EvaluationHeads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.evaluation_heads',
        'app.allocations',
        'app.allocation_items',
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
        $config = TableRegistry::exists('EvaluationHeads') ? [] : ['className' => 'App\Model\Table\EvaluationHeadsTable'];
        $this->EvaluationHeads = TableRegistry::get('EvaluationHeads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EvaluationHeads);

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
