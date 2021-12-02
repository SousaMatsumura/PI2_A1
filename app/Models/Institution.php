<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'meal_morning_demand',
        'meal_afternoon_demand',
        'meal_night_demand',
        'phone',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function foodRecords()
    {
        return $this->hasMany(FoodRecord::class);
    }

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
