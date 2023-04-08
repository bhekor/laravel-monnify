<?php
/**
 * Created By: Ibidapo Adeolu
 * Project: laravel-monnify
 * Class Name: InstallLaravelMonnifyTest.php
 * Date Created: 7/13/20
 * Time Created: 7:34 PM
 */

namespace Bhekor\LaravelMonnify\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Bhekor\LaravelMonnify\Tests\TestCase;

class InstallLaravelMonnifyTest extends TestCase
{
    /** @test */
    function the_install_command_copies_a_the_configuration()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('monnify.php'))) {
            unlink(config_path('monnify.php'));
        }

        $this->assertFalse(File::exists(config_path('monnify.php')));

        Artisan::call('monnify:init');

        $this->assertTrue(File::exists(config_path('monnify.php')));
    }
}
