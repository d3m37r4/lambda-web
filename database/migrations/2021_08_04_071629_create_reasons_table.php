<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id')->nullable()
                ->constrained('servers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title');
            $table->unsignedInteger('time')->nullable();
//            $table->unsignedTinyInteger('overall');
//            $table->unsignedTinyInteger('menu');
//            $table->unsignedTinyInteger('active');
            $table->timestamps();
            $table->unique(['server_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reasons');
    }
}
