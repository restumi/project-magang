<?php

namespace App\Console\Commands;

use App\Models\Hobby;
use Illuminate\Console\Command;

class CreateRandomHobby extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:hobby';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a random hobby';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $names = [
            'reading', 'cooking', 'traveling', 'gaming', 'photography', 'coding', 'fishing', 'dancing', 'singing'
        ];
        $description = 'Lorem ipsum dolor sit amet consectetur';

        $name = $names[array_rand($names)];

        Hobby::create([
            'name' => $name,
            'description' => $description
        ]);

        $this->info('Hobby created successfully : ' . $name);
    }
}
