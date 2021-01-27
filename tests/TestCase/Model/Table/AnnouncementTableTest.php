<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnnouncementTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnnouncementTable Test Case
 */
class AnnouncementTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AnnouncementTable
     */
    public $Announcement;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Announcement'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Announcement') ? [] : ['className' => AnnouncementTable::class];
        $this->Announcement = TableRegistry::getTableLocator()->get('Announcement', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Announcement);

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
