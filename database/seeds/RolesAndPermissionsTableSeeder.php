<?php

use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;

    class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::create(['name'=>'superadministrator']);
        $role=Role::create(['name'=>'administrator']);
        $role=Role::create(['name'=>'user']);
    }
}
