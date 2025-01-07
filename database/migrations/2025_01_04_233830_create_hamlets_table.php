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
        Schema::create('hamlets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('hamlet_numbers_id');
            $table->text('image');
            $table->text('title');
            $table->timestamps();

            $table->foreign('hamlet_numbers_id')->references('id')->on('hamlet_numbers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hamlets');
    }
};
