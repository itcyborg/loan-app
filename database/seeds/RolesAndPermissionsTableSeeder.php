<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        $role=Role::create(['name'=>'agent']);


        $permission=Permission::create(['name'=>'view_loan']);
        $permission=Permission::create(['name'=>'apply_loan']);
        $permission=Permission::create(['name'=>'approve_loan']);
        $permission=Permission::create(['name'=>'disburse_loan']);
        $permission=Permission::create(['name'=>'reject_loan']);


        $permission=Permission::create(['name'=>'create_product']);
        $permission=Permission::create(['name'=>'view_product']);
        $permission=Permission::create(['name'=>'activate_product']);
        $permission=Permission::create(['name'=>'update_product']);
        $permission=Permission::create(['name'=>'delete_product']);


        $permission=Permission::create(['name'=>'create_charge']);
        $permission=Permission::create(['name'=>'view_charge']);
        $permission=Permission::create(['name'=>'update_charge']);
        $permission=Permission::create(['name'=>'delete_charge']);


        $permission=Permission::create(['name'=>'create_client']);
        $permission=Permission::create(['name'=>'view_client']);
        $permission=Permission::create(['name'=>'update_client']);
        $permission=Permission::create(['name'=>'delete_client']);


        $permission=Permission::create(['name'=>'create_user']);


        $permission=Permission::create(['name'=>'create_payment']);
        $permission=Permission::create(['name'=>'view_payment']);


        $permission=Permission::create(['name'=>'add_income_expense']);
        $permission=Permission::create(['name'=>'view_income_expense']);
        $permission=Permission::create(['name'=>'approve_income_expense']);


        $permission=Permission::create(['name'=>'view_schedule']);


        $permission=Permission::create(['name'=>'view_reports']);
    }
}
