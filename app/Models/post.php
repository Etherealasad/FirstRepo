<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class post extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'title',
        'post',
    ];
}
