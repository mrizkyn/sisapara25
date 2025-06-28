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
        Schema::create('reservations', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('facility_id')->nullable();
            $table->unsignedBigInteger('facility_tariff_id')->nullable();
            $table->string('image');
            $table->string('letter')->nullable();

            $table->unsignedBigInteger('selected_tariff_price')->default(0);
            $table->unsignedBigInteger('total_payment')->default(0);
            $table->string('extra_image')->nullable();

            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->text('purpose');
            $table->enum('status', ['pending', 'verified', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('final_approved_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('final_approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('facility_tariff_id')->references('id')->on('facility_tariffs')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};