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
        'institution_id',
        'created_at'
    ];

    public function getAmountAttribute()
    {
        $amount = $this->attributes['amount'];

        return $amount <= 9 ? '0'.$amount : $amount;
    }

    public function scopeGroupByFood($query)
    {
        return $query->selectRaw(
            'foods.id, 
            foods.name, 
            foods.unit, 
            SUM(food_records.amount) AS amount,
            (SELECT 
                SUM(consumptions.amount_consumed) FROM consumptions WHERE consumptions.food_id = foods.id
            ) AS amount_consumed,
            (SELECT amount - COALESCE(amount_consumed, 0)) AS amount_remaining
            '
        )
        ->join('foods', 'foods.id', '=', 'food_records.food_id')
        ->groupBy('foods.id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
