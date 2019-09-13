<?php

use Illuminate\Database\Seeder;
use OmgGame\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'games',
                'display_name' => 'Manage Games',
                'description' => 'User has access to manage all games'
            ],
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Allow user to create and manage their games'
            ],
            [
                'name' => 'roles',
                'display_name' => 'Manage Roles',
                'description' => 'User has access to manage roles'
            ],
            [
                'name' => 'users',
                'display_name' => 'Manage Users',
                'description' => 'Allow user to manage system users'
            ],
            [
                'name' => 'permissions',
                'display_name' => 'Manage Permissions',
                'description' => 'User has access to manage permissions'
            ],
            [
                'name' => 'info_forms',
                'display_name' => 'Manage Info Forms',
                'description' => 'User has access to manage info forms'
            ]
        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
