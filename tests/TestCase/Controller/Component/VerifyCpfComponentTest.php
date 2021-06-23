<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\VerifyCpfComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\VerifyCpfComponent Test Case
 */
class VerifyCpfComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\VerifyCpfComponent
     */
    protected $VerifyCpf;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->VerifyCpf = new VerifyCpfComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->VerifyCpf);

        parent::tearDown();
    }
}
