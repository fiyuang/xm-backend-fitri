<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
              'email' => 'superadmin@mail.com',
              'password' => '$2y$10$eDVmbWMey6B2krhOP8glXeGaGEuva7LNnQXhkFo6ClZmOPySIBHha',
              'user_type' => 1,
            ],
        ];

        User::insert($users);
    }
}
