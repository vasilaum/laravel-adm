<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => "Huanter Batista",
            'email'     => "adm@adm.com.br",
            'master'    => true,
            'password'  => Hash::make("abc-123")
        ]);

        DB::table('system_modules')->insert([
            [
                'name'      => "System Modules",
                'codename'  => "system-modules"
            ],[
                'name'      => "Users",
                'codename'  => "users"
            ],[
                'name'      => "System Modules Actions",
                'codename'  => "system-modules-actions"
            ]
        ]);

        DB::table('system_permissions')->insert([
            [
                'name'              => "list system modules",
                'url_action'        => "system-modules",
                'http_method'       => "GET",
                'system_module_id'  => 1
            ],[
                'name'              => "list users",
                'url_action'        => "users",
                'http_method'       => "GET",
                'system_module_id'  => 2
            ],[
                'name'              => "list system permissions",
                'url_action'        => "system-permissions/{param}/{param}",
                'http_method'       => "GET",
                'system_module_id'  => 3
            ]
        ]);

        DB::table('system_permissions_users')->insert([
            [
                'user_id'                   => 1,
                'system_permission_id'      => 1
            ],[
                'user_id'                   => 1,
                'system_permission_id'      => 2
            ],[
                'user_id'                   => 1,
                'system_permission_id'      => 3
            ]
        ]);
    }
}