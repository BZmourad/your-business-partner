<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Service\ServiceDocument;
use App\Models\Request\Request;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\User;
use App\Models\Document\DocumentComment;
use App\Models\Document\DocumentPermission;

class Document extends Model implements HasMedia
{
    use Loggable, InteractsWithMedia;
    
    protected $table = 'documents';

    protected $fillable = [
        'reference',
        'request_id',
        'name',
        'description',
        'is_required',
        'type',
        'is_visible',
        'is_answered',
        'is_locked',
        'objet',
        'prix',
        'tva',
        'date_emission',
        'date_validite',
        'delai',
        'conditions_paiement',
        'month',
        'year',
        'created_by'
    ];

    protected $casts = [
        'is_locked' => 'boolean',
        'is_answered' => 'boolean',
        'is_visible' => 'boolean',
        'is_required' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
        'date_emission' => 'date',
        'date_validite' => 'date',
    ];

    public function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
    public function hasPermission($rule): bool{
        return $this->permissions()->where('user_id', auth()->id())->where($rule, true)->exists() ? true : false;
    }

    public function comments(): HasMany{
        return $this->hasMany(DocumentComment::class, 'document_id', 'id')->orderBy('id', 'desc');
    }

    public function permissions(): HasMany{
        return $this->hasMany(DocumentPermission::class, 'document_id', 'id');
    }

    public function userPermission(User $user){
        return $this->permissions()->where('user_id', $user->id)->first();
    }

    public function registerMediaCollections(): void{
        $this->addMediaCollection('documents')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'image/jpeg',
                'image/jpg',
                'image/png'
            ])
            ->useDisk('public_documents')
            ->singleFile(); // Pour les documents uniques
    }

    public function registerMediaConversions(Media $media = null): void{
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->nonQueued();
    }

    public function request(): BelongsTo{
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

    public function getFilePathAttribute(): string{
        return $this->getFirstMediaUrl('documents');
    }

    public function getOriginalNameAttribute(): string{
        return $this->getFirstMedia('documents')?->file_name ?? '';
    }

    public function getFileNameAttribute(): string{
        return $this->getFirstMedia('documents')?->name ?? '';
    }

    public function getFileSizeAttribute(): string{
        return $this->getFirstMedia('documents')?->human_readable_size ?? '0 KB';
    }

    public function getFileTypeAttribute(): string{
        return $this->getFirstMedia('documents')?->extension ?? '';
    }

    public function getMimeTypeAttribute(): string{
        return $this->getFirstMedia('documents')?->mime_type ?? '';
    }

    public function getFormattedSizeAttribute(): string{
        return $this->file_size; 
    }

    public function isImage(): bool{
        return strpos($this->mime_type, 'image/') === 0;
    }

    public function isPdf(): bool{
        return $this->mime_type === 'application/pdf';
    }

    public function addDocument($file, $collectionName = 'documents'){
        $media = $this->addMedia($file)->toMediaCollection($collectionName, 'public_documents');
        $media->update(['created_by' => auth()->check() ? auth()->id() : null]);
        return $media;
    }

    public function maxCollectionName(): int{
        if ($this->getMedia("*")) {
            $max = 0;
            foreach ($this->getMedia("*") as $item) {
                $v = (int)$item->collection_name ??0;
                if ($v > $max) {
                    $max = $v;
                }
            }
            return $max;
        } else {
            return 0;
        }
    }
}