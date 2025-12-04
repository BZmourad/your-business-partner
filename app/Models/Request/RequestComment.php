<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Request\Request;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\User;

class RequestComment extends Model
{
    use Loggable;
    
    protected $table = 'request_comments';

    protected $fillable = [
        'request_id',
        'user_id',
        'is_visible',
        'comment',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function request(): BelongsTo{
        return $this->belongsTo(Request::class, 'request_id', 'id')->orderBy('id', 'desc');
    }

}