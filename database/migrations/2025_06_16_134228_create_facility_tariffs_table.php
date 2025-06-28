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
        Schema::create('facility_tariffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id');

            $table->enum('rental_type', ['Umum', 'Pembinaan', 'Sosial']);
            $table->enum('day_type', ['Weekday', 'Weekend']);
            $table->enum('time_type', ['Siang', 'Malam']);
            $table->decimal('price', 12, 2);

            $table->timestamps();

            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_tariffs');
    }
};
