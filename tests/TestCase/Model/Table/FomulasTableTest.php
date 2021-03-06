<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FomulasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FomulasTable Test Case
 */
class FomulasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FomulasTable
     */
    public $Fomulas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.units',
        'app.fomula_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Fomulas') ? [] : ['className' => 'App\Model\Table\FomulasTable'];
        $this->Fomulas = TableRegistry::get('Fomulas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fomulas);

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
