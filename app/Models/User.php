<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $hidden = ['password'];

    public function products(){
        return $this->belongsToMany(Product::class,'user_products')->withPivot(['quantity','amount','id']);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function userissues()
    {
        return $this->hasMany(UserIssue::class);
    }
}
