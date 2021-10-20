<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'     => 'admin',
            'last_name'      => 'admin',
            'username'       => 'admin',
            'email'          => 'admin@example.com',
            'phone'          => '+00000000',
            'address'        => 'India',
            'password'       => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'location_id'    => '1',

        ]);

        $user = User::create([
            'first_name'     => 'Reception',
            'last_name'      => 'Demo',
            'username'       => 'reception',
            'email'          => 'reception@example.com',
            'phone'          => '+000000',
            'address'        => 'India',
            'password'       => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'location_id'    => '1',

        ]);
        $role = Role::where('name','Reception')->first();
        $user->assignRole($role->name);
    }
}
