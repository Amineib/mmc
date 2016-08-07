<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SinglesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SinglesTable Test Case
 */
class SinglesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SinglesTable
     */
    public $Singles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.singles',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.albums',
        'app.songs',
        'app.artists',
        'app.networks',
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
        $config = TableRegistry::exists('Singles') ? [] : ['className' => 'App\Model\Table\SinglesTable'];
        $this->Singles = TableRegistry::get('Singles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Singles);

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
