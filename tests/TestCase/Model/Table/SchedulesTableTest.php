<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchedulesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchedulesTable Test Case
 */
class SchedulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SchedulesTable
     */
    protected $Schedules;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Schedules',
        'app.People',
        'app.Doses',
        'app.Categories',
        'app.Vaccines',
        'app.Places',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Schedules') ? [] : ['className' => SchedulesTable::class];
        $this->Schedules = $this->getTableLocator()->get('Schedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Schedules);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
