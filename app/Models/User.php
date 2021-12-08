<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

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

    public function setPasswordAttribute($password)
    {
        if($password) $this->attributes['password'] = bcrypt($password);
    }

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
