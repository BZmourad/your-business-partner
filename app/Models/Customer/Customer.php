<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Customer extends Model
{
    use Loggable;

    protected $fillable = [
        'country',
        'company_name',
        'id_type_other',
        'reference',
        'customer_type',
        'last_name',
        'first_name',
        'email',
        'gender',
        'birth_date',
        'birth_place',
        'nationality',
        'marital_status',
        'address',
        'phone',
        'fax',
        'id_type',
        'id_number',
        'id_issue_date',
        'id_issue_place',
        'id_expiry_date',
        'profession',
        'job_title',
        'employer',
        'work_address',
        'work_phone',
        'activity',
        'tax_id',
        'tax_regime',
        'commerce_register_number',
        'business_sector',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function user(){
        return $this->hasOne(\App\Models\User::class, 'customer_id', 'id');
    }

    public function demandes(){
        return $this->hasMany(\App\Models\Request\Request::class, 'customer_id', 'id');
    }

    public function contacts(){
        return $this->hasMany(CustomerContact::class, 'customer_id', 'id');
    }

    public function activation($b){
        if ($this->user) {
            $this->user->update(["is_active" => $b]);
        }
    }
}