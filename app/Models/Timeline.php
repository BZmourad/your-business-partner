<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Timeline extends Model
{
    use Loggable;

    protected $table = 'timelines';

    protected $fillable = [
        'action',
        'data_id',
        'created_by',
        'module',
        'reference'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}