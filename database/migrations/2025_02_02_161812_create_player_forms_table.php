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
        Schema::create('player_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('age');
            $table->string('name_of_old_club')->nullable();
            $table->string('name_of_current_club')->nullable();
            $table->string('job_of_parent')->nullable();
            $table->string('long_life_desises')->nullable();
            $table->string('injuries')->nullable();
            $table->json('images')->nullable();
            $table->string('city_name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_forms');
    }
};
