<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BandsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BandsTable Test Case
 */
class BandsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BandsTable
     */
    public $Bands;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bands',
        'app.cities',
        'app.countries',
        'app.albums',
        'app.songs',
        'app.artists',
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
        $config = TableRegistry::exists('Bands') ? [] : ['className' => 'App\Model\Table\BandsTable'];
        $this->Bands = TableRegistry::get('Bands', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bands);

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

    /**
     * Test findRecent method
     *
     * @return void
     */
    public function testFindRecent()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findGenre method
     *
     * @return void
     */
    public function testFindGenre()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
