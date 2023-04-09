<?php
/**
 * Created By: Ibidapo Adeolu
 * Project: laravel-monnify
 * Class Name: TestCase.php
 * Date Created: 4/08/23
 * Time Created: 6:52 PM
 */

namespace Bhekor\LaravelMonnify\Tests;


use Bhekor\LaravelMonnify\LaravelMonnifyServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMonnifyServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

}
