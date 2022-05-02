<?php

namespace Database\Seeders;

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
    for ($i = 1; $i <= 10; $i++) {
        User::create([
            'name' => 'title' . $i,
            'email' => 'email' . $i .'@gmail.com',
            'password' => 'password' . $i,
        ]);
        }
    }
}
