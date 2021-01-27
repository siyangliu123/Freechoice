<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CigaretteFlavorTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CigaretteFlavorTable Test Case
 */
class CigaretteFlavorTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CigaretteFlavorTable
     */
    public $CigaretteFlavor;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CigaretteFlavor',
        'app.Cigarettes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CigaretteFlavor') ? [] : ['className' => CigaretteFlavorTable::class];
        $this->CigaretteFlavor = TableRegistry::getTableLocator()->get('CigaretteFlavor', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CigaretteFlavor);

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
