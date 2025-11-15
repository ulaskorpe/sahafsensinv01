<?php

namespace App\Console\Commands;

use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\UserCode;
use Illuminate\Console\Command;
use Carbon\Carbon;

class GenerateUserCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-user-code {--totalItems=100} {--year=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $totalItems = (int) $this->option('totalItems');
        $yearsToAdd = (int) $this->option('year');
        // Create a new progress bar instance
        $bar = $this->output->createProgressBar($totalItems);

        // Start the progress bar
        $bar->start();

        // Process each item
        for ($i = 0; $i < $totalItems; $i++) {
            $now = Carbon::now();

        
            $c = new UserCode();
            $c->user_id= 0;
            $c->code = GeneralHelper::randomPassword(12,1);
            $c->valid_until = $now->addYears($yearsToAdd);
            $c->save();
            // Advance the progress bar
            $bar->advance();
        }

        // Finish the progress bar
        $bar->finish();

        // Output a newline for better formatting
        $this->line('');

        // Optional: Output a success message
        $this->info($totalItems.' user code created successfully.');
    }
}
