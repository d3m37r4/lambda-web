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
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id')->nullable()
                ->constrained('servers')
                ->cascadeOnDelete();
            $table->string('key', 64);
            $table->string('description');
            $table->timestamps();
            $table->unique(['server_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('accesses');
    }
};
