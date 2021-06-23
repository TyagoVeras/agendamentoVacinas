<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DosesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DosesTable Test Case
 */
class DosesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DosesTable
     */
    protected $Doses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Doses',
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
        $config = $this->getTableLocator()->exists('Doses') ? [] : ['className' => DosesTable::class];
        $this->Doses = $this->getTableLocator()->get('Doses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Doses);

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
