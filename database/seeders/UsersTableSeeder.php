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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name'=>'Permission Admin',
                'username'=>'Admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('password'),
                'role'=>'admin',
                'status'=>'active'
            ],
            [
                'full_name'=>'Permission Vendor',
                'username'=>'Vendor',
                'email'=>'vendor@vendor.com',
                'password'=>Hash::make('password'),
                'role'=>'vendor',
                'status'=>'active'
            ],
            [
                'full_name'=>'Permission Customer',
                'username'=>'Customer',
                'email'=>'customer@customer.com',
                'password'=>Hash::make('password'),
                'role'=>'customer',
                'status'=>'active'
            ]
        ]);
    }
}
