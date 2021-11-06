<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'zipcode',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'institution_id'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
