<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\InfoPersonal;
use App\Models\Admin\InfoAcademic;
use App\Models\Admin\InfoFamily;
use App\Models\Admin\InfoOther;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supper_admin = User::create([
            'name'=>'Gulf-ERP',
            'email'=>'admin@gmail.com',
            'contact_number'=>'01909302126',
            'password'=>bcrypt('password'),
            'status' => '1',
            'is_admin' => '1',
            'profile_photo_path'=>'fix/admin.jpg',
            'email_verified_at' => '2000-01-01',
        ]);
        /*__________________________________________________________ */
        /*__________________________________________________________ */

        $supper_admin_role = Role::create(['name' => 'Supper-Admin']);
        $admin_role = Role::create(['name' => 'Admin']);
        $member_role = Role::create(['name' => 'Member']);

        $permissions = [
            /*_____Menu Access_____*/
            ['name' => 'Setting access'],
            ['name' => 'Pages access'],
            
            //-----Gallery Access
            ['name' => 'Gallery access'],
            ['name' => 'Gallery create'],
            ['name' => 'Gallery edit'],
            ['name' => 'Gallery delete'],

            //-----Member Access
            ['name' => 'Member access'],
            ['name' => 'Approve Member'],
            ['name' => 'Member create'],
            ['name' => 'Member edit'],
            ['name' => 'Member delete'],
            
            //-----User Access
            ['name' => 'User access'],
            ['name' => 'User create'],
            ['name' => 'User edit'],
            ['name' => 'User delete'],
            
            //-----Role Access
            ['name' => 'Role access'],
            ['name' => 'Role create'],
            ['name' => 'Role edit'],
            ['name' => 'Role delete'],
        ];

        foreach ($permissions as $item) {
            Permission::create($item);
        }

        $supper_admin->assignRole($supper_admin_role);

        $supper_admin_role->givePermissionTo(Permission::all());
        $member_role->givePermissionTo('Gallery access');

    }
}
