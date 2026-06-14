// Buat migration baru untuk menambahkan status rejected
// php artisan make:migration add_rejected_status_to_bookings_table

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectedStatusToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Ubah enum status untuk menambahkan 'rejected'
            $table->enum('payment_status', ['pending', 'waiting_confirmation', 'paid', 'rejected'])
                  ->default('pending')
                  ->change();
            
            // Tambah kolum reason jika diperlukan
            $table->text('rejection_reason')->nullable();
            $table->timestamp('rejected_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'waiting_confirmation', 'paid'])
                  ->default('pending')
                  ->change();
            $table->dropColumn(['rejection_reason', 'rejected_at']);
        });
    }
}