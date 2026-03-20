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
        Schema::create('bookings', function (Blueprint $table) {
           $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('pay_method');
            $table->text('barcode');
            $table->string('slug');

            // New columns added for ticket details and barcode
            $table->string('booking_reference')->unique()->nullable();   // Unique ID for barcode
            $table->json('tickets')->nullable();                         // Stores selected tickets array
            $table->integer('total_tickets')->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            // Optional but recommended
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('confirmed');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
