<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'phone',
        'institution_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function isSchool()
    {
        return $this->institution->type === 'SCHOOL';
    }

    public function isSecretary()
    {
        return $this->institution->type === 'SECRETARY';
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
