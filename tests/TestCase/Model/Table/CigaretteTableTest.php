<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CigaretteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CigaretteTable Test Case
 */
class CigaretteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CigaretteTable
     */
    public $Cigarette;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Cigarette') ? [] : ['className' => CigaretteTable::class];
        $this->Cigarette = TableRegistry::getTableLocator()->get('Cigarette', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cigarette);

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
}
