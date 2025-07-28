<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('administrator');

          $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('user');

    }
}
