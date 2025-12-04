<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Customer\Customer;
use App\Models\User;
use App\Models\Service\Service;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\Document\Document;
use App\Models\Request\RequestComment;

class Request extends Model
{
    use Loggable;
    
    protected $table = 'requests';

    protected $fillable = [
        'reference',
        'customer_id',
        'service_id',
        'status',
        'paid_status',
        'notes',
        'admin_feedback',
        'created_by',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function comments(): HasMany{
        return $this->hasMany(RequestComment::class, 'request_id', 'id')->orderBy('id', 'desc');
    }

    public function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function service(): BelongsTo{
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function fields(): HasMany{
        return $this->hasMany(RequestField::class, 'request_id', 'id');
    }

    public function documents(): HasMany{
        return $this->hasMany(Document::class, 'request_id', 'id')->orderBy('created_at', 'desc');
    }

    public function histo(): HasMany{
        return $this->hasMany(RequestStatus::class, 'request_id', 'id')->orderBy('created_at', 'desc');
    }
}