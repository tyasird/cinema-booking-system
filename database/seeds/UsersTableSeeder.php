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
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@email.com',
            'password' => bcrypt('user1'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'user2@email.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
