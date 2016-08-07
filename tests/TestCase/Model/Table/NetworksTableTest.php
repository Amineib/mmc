<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NetworksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NetworksTable Test Case
 */
class NetworksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NetworksTable
     */
    public $Networks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.networks',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.albums',
        'app.songs',
        'app.artists',
        'app.singles',
        'app.genres',
        'app.bands_genres'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Networks') ? [] : ['className' => 'App\Model\Table\NetworksTable'];
        $this->Networks = TableRegistry::get('Networks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Networks);

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
