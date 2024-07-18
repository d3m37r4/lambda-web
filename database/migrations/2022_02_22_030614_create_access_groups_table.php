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
        Schema::create('access_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id')->nullable()
                ->constrained('servers')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('flags');
            $table->string('prefix');
            $table->timestamps();
            $table->unique(['server_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('access_groups');
    }
};
