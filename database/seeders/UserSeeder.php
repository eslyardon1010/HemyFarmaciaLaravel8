<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Yosary Santos',
            'phone' => '32254587',
            'email' => 'yosan2001@gmail.com',
            'profile' => 'EMPLOYEE',
            'status' => 'ACTIVE',
            'password' => bcrypt('123456789')
        ]);
        User::create([
            'name' => 'Hector Mejia',
            'phone' => '98574858',
            'email' => 'hectorMejia@gmail.com',
            'profile' => 'EMPLOYEE',
            'status' => 'ACTIVE',
            'password' => bcrypt('123456789')
        ]);
    }
}
