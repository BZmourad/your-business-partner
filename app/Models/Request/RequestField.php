<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Service\ServiceFormField;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class RequestField extends Model
{
    use Loggable;
    
    protected $table = 'request_fields';

    protected $fillable = [
        'request_id',
        'response',
        'name',
        'description',
        'type',
        'options',
        'is_required',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function demande(): BelongsTo{
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }
    
    public function getParsedResponseValueAttribute(){
        $value = $this->response;
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }
        return $value;
    }

    public function isSelectType(): bool{
        return in_array($this->type, ['single_select', 'multiple_select']);
    }
}