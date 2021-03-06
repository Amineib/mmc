<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlbumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlbumsTable Test Case
 */
class AlbumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlbumsTable
     */
    public $Albums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Albums') ? [] : ['className' => 'App\Model\Table\AlbumsTable'];
        $this->Albums = TableRegistry::get('Albums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Albums);

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
