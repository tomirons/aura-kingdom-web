<?php

use App\Permission;
use App\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);
        $mod = Role::find(2);

        if ( !DB::table('permissions')->where('name', 'access-acp' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'access-acp';
            $permission->display_name = 'Access Admin CP';
            $permission->save();

            $admin->attachPermission($permission);
            $mod->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'manage-system' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'manage-system';
            $permission->display_name = 'Manage System';
            $permission->save();

            $admin->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'manage-articles' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'manage-articles';
            $permission->display_name = 'Manage Articles';
            $permission->save();

            $admin->attachPermission($permission);
            $mod->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'change-donate-settings' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'change-donate-settings';
            $permission->display_name = 'Change Donation Settings';
            $permission->save();

            $admin->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'manage-vote-sites' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'manage-vote-sites';
            $permission->display_name = 'Manage Voting Sites';
            $permission->save();

            $admin->attachPermission($permission);
            $mod->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'manage-ranking-settings' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'manage-ranking-settings';
            $permission->display_name = 'Manage Rakning Settings';
            $permission->save();

            $admin->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'manage-users' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'manage-users';
            $permission->display_name = 'Manage Users';
            $permission->save();

            $admin->attachPermission($permission);
            $mod->attachPermission($permission);
        }

        if ( !DB::table('permissions')->where('name', 'manage-permissions' )->exists() )
        {
            $permission = new Permission();
            $permission->name = 'manage-permissions';
            $permission->display_name = 'Manage Users Permissions';
            $permission->save();

            $admin->attachPermission($permission);
        }
    }
}
