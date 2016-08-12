<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ArtistsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ArtistsController Test Case
 */
class ArtistsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.artists',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.albums',
        'app.reviews',
        'app.songs',
        'app.networks',
        'app.artists_bands',
        'app.genres',
        'app.bands_genres'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}