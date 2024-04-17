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
        Schema::create('inforamtions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('familyName');
            $table->string('age');
            $table->boolean('gender');
            $table->string('military');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inforamtions');
    }
};
