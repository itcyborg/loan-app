<?php

use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles
        Role::create([
            'name'=>'Super Admin'
        ]);

        // permissions
        // charges
        Permission::create(['name'=>'view any charge']);
        Permission::create(['name'=>'view charge']);
        Permission::create(['name'=>'create charge']);
        Permission::create(['name'=>'update charge']);
        Permission::create(['name'=>'delete charge']);
        Permission::create(['name'=>'restore charge']);

        // collaterals

        Permission::create(['name'=>'view any collateral']);
        Permission::create(['name'=>'view collateral']);
        Permission::create(['name'=>'create collateral']);
        Permission::create(['name'=>'update collateral']);
        Permission::create(['name'=>'delete collateral']);
        Permission::create(['name'=>'restore collateral']);

        // customer

        Permission::create(['name'=>'view any customer']);
        Permission::create(['name'=>'view customer']);
        Permission::create(['name'=>'create customer']);
        Permission::create(['name'=>'update customer']);
        Permission::create(['name'=>'delete customer']);
        Permission::create(['name'=>'restore customer']);

        // disbursement

        Permission::create(['name'=>'view any disbursement']);
        Permission::create(['name'=>'view disbursement']);
        Permission::create(['name'=>'create disbursement']);
        Permission::create(['name'=>'update disbursement']);
        Permission::create(['name'=>'delete disbursement']);
        Permission::create(['name'=>'restore disbursement']);

        // guarantor

        Permission::create(['name'=>'view any guarantor']);
        Permission::create(['name'=>'view guarantor']);
        Permission::create(['name'=>'create guarantor']);
        Permission::create(['name'=>'update guarantor']);
        Permission::create(['name'=>'delete guarantor']);
        Permission::create(['name'=>'restore guarantor']);

        // loan

        Permission::create(['name'=>'view any loan']);
        Permission::create(['name'=>'view loan']);
        Permission::create(['name'=>'create loan']);
        Permission::create(['name'=>'update loan']);
        Permission::create(['name'=>'delete loan']);
        Permission::create(['name'=>'restore loan']);

        // next of kin

        Permission::create(['name'=>'view any next of kin']);
        Permission::create(['name'=>'view next of kin']);
        Permission::create(['name'=>'create next of kin']);
        Permission::create(['name'=>'update next of kin']);
        Permission::create(['name'=>'delete next of kin']);
        Permission::create(['name'=>'restore next of kin']);

        // product

        Permission::create(['name'=>'view any product']);
        Permission::create(['name'=>'view product']);
        Permission::create(['name'=>'create product']);
        Permission::create(['name'=>'update product']);
        Permission::create(['name'=>'delete product']);
        Permission::create(['name'=>'restore product']);

        // referee

        Permission::create(['name'=>'view any referee']);
        Permission::create(['name'=>'view referee']);
        Permission::create(['name'=>'create referee']);
        Permission::create(['name'=>'update referee']);
        Permission::create(['name'=>'delete referee']);
        Permission::create(['name'=>'restore referee']);

        // repayment

        Permission::create(['name'=>'view any repayment']);
        Permission::create(['name'=>'view repayment']);
        Permission::create(['name'=>'create repayment']);
        Permission::create(['name'=>'update repayment']);
        Permission::create(['name'=>'delete repayment']);
        Permission::create(['name'=>'restore repayment']);

        // revenue

        Permission::create(['name'=>'view any revenue']);
        Permission::create(['name'=>'view revenue']);
        Permission::create(['name'=>'create revenue']);
        Permission::create(['name'=>'update revenue']);
        Permission::create(['name'=>'delete revenue']);
        Permission::create(['name'=>'restore revenue']);

        // user

        Permission::create(['name'=>'view any user']);
        Permission::create(['name'=>'view user']);
        Permission::create(['name'=>'create user']);
        Permission::create(['name'=>'update user']);
        Permission::create(['name'=>'delete user']);
        Permission::create(['name'=>'restore user']);
    }
}
