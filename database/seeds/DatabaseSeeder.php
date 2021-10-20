<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserPermissionTableSeeder::class);
        $this->call(BackendMenuTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);

	}
}
