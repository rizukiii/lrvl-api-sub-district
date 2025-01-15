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
        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('nik_id');
            $table->string('title');
            $table->date('date');
            $table->unsignedBigInteger('hamlet_id');
            $table->enum('status',['diproses','diterima','ditolak'])->default('diproses');
            $table->text('requisite');

            $table->foreign('nik_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('hamlet_id')->references('id')->on('hamlets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            //
        });
    }
};
