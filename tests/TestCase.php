<?php

namespace TarfinLabs\Parasut\Tests;

use Faker\Factory;
use Faker\Generator;
use Orchestra\Testbench\TestCase as Orchestra;
use TarfinLabs\Parasut\ParasutServiceProvider;

abstract class TestCase extends Orchestra
{
    protected Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create('tr_TR');
    }

    protected function getPackageProviders($app): array
    {
        return [
            ParasutServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);
    }
}
