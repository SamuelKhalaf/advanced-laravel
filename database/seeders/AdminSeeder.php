<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create($this->adminDate());
    }

    private function adminDate()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin admin'),
            'email_verified_at' =>Carbon::now(),
        ];
    }
}
