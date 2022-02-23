<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('server_id')->nullable()
                ->constrained('servers')
                ->cascadeOnDelete();
            $table->string('steamid', 64);
            $table->unsignedTinyInteger('emulator')->default('0');
            $table->string('nick', 32)->default('');
            $table->ipAddress('ip');
            $table->string('password', 255)->nullable();
            $table->enum('auth_type', [
                'steamid',
                'steamid_pass',
                'nick_pass',
                'steamid_hash',
                'nick_hash',
            ])->default('steamid');
            $table->unique(['steamid', 'emulator'], 'steamid_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
