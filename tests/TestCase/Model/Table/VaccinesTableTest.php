<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VaccinesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VaccinesTable Test Case
 */
class VaccinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VaccinesTable
     */
    protected $Vaccines;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Vaccines',
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
        $config = $this->getTableLocator()->exists('Vaccines') ? [] : ['className' => VaccinesTable::class];
        $this->Vaccines = $this->getTableLocator()->get('Vaccines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Vaccines);

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
