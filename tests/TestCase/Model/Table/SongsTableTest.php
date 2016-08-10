<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SongsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SongsTable Test Case
 */
class SongsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SongsTable
     */
    public $Songs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.songs',
        'app.albums',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.networks',
        'app.artists',
        'app.artists_bands',
        'app.genres',
        'app.bands_genres',
        'app.reviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Songs') ? [] : ['className' => 'App\Model\Table\SongsTable'];
        $this->Songs = TableRegistry::get('Songs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Songs);

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
