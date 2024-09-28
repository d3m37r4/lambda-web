<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const tablename = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(self::tablename, function (Blueprint $table) {
            $table->after('password', function (Blueprint $table) {
                $table->unsignedTinyInteger('gender')->default(User::GENDER_NONE);
                $table->foreignId('country_id')->nullable()->constrained('countries');

                if (Schema::hasColumn(self::tablename, 'login') && !Schema::hasColumn(self::tablename, 'name')) {
                    $table->text('name')->nullable();
                } else {
                    throw new Exception('Column "name" already exists, new column "name" was not added.');
                }

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
    public function down(): void
    {
        Schema::table(self::tablename, function (Blueprint $table) {
            $table->dropColumn('gender');

            if (Schema::hasColumn(self::tablename, 'name')) {
                $table->dropColumn('name');
            } else {
                throw new Exception('Column "name" does not exist, deletion was not performed.');
            }

            $table->dropColumn('birth_date');
            $table->dropColumn('biography');
        });
    }
};
