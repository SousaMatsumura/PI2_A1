<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'institution_id',
        'amount_consumed',
        'created_at'
    ];

    public function getAmountConsumedAttribute()
    {
        $amount = $this->attributes['amount_consumed'];

        return $amount <= 9 ? '0'.$amount : $amount;
    }

    public function scopeGroupByFood($query)
    {
        $query->selectRaw('consumptions.created_at, foods.id as id, foods.name as food, foods.unit as unit, sum(consumptions.amount_consumed) as amount_consumed')
        ->rightJoin('foods', 'foods.id', '=', 'consumptions.food_id')
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
