<?php
/**
 * Created By: Ibidapo Adeolu
 * Project: laravel-monnify
 * Class Name: Monnify.php
 * Date Created: 7/13/20
 * Time Created: 8:44 PM
 */

namespace Bhekor\LaravelMonnify\Facades;

use Bhekor\LaravelMonnify\Banks;
use Bhekor\LaravelMonnify\CustomerReservedAccount;
use Bhekor\LaravelMonnify\Disbursements;
use Bhekor\LaravelMonnify\SubAccounts;
use Bhekor\LaravelMonnify\Transactions;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string computeRequestValidationHashTest(string $stringifiedData)
 * @method static string computeRequestValidationHash(string $stringifiedData)
 * @method static Banks Banks()
 * @method static CustomerReservedAccount ReservedAccounts()
 * @method static Disbursements Disbursements()
 * @method static SubAccounts SubAccounts()
 * @method static Transactions Transactions()
 *
 * Class Monnify
 * @package Bhekor\LaravelMonnify\Facades
 */
class Monnify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'monnify';
    }
}
