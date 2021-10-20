<?php

use App\Models\BackendMenu;
use Illuminate\Database\Seeder;

class BackendMenuTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $menus = [
            [
                'name'      => 'Dashboard',
                'link'      => 'dashboard',
                'icon'      => 'fas fa-laptop',
                'parent_id' => 0,
                'priority'  => 9000,
                'status'    => 1,
            ],
            [
                'name'      => 'Profile',
                'link'      => 'profile',
                'icon'      => 'far fa-user',
                'parent_id' => 0,
                'priority'  => 8900,
                'status'    => 1,
            ],
            [
                'name'      => 'Departments',
                'link'      => 'departments',
                'icon'      => 'fas fa-building',
                'parent_id' => 0,
                'priority'  => 8800,
                'status'    => 1,
            ],
            [
                'name'      => 'Locations',
                'link'      => 'locations',
                'icon'      => 'fas fa-map',
                'parent_id' => 0,
                'priority'  => 8700,
                'status'    => 1,
            ],
            [
                'name'      => 'Languages',
                'link'      => 'languages',
                'icon'      => 'fas fa-language',
                'parent_id' => 0,
                'priority'  => 8650,
                'status'    => 1,
            ],
            [
                'name'      => 'Videos',
                'link'      => 'videos',
                'icon'      => 'fas fa-video',
                'parent_id' => 0,
                'priority'  => 8625,
                'status'    => 1,
            ],

            [
                'name'      => 'Questions',
                'link'      => 'questions',
                'icon'      => 'fas fa-question-circle',
                'parent_id' => 0,
                'priority'  => 8624,
                'status'    => 1,
            ],




            [
                'name'      => 'Designations',
                'link'      => 'designations',
                'icon'      => 'fas fa-layer-group',
                'parent_id' => 0,
                'priority'  => 8600,
                'status'    => 1,
            ],
            [
                'name'      => 'Employees',
                'link'      => 'employees',
                'icon'      => 'fas fa-user-secret',
                'parent_id' => 0,
                'priority'  => 8500,
                'status'    => 1,
            ],
            [
                'name'      => 'Visitors',
                'link'      => 'visitors',
                'icon'      => 'fas fa-walking',
                'parent_id' => 0,
                'priority'  => 8400,
                'status'    => 1,
            ],
            [
                'name'      => 'Pre-registers',
                'link'      => 'pre-registers',
                'icon'      => 'fas fa-user-friends',
                'parent_id' => 0,
                'priority'  => 8300,
                'status'    => 1,
            ],
            [
                'name'      => 'Administrators',
                'link'      => 'adminusers',
                'icon'      => 'fas fa-users',
                'parent_id' => 0,
                'priority'  => 8200,
                'status'    => 1,
            ],
            [
                'name'      => 'Role',
                'link'      => 'role',
                'icon'      => 'fa fa-star',
                'parent_id' => 0,
                'priority'  => 8100,
                'status'    => 1,
            ],
            [
                'name'      => 'Settings',
                'link'      => 'setting',
                'icon'      => 'fas fa-cogs',
                'parent_id' => 0,
                'priority'  => 8000,
                'status'    => 1,
            ],
        ];

        BackendMenu::insert($menus);
    }
}


