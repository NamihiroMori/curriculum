<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => "user{$i}",
                'email' => "user{$i}@gmail.com",
                'password' => bcrypt('password'),
            ]);
        }
    }
}
