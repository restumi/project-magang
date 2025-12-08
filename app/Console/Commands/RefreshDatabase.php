<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate fresh and run seeder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate:fresh', ['--seed' => true]);

        $this->info('Darabase fresh and seed successfully!');
    }
}
