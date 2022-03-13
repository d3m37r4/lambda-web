<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable()
                ->constrained('players')
                ->cascadeOnDelete();
            $table->foreignId('server_id')->nullable()
                ->constrained('servers')
                ->cascadeOnDelete();
            $table->enum('status', [
                'online',
                'offline',
            ])->default('offline');
            $table->timestamps();
            $table->timestamp('disconnected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_sessions');
    }
}
