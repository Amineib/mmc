<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArtistsBandsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArtistsBandsTable Test Case
 */
class ArtistsBandsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArtistsBandsTable
     */
    public $ArtistsBands;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.artists_bands',
        'app.artists',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.albums',
        'app.songs',
        'app.networks',
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
        $config = TableRegistry::exists('ArtistsBands') ? [] : ['className' => 'App\Model\Table\ArtistsBandsTable'];
        $this->ArtistsBands = TableRegistry::get('ArtistsBands', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArtistsBands);

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
