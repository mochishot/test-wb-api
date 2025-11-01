<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WbApiService;

class FetchWbDataCommand extends Command
{
    protected $signature = 'wb:fetch-data';
    protected $description = 'Fetch all data from WB API and save to database';

    public function handle()
    {
        $this->info('Starting data fetch from WB API...');

        try {
            $apiService = new WbApiService();
            $result = $apiService->fetchAllData();

            $this->info('Data fetch completed!');
            $this->info('Results:');
            foreach ($result as $endpoint => $message) {
                $this->line("  $endpoint: $message");
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->info('Check storage/logs/laravel.log for details');
        }
    }
}
