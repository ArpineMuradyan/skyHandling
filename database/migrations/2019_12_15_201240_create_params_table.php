<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('params', function (Blueprint $table) {
			
			$total = 14;
			$precision = 2;

			$table->unsignedDecimal('currency_usd', $total, $precision)->default(0);
			$table->unsignedDecimal('currency_euro', $total, $precision)->default(0);

			$table->smallInteger('lifetime')->default(0);
			$table->unsignedDecimal('depreciation_percentage', $total, $precision)->default(0);
			$table->unsignedDecimal('depreciation_period', $total, $precision)->default(0);

			$table->unsignedDecimal('salary_leader1', $total, $precision)->default(0);
			$table->unsignedDecimal('salary_leader2', $total, $precision)->default(0);
			$table->unsignedDecimal('salary_pilot2', $total, $precision)->default(0);
			$table->unsignedDecimal('salary_conductor', $total, $precision)->default(0);
			$table->unsignedDecimal('salary_engineer', $total, $precision)->default(0);

			$table->unsignedDecimal('insurance_responsibility', $total, $precision)->default(0);
			$table->unsignedDecimal('insurance_crew', $total, $precision)->default(0);
			$table->unsignedDecimal('insurance_kasko', $total, $precision)->default(0);
			$table->unsignedDecimal('insurance_franchise', $total, $precision)->default(0);
			$table->unsignedDecimal('insurance_aircraft_service', $total, $precision)->default(0);

			$table->unsignedDecimal('nav_aeronautical_charts', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_airworthiness', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_planning_program', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_communication', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_management', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_daily_travel_accommodation', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_crue_training', $total, $precision)->default(0);
			$table->unsignedDecimal('nav_crue_training2', $total, $precision)->default(0);

			$table->unsignedDecimal('route_distance', $total, $precision)->default(0);
			$table->unsignedDecimal('airport_services_cost', $total, $precision)->default(0);
			$table->unsignedDecimal('fuel_cost', $total, $precision)->default(0);
			$table->unsignedDecimal('duration_warm_up', $total, $precision)->default(0);
			$table->unsignedDecimal('duration_take_off', $total, $precision)->default(0);

			$table->unsignedDecimal('engine_hour_price', $total, $precision)->default(0);
			$table->unsignedDecimal('avionics_hour_price', $total, $precision)->default(0);
			$table->unsignedDecimal('glider_hour_price', $total, $precision)->default(0);

			$table->unsignedDecimal('flying_hours', $total, $precision)->default(0);
			$table->unsignedDecimal('flying_hour_profitability', $total, $precision)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('params');
    }
}
