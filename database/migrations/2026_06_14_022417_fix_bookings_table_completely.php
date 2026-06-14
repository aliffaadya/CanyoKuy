<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Pastikan email nullable
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('email', 100)->nullable()->change();
        });
        
        // 2. Tambah kolom participants jika belum ada
        if (!Schema::hasColumn('bookings', 'participants')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->integer('participants')->default(1);
            });
        }
        
        // 3. Tambah verified_at
        if (!Schema::hasColumn('bookings', 'verified_at')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->timestamp('verified_at')->nullable();
            });
        }
        
        // 4. Ubah enum payment_status dengan nilai yang benar
        DB::statement("ALTER TABLE bookings MODIFY payment_status ENUM('pending', 'waiting_confirmation', 'paid', 'cancelled', 'rejected') DEFAULT 'pending'");
        
        // 5. Update data lama jika ada yang pakai status 'waiting' atau 'confirmed'
        DB::table('bookings')->where('payment_status', 'waiting')->update(['payment_status' => 'waiting_confirmation']);
        DB::table('bookings')->where('payment_status', 'confirmed')->update(['payment_status' => 'paid']);
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('email', 100)->nullable(false)->change();
            $table->dropColumn('verified_at');
        });
        
        DB::statement("ALTER TABLE bookings MODIFY payment_status ENUM('pending', 'waiting', 'confirmed', 'paid') DEFAULT 'pending'");
    }
};