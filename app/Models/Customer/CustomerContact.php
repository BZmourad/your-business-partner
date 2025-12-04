<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class CustomerContact extends Model
{
    use Loggable;

    protected $table = 'customer_contacts';

    protected $fillable = [
        'name',
        'email',
        'phone1',
        'phone2',
        'whatsapp',
        'customer_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}