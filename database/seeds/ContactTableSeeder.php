<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'email' => 'weezenhofburenhulp@gmail.com',
            'naam' => 'Frans de Bruijn',
            'plaats' => 'Weezenhof 37.40',
            'postcode_stad' => '6536 HJ Nijmegen',
            'telefoon' => '0243444660 & 0654691511'
        ]);
    }
}
