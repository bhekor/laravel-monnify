<?php
/**
 * Created By: Ibidapo Adeolu
 * Project: laravel-monnify
 * Class Name: InstallLaravelMonnify.php
 * Date Created: 4/08/23
 * Time Created: 7:26 PM
 */

namespace Bhekor\LaravelMonnify\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallLaravelMonnify extends Command
{
    protected $signature = 'monnify:init';

    protected $description = 'Install Laravel Monnify package';

    public function handle()
    {
        $this->info('Installing Laravel Monnify by Ibidapo Adeolu...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Bhekor\LaravelMonnify\LaravelMonnifyServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Configuration Published!');

        $this->info('Publishing migrations...');

        $this->call('vendor:publish', [
            '--provider' => "Bhekor\LaravelMonnify\LaravelMonnifyServiceProvider",
            '--tag' => "migrations"
        ]);

        $this->info('Migrations Published!');

        $this->info('Checking for environmental variable file (.env)');
        if (file_exists($path = $this->envPath()) === false) {
            $this->info('Environmental variable file (.env) not found!');
        } else {
            if ($this->isConfirmed() === false) {
                $this->comment('Phew... No changes were made to your .env file');
                return;
            }
            $this->info('Now writing .env file with Monnify Sandbox credential for you to modify...');

            $this->writeChanges($path, "MONNIFY_BASE_URL", "base_url", 'https://sandbox.monnify.com');
            $this->writeChanges($path, "MONNIFY_API_KEY", "api_key", "MK_TEST_SAF7HR5F3F");
            $this->writeChanges($path, "MONNIFY_SECRET_KEY", "secret_key", "4SY6TNL8CK3VPRSBTHTRG2N8XXEGC6NL");
            $this->writeChanges($path, "MONNIFY_CONTRACT_CODE", "contract_code", "4934121686");
            $this->writeChanges($path, "MONNIFY_WALLET_ID", "wallet_id", "2A47114E88904626955A6BD333A6B164");
            $this->writeChanges($path, "MONNIFY_DEFAULT_SPLIT_PERCENTAGE", "default_split_percentage", 20);
            $this->writeChanges($path, "MONNIFY_DEFAULT_CURRENCY_CODE", "default_currency_code", 'NGN');
            $this->writeChanges($path, "MONNIFY_DEFAULT_PAYMENT_REDIRECT_URL", "redirect_url", '"${APP_URL}/transaction/confirm"');

        }

        $this->info('Laravel Monnify Package Installation Complete!');
        $this->writeWelcomeMessage();
    }

    private function writeChanges($path, string $key, string $configKey, $value){
        if (Str::contains(file_get_contents($path), "$key") === false) {
            $this->info("Now writing .env with $key=$value ...");
            file_put_contents($path, PHP_EOL."$key=$value".PHP_EOL, FILE_APPEND);
        }else{
            $this->info("Now updating $key value in your .env to $value ...");
            // update existing entry
            file_put_contents($path, str_replace(
                "$key=".$this->laravel['config']["monnify.$configKey"],
                "$key=$value", file_get_contents($path)
            ));
        }
    }


    /**
     * Get the .env file path.
     *
     * @return string
     */
    protected function envPath()
    {
        if (method_exists($this->laravel, 'environmentFilePath')) {
            return $this->laravel->environmentFilePath();
        }

        // check if laravel version Less than 5.4.17
        if (version_compare($this->laravel->version(), '5.4.17', '<')) {
            return $this->laravel->basePath() . DIRECTORY_SEPARATOR . '.env';
        }

        return $this->laravel->basePath('.env');
    }

    /**
     * Check if the modification is confirmed.
     *
     * @return bool
     */
    protected function isConfirmed()
    {
        return $this->confirm(
            'If your Monnify details are set within your .env file they would be overridden. Are you sure you want to override them if exists?'
        );
    }

    public function writeWelcomeMessage()
    {
        $this->line("\n<options=bold>Congratulations, you've successfuly installed Laravel Monnify and ready to process payment!</>\n");
        if ($this->confirm('Would you like to show some love by starring the repo?')) {
            if(PHP_OS_FAMILY == 'Darwin') exec('open https://github.com/bhekor/laravel-monnify');
            if(PHP_OS_FAMILY == 'Windows') exec('start https://github.com/bhekor/laravel-monnify');
            if(PHP_OS_FAMILY == 'Linux') exec('xdg-open https://github.com/bhekor/laravel-monnify');

            $this->line("Thanks! Means the world to me!");
        }
    }
}
