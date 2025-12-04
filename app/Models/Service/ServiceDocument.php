<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class ServiceDocument extends Model
{
    use Loggable;
    
    protected $table = 'service_documents';

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'is_required'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function service(): BelongsTo{
        return $this->belongsTo(Service::class);
    }

}