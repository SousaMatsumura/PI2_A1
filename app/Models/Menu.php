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

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    
}
