<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\QrCodeHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\QrCodeHelper Test Case
 */
class QrCodeHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\QrCodeHelper
     */
    protected $QrCode;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->QrCode = new QrCodeHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->QrCode);

        parent::tearDown();
    }
}
