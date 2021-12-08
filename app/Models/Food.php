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

    public function scopeGetByInstitution($query, $institutionId, $createdAt = null)
    {
        $collection = $query->select(
            'foods.id',
            'foods.name',
            'foods.unit'
        )
        ->withSum(
            ['records AS amount' => function($query) use($institutionId, $createdAt) {
                $query->where('institution_id', $institutionId);

                if($createdAt) $query->whereDate('created_at', $createdAt);
            }],
            'amount',
        )
        ->withSum(
            ['consumptions AS amount_consumed' => fn ($query) => $query->where('institution_id', $institutionId)],
            'amount_consumed'
        )
        ->get();
        
        $collection->map(function($food) {
            $food->amount = $food->amount ?? 0;
            $food->amount_consumed = $food->amount_consumed ?? 0;
            $food->amount_remaining = $food->amount - $food->amount_consumed;
        });

        return $collection;
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
