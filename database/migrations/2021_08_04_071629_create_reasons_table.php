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
//            $table->unsignedInteger('server_id')->references('id')->on('servers');
            $table->foreignId('server_id')->nullable()->constrained('servers');
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
