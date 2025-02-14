<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CountUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:user {--verified}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get users count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('verified')){
            $count =  User::where('email_verified_at','<>',null)->count();
            $this->info("all verified users count is {$count}");
        }else{
            $this->info("all users count is " . User::count());
        }
    }
}
