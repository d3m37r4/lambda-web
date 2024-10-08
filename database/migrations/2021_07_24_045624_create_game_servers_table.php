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
        Schema::create('game_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ip', 16);
            $table->integer('port');
            $table->string('rcon', 128)->nullable();
            $table->foreignId('map_id')->nullable()->constrained('maps');
            $table->string('auth_token')->nullable();
            $table->unsignedTinyInteger('max_players')->default(0);
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->unique(['ip', 'port']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('game_servers');
    }
};
