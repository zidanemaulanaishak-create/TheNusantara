<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $logins = DB::table('tb_login')->get();
        foreach ($logins as $login) {
            $name = strstr($login->email, '@', true) ?: $login->email;
            DB::table('users')->updateOrInsert(
                ['email' => $login->email],
                [
                    'name' => $name,
                    'password' => $login->password, // bcrypt $2y$ kompatibel dgn Hash::check
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
