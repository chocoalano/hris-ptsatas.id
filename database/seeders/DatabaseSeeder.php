<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $permission=[
            'viewAny Permission',
            'view Permission',
            'create Permission',
            'update Permission',
            'delete Permission',

            'viewAny Role',
            'view Role',
            'create Role',
            'update Role',
            'delete Role',

            'viewAny Team',
            'view Team',
            'create Team',
            'update Team',
            'delete Team',

            'viewAny User',
            'view User',
            'create User',
            'update User',
            'delete User',

            'viewAny Customer',
            'view Customer',
            'create Customer',
            'update Customer',
            'delete Customer',

            'viewAny ProjectList',
            'view ProjectList',
            'create ProjectList',
            'update ProjectList',
            'delete ProjectList',

            'viewAny ProjectTask',
            'view ProjectTask',
            'create ProjectTask',
            'update ProjectTask',
            'delete ProjectTask',
        ];
        $insertPermission=[];
        foreach ($permission as $key) {
            array_push($insertPermission, [
                "name"=>$key,
                "description"=>'This is permission for function '.$key
            ]);
        }
        \App\Models\Config\Permission::insert($insertPermission);

        $role=['Superadmin', 'Founder Development', 'Founder Marketing', 'Founder Content Creator', 'Founder Management', 'Founder Analyst/R&D'];
        $insertRole=[];
        foreach ($role as $key) {
            array_push($insertRole, [
                "name"=>$key,
                "description"=>'This is role for access '.$key
            ]);
        }
        \App\Models\Config\Role::insert($insertRole);

        $userlist=['superadmin', 'alan', 'pakholid', 'wanti', 'ulfa', 'pampam'];
        $insertUser=[];
        foreach ($userlist as $key) {
            switch ($key) {
                case 'alan':
                    $role=\App\Models\Config\Role::where('name', 'Founder Development')->first();
                    break;
                case 'pakholid':
                    $role=\App\Models\Config\Role::where('name', 'Founder Marketing')->first();
                    break;
                case 'wanti':
                    $role=\App\Models\Config\Role::where('name', 'Founder Management')->first();
                    break;
                case 'ulfa':
                    $role=\App\Models\Config\Role::where('name', 'Founder Analyst/R&D')->first();
                    break;
                case 'pampam':
                    $role=\App\Models\Config\Role::where('name', 'Founder Content Creator')->first();
                    break;
                
                default:
                    $role=\App\Models\Config\Role::where('name', 'Superadmin')->first();
                    break;
            }
            array_push($insertUser, [
                'role_id'=>$role->id,
                'name'=>$key,
                'email'=>$key.'@satas-erp.tes',
                'password'=>bcrypt('123456'),
                'phone'=>'3253245423',
            ]);
        }
        \App\Models\User::insert($insertUser);
    }
}
