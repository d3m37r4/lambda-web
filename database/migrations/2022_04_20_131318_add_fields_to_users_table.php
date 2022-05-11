<?php

use App\Models\User;
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
            $table->renameColumn('name', 'login');
            $table->after('password', function ($table) {
//                $table->ipAddress('ip')->nullable();
                $table->foreignId('country_id')->nullable()->constrained('countries');
                $table->text('full_name')->nullable();
                $table->enum('gender', User::GENDERS)->default(User::GENDER_NONE);
                $table->date('birth_date')->nullable();
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
            $table->renameColumn('login', 'name');
//            $table->dropColumn('ip');
            $table->dropForeign('country_id');
            $table->dropColumn('full_name');
            $table->dropColumn('gender');
            $table->dropColumn('birth_date');
            $table->dropColumn('biography');
        });
    }
}
