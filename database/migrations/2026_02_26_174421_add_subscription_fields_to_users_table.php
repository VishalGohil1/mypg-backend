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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('account_status', ['pending','active','expired'])
                ->default('pending');

            $table->date('subscription_start')->nullable();
            $table->date('subscription_end')->nullable();

            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
