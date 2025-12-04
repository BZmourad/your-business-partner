<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Notification extends Model
{
    use HasFactory;
    use Loggable;
    
    protected $fillable = [
        'title',
        'url',
        'icon',
        'color',
        'is_read',
        'user_id',
        'by_user_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime:Y-m-d H:i',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function by(){
        return $this->belongsTo(User::class, 'by_user_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function setIsReadAttribute($value){
        $this->attributes['is_read'] = $value;
        if ($value) {
            $this->attributes['read_at'] = now();
        }
    }

}
