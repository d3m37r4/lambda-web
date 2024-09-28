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
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_server_id')->nullable()
                ->constrained('game_servers')
                ->cascadeOnDelete();
            $table->string('title');
            $table->unsignedInteger('time')->nullable();
//            $table->unsignedTinyInteger('overall');
//            $table->unsignedTinyInteger('menu');
//            $table->unsignedTinyInteger('active');
            $table->timestamps();
            $table->unique(['game_server_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('reasons');
    }
};
