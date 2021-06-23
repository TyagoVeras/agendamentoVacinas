<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlacesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlacesTable Test Case
 */
class PlacesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlacesTable
     */
    protected $Places;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Places',
        'app.Schedules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Places') ? [] : ['className' => PlacesTable::class];
        $this->Places = $this->getTableLocator()->get('Places', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Places);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
