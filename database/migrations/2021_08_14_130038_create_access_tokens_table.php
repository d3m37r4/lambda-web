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
        Schema::create('access_tokens', function (Blueprint $table) {
            $table->string('token');
            $table->timestamp('expires_at')->nullable();
            $table->foreignId('game_server_id')->constrained('game_servers')->cascadeOnDelete();
            $table->primary(['token', 'game_server_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('access_tokens');
    }
};
