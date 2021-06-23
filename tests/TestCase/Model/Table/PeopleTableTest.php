<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeopleTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeopleTable Test Case
 */
class PeopleTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PeopleTable
     */
    protected $People;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.People',
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
        $config = $this->getTableLocator()->exists('People') ? [] : ['className' => PeopleTable::class];
        $this->People = $this->getTableLocator()->get('People', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->People);

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
