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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hamlet_id');
            $table->unsignedBigInteger('rt_id');
            $table->string('work');
            $table->enum('annotation',['Sudah Terlaksana','Belum Terlaksana'])->default('Belum Terlaksana');
            $table->timestamps();

            $table->foreign('hamlet_id')->references('id')->on('hamlets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rt_id')->references('id')->on('hamlet_numbers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
