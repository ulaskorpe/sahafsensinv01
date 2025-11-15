<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = new User();
       $user->password= Hash::make('123123');
       $user->name = 'ulas korpe';
       $user->email = 'ulaskorpe@gmail.com';
       $user->admin_code = rand(100000,999999);
       $user->save();
    }
}
