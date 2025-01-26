<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Stripe\ApiRequestor;
use Stripe\Stripe;
use Tests\Mock\StripeClientMock;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function mockStripe()
    {
        ApiRequestor::setHttpClient(new StripeClientMock());
    }

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
