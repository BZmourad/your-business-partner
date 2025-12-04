<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Contact extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'reference',
        'name',
        'service',
        'email',
        'phone',
        'address',
        'subject',
        'message'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];
}
