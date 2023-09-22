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
        Schema::create('data_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_list_id');
            $table->string('time');
            $table->string('price');
            $table->timestamps();

            $table->foreign('field_list_id')->references('id')->on('field_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_fields');
    }
};
