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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('server_id')->nullable()
                ->constrained('servers')
                ->cascadeOnDelete();
            $table->string('name', 32)->nullable();
            $table->string('authid', 64)->nullable();
            $table->string('ip', 16)->nullable();
            // See Reunion API:
            // https://github.com/s1lentq/reapi/blob/e808d72075f5018336c15955f8d2d68e8f2cc084/reapi/include/reunion_api.h
            $table->enum('auth_type', [
                'auth_none',
                'auth_dproto',
                'auth_steam',
                'auth_steamemu',
                'auth_revemu',
                'auth_oldrevemu',
                'auth_hltv',
                'auth_sc2009',
                'auth_avsmp',
                'auth_sxei',
                'auth_revemu2013',
                'auth_sse3'
            ])->default('auth_none');
            $table->unique(['server_id', 'authid', 'auth_type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
