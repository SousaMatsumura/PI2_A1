<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    public $table = 'foods';

    protected $fillable = ['name', 'unit'];

    public function records()
    {
        return $this->hasMany(FoodRecord::class);
    }

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }

}
