<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleName = ['user', 'moderator', 'administrator'];
        $roles = [];

        for ($i = 0; $i < count($roleName); $i++) {
            $roles[] = [
                'name' => $roleName[$i],
            ];
        }
        DB::table('roles')->insert($roles);
    }
}
