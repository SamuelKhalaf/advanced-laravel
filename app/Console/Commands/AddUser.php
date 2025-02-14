<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add a new user by using factory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count');

        if (!is_numeric($count) || $count <= 0 || $count > 10) {
            $this->error("Invalid count value. Please provide a number between 1 and 10.");
            return;
        }

        for ($i=1;$i<=$count;$i++){
            User::factory()->create();
        }
        $this->info("the factory run successfully");

    }
}
