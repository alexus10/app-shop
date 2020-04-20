<?php

use App\User;
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
        User::create([
            'name' => 'Alejandro García',
            'email' => 'alejandro@arguilea.com',
            'password' => bcrypt('123456'),
            'admin' => true
        ]);
    }
}
