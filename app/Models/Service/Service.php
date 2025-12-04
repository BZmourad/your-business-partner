<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Service\ServiceFormField;
use App\Models\Service\ServiceDocument;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Service extends Model
{
    use Loggable;

    protected $table = 'services';

    protected $fillable = [
        'reference',
        'name',
        'description',
        'active',
        'slug'
    ];

    protected $casts = [
        'active' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function fields(): HasMany{
        return $this->hasMany(ServiceFormField::class, 'service_id', 'id')->orderBy('id', 'asc');
    }

    public function documents(): HasMany{
        return $this->hasMany(ServiceDocument::class, 'service_id', 'id');
    }

    public function demandes(): HasMany{
        return $this->hasMany(\App\Models\Request\Request::class, 'service_id', 'id');
    }

    public function activation($b){
        $this->update(["active" => $b]);
    }

}