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
        Schema::create('hamlet_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hamlets_id');
            $table->text('maps');
            $table->timestamps();

            $table->foreign('hamlets_id')->references('id')->on('hamlets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hamlet_details');
    }
};
