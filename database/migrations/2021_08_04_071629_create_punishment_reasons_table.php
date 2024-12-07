<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('punishment_reasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_server_id')->constrained('game_servers')->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('time')->nullable();
            $table->timestamps();
            $table->unique(['game_server_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('punishment_reasons');
    }
};
