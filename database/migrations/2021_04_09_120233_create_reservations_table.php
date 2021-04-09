<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('arrivalDay');
            $table->string('departureDay');
            $table->string('arrivalTime');
            $table->string('departureTime');
            $table->double('taxes');
            $table->double('subtotal');
            $table->double('total');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('house_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
