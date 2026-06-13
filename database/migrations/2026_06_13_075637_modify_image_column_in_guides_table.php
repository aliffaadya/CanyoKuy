<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('guides', function (Blueprint $table) {
            // Ubah tipe data kolom image menjadi longtext
            $table->longText('image')->change();
        });
    }

    public function down()
    {
        Schema::table('guides', function (Blueprint $table) {
            // Kembalikan ke varchar(255) jika rollback
            $table->string('image', 255)->change();
        });
    }
};