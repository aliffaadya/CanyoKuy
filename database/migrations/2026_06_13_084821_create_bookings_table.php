<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 50)->unique();
            $table->string('package_name', 100);
            $table->string('customer_name', 100);
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->integer('participants')->default(1);
            $table->date('booking_date');
            $table->integer('total_price');
            $table->integer('dp_amount')->nullable();
            $table->integer('remaining_amount')->nullable();
            $table->text('notes')->nullable();
            $table->string('payment_proof')->nullable();
            $table->enum('payment_status', ['pending', 'waiting_confirmation', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};