<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ReviewsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ReviewsController Test Case
 */
class ReviewsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reviews',
        'app.albums',
        'app.bands',
        'app.cities',
        'app.countries',
        'app.networks',
        'app.artists',
        'app.artists_bands',
        'app.genres',
        'app.bands_genres',
        'app.songs'
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
