<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // otomatis yg di klik
            $table->date('tanggal'); // otomatis dari sistem
            $table->text('keperluan');
            $table->integer('NIK_id'); //otomatis dari user nik
            $table->text('alamat'); // otomatis dari user
            $table->enum('status',['diproses','ditolak','diterima'])->default('diproses'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
