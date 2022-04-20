<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('password', function ($table) {
                $table->ipAddress('ip');
                $table->foreignId('country_id')->nullable()->constrained('countries');
                $table->text('full_name')->nullable();
                $table->enum('gender', [
                    'male',
                    'female',
                    'gender x',
                    'not specified'
                ])->default('not specified');
                $table->date('date_of_birth')->nullable();
                $table->text('biography')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ip');
            $table->dropColumn('country_id');
            $table->dropColumn('full_name');
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('biography');
        });
    }
}
