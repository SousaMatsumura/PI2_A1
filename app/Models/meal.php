<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    public $table = 'meal';

    protected $fillable = ['name', 'mealtime', 'amount', 'repeat', 'createdAt'];    

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
