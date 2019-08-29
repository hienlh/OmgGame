<?php

use Illuminate\Database\Seeder;
use OmgGame\Models\Permission;
use OmgGame\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'User has access to all system functionality'
        ]);
        $admin->perms()->attach(Permission::all());

        $customer = Role::create([
            'name' => 'customer',
            'display_name' => 'Customer',
            'description' => 'User has access to create and manage their games'
        ]);
        $customer->perms()->attach(Permission::where('name', 'customer')->first());
    }
}
