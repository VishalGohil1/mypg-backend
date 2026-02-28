<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {

            $table->id();

            // PG owner (user)
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Basic info
            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->nullable();

            $table->string('phone');
            $table->string('emergency_contact');

            $table->string('city');

            // Room info
            $table->string('room_number');

            // NEW FIELD you requested
            $table->unsignedInteger('bed_sharing')
                  ->comment('Example: 2, 3, 4, 6 sharing');

            // Rent info
            $table->decimal('rent_amount', 10, 2);

            // Optional info
            $table->string('occupation')->nullable();

            $table->text('remark')->nullable();

            // Future-ready fields
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Index for performance
            $table->index(['user_id', 'room_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};