<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'name' => 'Developer',
            'email' => 'developer@email.com',
            'password' => bcrypt('secret'),
            'level' => 3
        ]);
    }
}