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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('status_code');
            $table->string('status_message');
            $table->string('transaction_id');
            $table->string('order_id');
            $table->decimal('gross_amount', 10, 2);
            $table->string('payment_type');
            $table->dateTime('transaction_time');
            $table->string('transaction_status');
            $table->string('fraud_status');
            $table->string('payment_code');
            $table->string('pdf_url');
            $table->string('finish_redirect_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
