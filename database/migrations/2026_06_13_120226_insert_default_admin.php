<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'email' => 'admin@canyokuy.com',
            'password' => Hash::make('admin123'),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        DB::table('admins')->where('username', 'admin')->delete();
    }
};