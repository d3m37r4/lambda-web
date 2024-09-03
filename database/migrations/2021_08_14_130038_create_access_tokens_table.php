<?php

use App\Models\GameServer\AccessToken;
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
            $table->id();
            $table->string('token', AccessToken::MAX_ACCESS_TOKEN_LENGTH)->nullable()->unique();
            $table->timestamp('expires_in')->nullable();
            $table->foreignId('game_server_id')->nullable()
                ->constrained('game_servers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
