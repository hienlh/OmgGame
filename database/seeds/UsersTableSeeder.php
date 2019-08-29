<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use OmgGame\Models\Role;
use OmgGame\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@maskcodex.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => Carbon::now(),
        ]);
        $admin->roles()->attach(Role::where('name', 'admin')->first());
        $admin->roles()->attach(Role::where('name', 'customer')->first());
        DB::table('users')->insert([
            'name' => 'Demo',
            'email' => 'demo@maskcodex.com',
            'password' => bcrypt('demo'),
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
