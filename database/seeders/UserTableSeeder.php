<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['admin'];
        $roles = ['admin'];

        for ($i=0; $i < count($names); $i++) { 
            DB::table('users')->insert([
                'name' => $names[$i],
                'email' => $names[$i] . '@email.com',
                'password' => Hash::make($names[$i]),
                'roles' => $roles[$i]
            ]);
        }
    }
}
