<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\Customer\Customer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Permission\Permission;
use App\Models\Service\Service;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Loggable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'lang',
        'last_seen',
        'is_active',
        'type',
        'customer_id',
        'last_name',
        'first_name',
        'gender',
        'birth_date',
        'birth_place',
        'country',
        'nationality',
        'marital_status',
        'address',
        'phone',
        'fax',
        'id_type', 
        'id_type_other',
        'id_number',
        'id_issue_date',
        'id_issue_place',
        'id_expiry_date',
        'job_title',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function demandes(): HasMany{
        return $this->hasMany(\App\Models\Request\Request::class, 'created_by', 'id');
    }

    public function registerMediaCollections(): void{
        $this->addMediaCollection('avatar')->useDisk('public_users')->singleFile(); 
    }

    public function addDocument($file){
        return $this->addMedia($file)->toMediaCollection('avatar', 'public_users');
    }

    public function getAvatar(){
        $avatar = $this->getFirstMediaUrl('avatar');
        if ($avatar) {
            return $avatar;
        } else{
            return asset('img/users/avatar.png');
        }
    }

    public function hasServices(){
        $s = Service::pluck('slug')->toArray();
        if ($this->hasAnyPermission($s)) {
            return true;
        }
        return false;
    }

}
