<?php

use App\Models\Employee;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name'     => 'Parth',
            'last_name'      => 'Shah',
            'username'       => 'employee',
            'email'          => 'parthshah@cybit.in',
            'phone'          => '+09876543210',
            'address'        => 'Nandesari, Gujarat',
            'password'       => bcrypt('123456'),
            'remember_token' => Str::random(10),
                        'location_id'    => '1',

        ]);
        $role = Role::where('name','Employee')->first();
        $user->assignRole($role->name);
        Employee::create([
            'first_name'        => 'Parth',
            'last_name'         => 'Shahs',
            'user_id'           => $user->id,
            'phone'             => '+09876543210',
            'gender'            => 5,
            'department_id'     => \App\Models\Department::first()->id,
            'location_id'     => \App\Models\Location::first()->id,
            'designation_id'    => 1,
            'date_of_joining'   => '2020-01-12',
            'about'             =>  '',
            'status'            => 5,
            'creator_type'    => 'App\User',
            'creator_id'      => 1,
            'editor_type'     => 'App\User',
            'editor_id'       => 1,
            'location_id'    => '1',

        ]);
    }
}