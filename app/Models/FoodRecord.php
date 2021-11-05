<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'food_id',
        'institution_id'
    ];

    public function scopeGroupByFood($query)
    {
        return $query->selectRaw('foods.id as id, foods.name as food, foods.unit as unit, sum(food_records.amount) as amount')
        ->join('foods', 'foods.id', '=', 'food_records.food_id')
        ->groupBy('foods.name');
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
