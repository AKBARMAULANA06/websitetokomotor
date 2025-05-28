<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [

                'name'=>'mas akbar',
                'email'=>'akbar@gmail.com',
                'role'=>'operator',
                'password'=>'bcrypt'('12345')
            ],

            [

                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'password'=>'bcrypt'('12345')
            ],

           
        ];

        foreach($userData as $key => $val){
            User::created($val);
        }
    }
}
