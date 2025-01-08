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
        Schema::create('hamlet_galleries', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->unsignedBigInteger('hamlet_id');
            $table->timestamps();

            $table->foreign('hamlet_id')->references('id')->on('hamlets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
