<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class ServiceFormField extends Model
{
    use Loggable;
    
    protected $table = 'service_form_fields';

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'type',
        'options',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function service(): BelongsTo{
        return $this->belongsTo(Service::class);
    }

    public function isSelectType(): bool{
        return in_array($this->type, ['single_select', 'multiple_select']);
    }

}