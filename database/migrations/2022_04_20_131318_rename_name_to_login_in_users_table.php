<?php

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
            if (Schema::hasColumn(self::tablename, 'name')) {
                $table->renameColumn('name', 'login');
            } else {
                throw new Exception('Column "name" does not exist, renaming to "login" was not performed.');
            }
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
            if (Schema::hasColumn(self::tablename, 'login')) {
                $table->renameColumn('login', 'name');
            } else {
                throw new Exception('Column "login" does not exist, renaming to "name" was not performed.');
            }
        });
    }
};
