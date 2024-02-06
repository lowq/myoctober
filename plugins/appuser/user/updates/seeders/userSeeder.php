<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('appuser_user_users')->insert([
            'name' => 'Jarvis',
            'email' => 'jarvis@openai.com'
        ]);
    }
}
