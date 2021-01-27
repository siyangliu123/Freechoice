<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceCigaretteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceCigaretteTable Test Case
 */
class InvoiceCigaretteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceCigaretteTable
     */
    public $InvoiceCigarette;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.InvoiceCigarette',
        'app.Clients',
        'app.Orders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InvoiceCigarette') ? [] : ['className' => InvoiceCigaretteTable::class];
        $this->InvoiceCigarette = TableRegistry::getTableLocator()->get('InvoiceCigarette', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceCigarette);

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
