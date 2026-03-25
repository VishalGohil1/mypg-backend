<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('pg_name')->nullable()->after('id');

            $table->string('first_name')->nullable()->after('pg_name');

            $table->string('last_name')->nullable()->after('first_name');

            $table->string('phone')->nullable()->after('email');

            $table->string('city')->nullable()->after('phone');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'pg_name',
                'first_name',
                'last_name',
                'phone',
                'city'
            ]);

        });
    }
};