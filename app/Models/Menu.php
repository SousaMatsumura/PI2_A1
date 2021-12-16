<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'mealtime',
        'amount',
        'repeat',
        'description',
        'institution_id',
        'created_at'
    ];

    public function getAmountAttribute()
    {
        $amount = $this->attributes['amount'];

        return $amount <= 9 ? '0'.$amount : $amount;
    }

    public function getRepeatAttribute()
    {
        $repeat = $this->attributes['repeat'];

        return $repeat <= 9 ? '0'.$repeat : $repeat;
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    
}
