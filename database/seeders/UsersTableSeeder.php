<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [ 'name'=>'Admin',
                    'username'=>'admin',
                    'email'=>'admin@hotmail.com',
                    'password'=>Hash::make('111'),
                    'role'=>'admin',
                    'status'=>'active'],
                [
                    'name'=>'Ariyan Vendor',
                    'username'=>'vendor',
                    'email'=>'vendor@hotmail.com',
                    'password'=>Hash::make('111'),
                    'role'=>'vendor',
                    'status'=>'active'
                ],
                [
                    'name'=>'User',
                    'username'=>'user',
                    'email'=>'user@hotmail.com',
                    'password'=>Hash::make('111'),
                    'role'=>'user',
                    'status'=>'active'
                ]


            ]




        );
    }
}
