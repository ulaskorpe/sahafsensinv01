<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear config, route, cache, and view caches';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('config:clear');
        $this->info('Configuration cache cleared!');

        $this->call('route:clear');
        $this->info('Route cache cleared!');

        $this->call('cache:clear');
        $this->info('Application cache cleared!');

        $this->call('view:clear');
        $this->info('View cache cleared!');

        return 0;
    }
}
