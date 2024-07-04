<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportCSVJob;

class ImportCSVCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-csv';

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
        ImportCSVJob::dispatch();
        $this->info('ImportCSVJob has been dispatched.');
        return 0;
    }
}
