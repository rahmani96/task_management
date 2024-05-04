<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'show tasks']);
        Permission::create(['name' => 'add tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);
        Permission::create(['name' => 'complete tasks']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('show tasks');
        $role2->givePermissionTo('add tasks');
        $role2->givePermissionTo('edit tasks');
        $role2->givePermissionTo('delete tasks');
        $role2->givePermissionTo('complete tasks');

        $role3 = Role::create(['name' => 'writer']);
        $role3->givePermissionTo('show tasks');
        $role3->givePermissionTo('add tasks');
        $role3->givePermissionTo('edit tasks');
        $role3->givePermissionTo('delete tasks');
        $role3->givePermissionTo('complete tasks');

        // create roles and assign existing permissions
        $role4 = Role::create(['name' => 'viewer']);
        $role4->givePermissionTo('show tasks');

        // create demo users
        $user = User::find(1);
        $user->assignRole($role1);

        $user = User::find(2);
        $user->assignRole($role2);

        $user = User::find(3);
        $user->assignRole($role3);

        $user = User::find(4);
        $user->assignRole($role4);
    }
}
