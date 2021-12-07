<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'foods';

    protected $fillable = [
        'name', 
        'unit'
    ];

    public function scopeGetByInstitution($query, $institutionId)
    {
        return $query->select(
            'foods.id',
            'foods.name',
            'foods.unit',
            DB::raw('(SELECT SUM(food_records.amount) FROM food_records WHERE food_records.food_id = foods.id AND food_records.institution_id = '.$institutionId.' ) AS amount'),
            DB::raw('(SELECT SUM(consumptions.amount_consumed) FROM consumptions WHERE consumptions.food_id = foods.id AND consumptions.institution_id = '.$institutionId.' ) AS amount_consumed'),
            DB::raw('(SELECT amount - COALESCE(amount_consumed, 0)) AS amount_remaining')
        )
        ->groupBy('foods.id');
    }

    public function hasRecords()
    {
        return $this->records()->exists();
    }

    public function getRecordsInstitutionNames()
    {
        return $this->records()->groupBy('institution_id')->get()->load('institution')->pluck('institution.name');
    }

    public function records()
    {
        return $this->hasMany(FoodRecord::class);
    }

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }

}
