<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BandsGenresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BandsGenresTable Test Case
 */
class BandsGenresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BandsGenresTable
     */
    public $BandsGenres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bands_genres',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.albums',
        'app.songs',
        'app.artists',
        'app.networks',
        'app.singles',
        'app.genres'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BandsGenres') ? [] : ['className' => 'App\Model\Table\BandsGenresTable'];
        $this->BandsGenres = TableRegistry::get('BandsGenres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BandsGenres);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
