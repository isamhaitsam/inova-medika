<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'roles_id' => DB::table('roles')->where('name_role', 'Admin')->value('id'),
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // ganti dengan password yang aman
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'roles_id' => DB::table('roles')->where('name_role', 'Kasir')->value('id'),
                'name' => 'Nika',
                'email' => 'kasir@example.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'roles_id' => DB::table('roles')->where('name_role', 'Dokter')->value('id'),
                'name' => 'Sammy',
                'email' => 'dokter@example.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'roles_id' => DB::table('roles')->where('name_role', 'Pendaftaran')->value('id'),
                'name' => 'Vika',
                'email' => 'pendaftaran@example.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
