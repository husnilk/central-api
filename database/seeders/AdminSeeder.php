<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => bcrypt('admin'),
            'email' => 'admin@admin.com',
            'type' => 3,
            'active' => 1
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $system_roles = config('central.system_roles');

        $admin = null;
        foreach ($system_roles as $type => $role) {
            if ($type == 'administrator')
                $admin = Role::create(['name' => $role]);
            else
                Role::create(['name' => $role]);
        }

        $permissions = [
            'users_manage',
            'roles_access',
            'roles_manage',
            'departments_access',
            'departments_manage',
            'faculties_access',
            'faculties_manage',
            'students_access',
            'students_manage',
            'lecturers_access',
            'lecturers_manage',
            'staffs_access',
            'staffs_manage',
            'rooms_access',
            'rooms_manage',
            'researches_access',
            'researches_manage',
            'community_services_access',
            'community_services_manage',
            'theses_access',
            'theses_manage'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $admin->givePermissionTo($permission);
        }

        $permissions = [
            'thesis_do',
            'thesis_supervise',
            'theses_control'
        ];

        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $user->assignRole('admin');
    }
}
