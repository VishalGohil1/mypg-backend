<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::table('rent_payments', function (Blueprint $table) {
            $table->enum('payment_mode', ['upi', 'cash', 'both'])
                ->nullable()
                ->after('status');
            $table->decimal('upi_amount', 10, 2)
                ->nullable()
                ->after('payment_mode');
            $table->decimal('cash_amount', 10, 2)
                ->nullable()
                ->after('upi_amount');
        });

        // Also update the status enum to allow 'partial'
        DB::statement("ALTER TABLE rent_payments MODIFY COLUMN status ENUM('paid','pending','partial') NOT NULL");
    }

    public function down(): void
    {
        Schema::table('rent_payments', function (Blueprint $table) {
            $table->dropColumn(['payment_mode', 'upi_amount', 'cash_amount']);
        });
        DB::statement("ALTER TABLE rent_payments MODIFY COLUMN status ENUM('paid','pending') NOT NULL");
    }
};
