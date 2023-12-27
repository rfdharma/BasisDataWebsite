<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('late_fees', function (Blueprint $table) {
            $table->id();

            // Booking reference
            $table->foreignId('booking_id')->constrained();

            // Late fee amount
            $table->integer('amount')->default(0);

            // Number of days late
            $table->integer('days_late')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('late_fees');
    }
};
