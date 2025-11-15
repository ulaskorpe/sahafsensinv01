<?php
// app/Console/Commands/ClearCookies.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\HttpFoundation\Cookie;

class ClearCookies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cookies:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cookies for the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Generate headers to clear cookies
        $cookies = collect(request()->cookies->all())->keys();
        $clearCookiesHeaders = $cookies->map(function ($cookieName) {
            return Cookie::create($cookieName, null, -1);
        });

        // Display the headers to clear cookies
        $this->info('Use the following headers in your HTTP response to clear cookies:');
        foreach ($clearCookiesHeaders as $header) {
            $this->info($header);
        }

        return 0;
    }
}
