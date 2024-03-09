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
        \App\Models\Config\Role::create([
            'name'=>'Superadmin',
            'description'=>'for development only.'
        ]);
        \App\Models\User::factory()->create([
            'role_id'=>1,
            'name'=>'Super admin',
            'email'=>'superadmin@ptsas.tes',
            'password'=>bcrypt('123456'),
            'mobile_phone'=>'8234872349',
            'phone'=>'3253245423',
            'placebirth'=>'lorem',
            'birthdate'=>Date('Y-m-d'),
            'gender'=>'male',
            'bloodtype'=>'A',
            'religion'=>'Islam',
            'identity_address'=>'KTP',
            'identity_numbers'=>'872349823473487',
            'identity_expired'=>Date('Y-m-d'),
            'postal_code'=>'234234',
            'citizen_idaddress'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'recidential_address'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]);
    }
}
