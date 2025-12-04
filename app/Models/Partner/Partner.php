<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Partner extends Model
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

    public function contacts(){
        return $this->hasMany(PartnerContact::class, 'partner_id', 'id');
    }
}