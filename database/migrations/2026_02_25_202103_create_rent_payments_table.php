<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rent_payments', function (Blueprint $table) {

        $table->id();

        $table->foreignId('member_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('pg_group_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->decimal('amount', 10, 2);

        $table->date('payment_date');

        $table->string('payment_month'); // 2026-02

        $table->foreignId('collected_by')
            ->constrained('users');

        $table->enum('status', ['paid', 'pending']);

        $table->text('remark')->nullable();

        $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_payments');
    }
};
