<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\User;

class RequestStatus extends Model
{
    use Loggable;
    
    protected $table = 'request_status';

    protected $fillable = [
        'request_id',
        'status',
        'notes',
        'created_by',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function demande(): BelongsTo{
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

    public function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}