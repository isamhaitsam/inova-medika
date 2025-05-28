<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name_role' => 'Admin',        'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_role' => 'Kasir',        'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_role' => 'Dokter',       'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_role' => 'Pendaftaran',  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('roles')->insert($roles);
    }
}
