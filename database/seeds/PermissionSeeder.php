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
        #charges
        Permission::create(['name'=>'view any charge']);
        Permission::create(['name'=>'view charge']);
        Permission::create(['name'=>'create charge']);
        Permission::create(['name'=>'update charge']);
        Permission::create(['name'=>'delete charge']);
        Permission::create(['name'=>'restore charge']);
    }
}
