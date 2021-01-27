<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderCigaretteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderCigaretteTable Test Case
 */
class OrderCigaretteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderCigaretteTable
     */
    public $OrderCigarette;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrderCigarette',
        'app.Orders',
        'app.Cigarette'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderCigarette') ? [] : ['className' => OrderCigaretteTable::class];
        $this->OrderCigarette = TableRegistry::getTableLocator()->get('OrderCigarette', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderCigarette);

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