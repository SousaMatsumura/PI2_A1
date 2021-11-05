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
        'amount_consumed'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
