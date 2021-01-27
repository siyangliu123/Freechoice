<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerOrderTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerOrderTable Test Case
 */
class CustomerOrderTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerOrderTable
     */
    public $CustomerOrder;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CustomerOrder'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CustomerOrder') ? [] : ['className' => CustomerOrderTable::class];
        $this->CustomerOrder = TableRegistry::getTableLocator()->get('CustomerOrder', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerOrder);

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
