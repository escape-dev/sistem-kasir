<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kasir = new User;
        $admin = new User;
        $password = Hash::make('password');


        // seeder admin
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->email_verified_at = now();
        $admin->password = $password;
        $admin->role = 'admin';
        $admin->remember_token = Str::random(10);
        $admin->save();

        // seeder kasir
        $kasir->name = 'kasir';
        $kasir->email = 'kasir@kasir.com';
        $kasir->email_verified_at = now();
        $kasir->password = $password;
        $kasir->role = 'kasir';
        $kasir->remember_token = Str::random(10);
        $kasir->save();
    }
}
