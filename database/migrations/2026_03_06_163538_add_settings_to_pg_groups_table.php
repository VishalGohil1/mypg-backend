<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pg_groups', function (Blueprint $table) {
            $table->string('hostel_name')->nullable()->after('name');
            $table->integer('available_beds')->nullable()->after('hostel_name');
        });
    }

    public function down()
    {
        Schema::table('pg_groups', function (Blueprint $table) {
            $table->dropColumn(['hostel_name', 'available_beds']);
        });
    }
};
