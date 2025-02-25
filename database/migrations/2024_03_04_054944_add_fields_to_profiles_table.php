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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('cover_photo')->after('picture')->nullable();
            $table->string('cemetery_name')->after('city')->nullable();
            $table->string('cemetery_plot')->after('cemetery_name')->nullable();
            $table->string('cemetery_city')->after('cemetery_plot')->nullable();
            $table->string('cemetery_state')->after('cemetery_city')->nullable();
            $table->string('cemetery_lat')->after('cemetery_state')->nullable();
            $table->string('cemetery_lng')->after('cemetery_lat')->nullable();
            $table->string('donations_url')->after('cemetery_lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('cover_photo');
        });
    }
};
