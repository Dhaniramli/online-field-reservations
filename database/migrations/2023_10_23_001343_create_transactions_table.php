<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('final_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('schedule_ids');
            $table->string('total_price');
            $table->string('pay_early');
            $table->enum('status_pay_early', ['unpaid', 'paid', 'pending', 'expire', 'paid_final']);
            $table->string('pay_final');
            $table->enum('status_pay_final', ['unpaid', 'paid', 'pending', 'expire', 'paid_final']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
