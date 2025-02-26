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
        Schema::table('hamlet_details', function (Blueprint $table) {
            $table->double('latitude')->after('hamlets_id');
            $table->double('longitude')->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hamlet_details', function (Blueprint $table) {
        });
    }
};
