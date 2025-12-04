<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class PartnerContact extends Model
{
    use Loggable;

    protected $table = 'partner_contacts';

    protected $fillable = [
        'name',
        'email',
        'phone1',
        'phone2',
        'whatsapp',
        'partner_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function partner(){
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

}