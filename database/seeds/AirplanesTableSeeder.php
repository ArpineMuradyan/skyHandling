<?php

use App\Models\Airplane;
use Illuminate\Database\Seeder;


class AirplanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		$airplane = new Airplane;
		$airplane->name = "Eclipce 500";
		$airplane->year = 2016;
		$airplane->price = 10000000;
		$airplane->mtow = 5300;

		$airplane->avr_years_service = 15;
		$airplane->fuel_weight = 765;
		$airplane->normal_cruising_speed = 685;
		$airplane->practical_range = 1019;

		$airplane->warm_up_nav = 15;
		$airplane->take_off = 150;
		$airplane->cruise = 80;
		$airplane->landing = 50;
		$airplane->save();

		//---------------------------------------------
		$airplane = new Airplane;
		$airplane->name = "Grob SPn";
		$airplane->year = 2008;
		$airplane->price = 5800000;
		$airplane->mtow = 6300;

		$airplane->avr_years_service = 15;
		$airplane->fuel_weight = 2000;
		$airplane->normal_cruising_speed = 754;
		$airplane->practical_range = 3334;

		$airplane->warm_up_nav = 10;
		$airplane->take_off = 150;
		$airplane->cruise = 80;
		$airplane->landing = 50;
		$airplane->save();
		//---------------------------------------------
		$airplane = new Airplane;
		$airplane->name = "BAE Jetstream 32EP";
		$airplane->year = 2008;
		$airplane->price = 4900000;
		$airplane->mtow = 3500;

		$airplane->avr_years_service = 10;
		$airplane->fuel_weight = 1489;
		$airplane->normal_cruising_speed = 463;
		$airplane->practical_range = 915;

		$airplane->warm_up_nav = 10;
		$airplane->take_off = 150;
		$airplane->cruise = 80;
		$airplane->landing = 50;
		$airplane->save();
		//---------------------------------------------
		$airplane = new Airplane;
		$airplane->name = "Challenger 850";
		$airplane->year = 2018;
		$airplane->price = 10000000;
		$airplane->mtow = 13740;

		$airplane->avr_years_service = 10;
		$airplane->fuel_weight = 8289;
		$airplane->normal_cruising_speed = 820;
		$airplane->practical_range = 5129;

		$airplane->warm_up_nav = 10;
		$airplane->take_off = 150;
		$airplane->cruise = 80;
		$airplane->landing = 50;
		$airplane->save();
		//---------------------------------------------
		$airplane = new Airplane;
		$airplane->name = "HondaJet";
		$airplane->year = 2019;
		$airplane->price = 5300000;
		$airplane->mtow = 4808;

		$airplane->avr_years_service = 5;
		$airplane->fuel_weight = 1800;
		$airplane->normal_cruising_speed = 800;
		$airplane->practical_range = 2500;

		$airplane->warm_up_nav = 10;
		$airplane->take_off = 150;
		$airplane->cruise = 80;
		$airplane->landing = 50;
		$airplane->save();
		//---------------------------------------------
		$airplane = new Airplane;
		$airplane->name = "Kodiak II";
		$airplane->year = 2019;
		$airplane->price = 2150000;
		$airplane->mtow = 3313;

		$airplane->avr_years_service = 5;
		$airplane->fuel_weight = 1211;
		$airplane->normal_cruising_speed = 340;
		$airplane->practical_range = 1850;

		$airplane->warm_up_nav = 10;
		$airplane->take_off = 80;
		$airplane->cruise = 60;
		$airplane->landing = 15;
		$airplane->save();
    }
}
