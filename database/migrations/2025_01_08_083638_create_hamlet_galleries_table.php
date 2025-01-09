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
            $table->unsignedBigInteger('hamlet_detail_id');
            $table->timestamps();

            $table->foreign('hamlet_detail_id')->references('id')->on('hamlet_details')->onUpdate('cascade')->onDelete('cascade');
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
