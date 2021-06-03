<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Administrador Geral',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => Carbon::now()
        ]);
    }
}
