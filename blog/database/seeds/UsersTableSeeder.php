<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 10)->create();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'role' => User::ROLE_ADMIN
        ]);
        DB::table('users')->insert([
            'name' => 'suspendAccount',
            'email' => 's@gmail.com',
            'password' => bcrypt('1234'),
            'role' => User::ROLE_SUSPEND
        ]);
    }
}
