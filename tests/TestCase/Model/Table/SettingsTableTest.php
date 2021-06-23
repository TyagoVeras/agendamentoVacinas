<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SettingsTable Test Case
 */
class SettingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SettingsTable
     */
    protected $Settings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Settings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Settings') ? [] : ['className' => SettingsTable::class];
        $this->Settings = $this->getTableLocator()->get('Settings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Settings);

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
