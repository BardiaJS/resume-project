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
        Schema::create('graduations', function (Blueprint $table) {
            $table->string('level')->default('');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->references('id')->on('users');
            $table->string('high_school_major')->nullable();
            $table->string('university_major')->nullable();
            $table->string('university_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduations');
    }
    
};
