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
        Schema::create('field_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_list_id');
            $table->string('date');
            $table->string('time_start');
            $table->string('time_finish');
            $table->string('price');
            $table->enum('is_booked', ['available', 'pending', 'booked'])->default('available');
            $table->timestamps();

            $table->foreign('field_list_id')->references('id')->on('field_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_schedules');
    }
};
