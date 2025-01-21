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
        Schema::table('hamlet_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('hamlet_id')->after('village');
            $table->foreign('hamlet_id')->references('id')->on('hamlets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hamlet_numbers', function (Blueprint $table) {
            //
        });
    }
};
