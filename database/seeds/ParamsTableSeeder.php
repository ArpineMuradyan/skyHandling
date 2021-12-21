<?php

use Illuminate\Database\Seeder;

class ParamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		DB::table('params')
			->insert([
				'currency_usd' => 24,
				'currency_euro' => 26.50,

				'lifetime' => 6,
				'depreciation_percentage' => 50,
				'depreciation_period' => 4,

				'salary_leader1' => 3000,
				'salary_leader2' => 3000,
				'salary_pilot2' => 2000,
				'salary_conductor' => 0,
				'salary_engineer' => 3000,

				'insurance_responsibility' => 10000,
				'insurance_crew' => 5000,
				'insurance_kasko' => 8000,
				'insurance_franchise' => 0,
				'insurance_aircraft_service' => 7000,

				'nav_aeronautical_charts' => 450,
				'nav_airworthiness' => 1600,
				'nav_planning_program' => 800,
				'nav_communication' => 300,
				'nav_management' => 0,
				'nav_daily_travel_accommodation' => 1000,
				'nav_crue_training' => 1500,
				'nav_crue_training2' => 0,

				'route_distance' => 600,
				'airport_services_cost' => 480,
				'fuel_cost' => 0.70 ,
				'duration_warm_up' => 10,
				'duration_take_off' => 8,

				'engine_hour_price' => 10,
				'avionics_hour_price' => 10,
				'glider_hour_price' => 10,

				'flying_hours' => 60,
				'flying_hour_profitability' => 50,
			]);
	}
}
