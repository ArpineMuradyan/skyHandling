<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirplanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('airplanes', function (Blueprint $table) {
			$total = 14;
			$precision = 2;
			
			$table->bigIncrements('id');

			$table->string('name', 50)->nullable();
			$table->smallInteger('year')->unsigned()->nullable();
			$table->unsignedDecimal('price', $total, $precision)->nullable();
			$table->unsignedDecimal('mtow', $total, $precision)->nullable();

			$table->unsignedDecimal('avr_years_service', $total, $precision)->nullable();
			$table->unsignedDecimal('fuel_weight', $total, $precision)->nullable();
			$table->unsignedDecimal('normal_cruising_speed', $total, $precision)->nullable();
			$table->unsignedDecimal('practical_range', $total, $precision)->nullable();

			$table->unsignedDecimal('warm_up_nav', $total, $precision)->nullable();
			$table->unsignedDecimal('take_off', $total, $precision)->nullable();
			$table->unsignedDecimal('cruise', $total, $precision)->nullable();
			$table->unsignedDecimal('landing', $total, $precision)->nullable();

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
        Schema::dropIfExists('airplanes');
    }
}
