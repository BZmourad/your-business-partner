<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Document\Document;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\User;

class DocumentPermission extends Model
{
    use Loggable;
    
    protected $table = 'document_permissions';

    protected $fillable = [
        'document_id',
        'user_id',
        'has_view',
        'has_delete',
        'has_download',
        'has_upload_files',
        'has_send_by_email',
        'has_comment'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'has_view' => 'boolean',
        'has_delete' => 'boolean',
        'has_download' => 'boolean',
        'has_upload_files' => 'boolean',
        'has_send_by_email' => 'boolean',
        'has_comment' => 'boolean',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function document(): BelongsTo{
        return $this->belongsTo(Document::class, 'document_id', 'id')->orderBy('id', 'desc');
    }

}