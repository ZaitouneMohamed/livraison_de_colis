<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'user',
                'email'=>'user@user.com',
                'role'=>0,
                'active'=>1,
                'password'=> bcrypt('password'),
            ],
            [
                'name'=>'Admin',
                'email'=>'admin@admin.com',
                'role'=>1,
                'password'=> bcrypt('password'),
            ],
            [
                'name'=>'livreur',
                'email'=>'livreur@livreur.com',
                'role'=>2,
                'password'=> bcrypt('password'),
            ],
        ];
        // php artisan db:seed --class=CreateUsersSeeder
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
