<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Document\Document;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\User;

class DocumentComment extends Model
{
    use Loggable;
    
    protected $table = 'document_comments';

    protected $fillable = [
        'document_id',
        'user_id',
        'is_visible',
        'comment',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function document(): BelongsTo{
        return $this->belongsTo(Document::class, 'document_id', 'id')->orderBy('id', 'desc');
    }

}