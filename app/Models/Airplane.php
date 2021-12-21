<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{

    protected $guarded = [];


    public function getMaxExpluatationYear()
    {
        return $this->year + $this->avr_years_service;
    }

    public function getPosibleExpluatation()
    {
        return $this->getMaxExpluatationYear() - date('Y') + 1;
    }

    public function getFuelConsumHour()
    {
        return round(100 * $this->fuel_weight / $this->practical_range, 2);
    }

    public function getFuelConsumKm()
    {
        return round($this->normal_cruising_speed * $this->fuel_weight / $this->practical_range, 2);
    }
}
