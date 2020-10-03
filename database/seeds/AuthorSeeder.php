<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            'name' => 'Mr Author',
            'email' => 'author@test.com',
            'password' => Hash::make('password'),
            'mobile' => '0170000000',
        ]);
    }
}
