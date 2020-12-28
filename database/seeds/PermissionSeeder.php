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
        Permission::create(['name'=>'list charges']);
        Permission::create(['name'=>'create charge']);
        Permission::create(['name'=>'']);
        Permission::create(['name'=>'list charges']);
        Permission::create(['name'=>'list charges']);
    }
}
