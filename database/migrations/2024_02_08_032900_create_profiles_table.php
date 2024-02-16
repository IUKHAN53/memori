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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('title')->nullable();
            $table->string('relationship')->nullable();
            $table->string('picture')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('obituary_link')->nullable();
            $table->text('bio')->nullable();
            $table->text('heading_text')->nullable();
            $table->boolean('include_heading_text')->default(true);
            $table->text('quote_text')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
