<div class="floating-comments-btn" data-toggle="modal" data-target="#commentsModal">
    <i class="fas fa-comments"></i>
</div>
<div class="modal fade right" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-dark text-white">
                <h5 class="modal-title text-white" id="commentsModalLabel">
                    <i class="fas fa-comments mr-2"></i>Commentaires
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white p-0">
                <div id="commentsContainer">
                    <div id="commentsList" class="@if($request->comments()->count() == 0) d-none @endif">
                        @foreach ($request->comments as $item)
                            <div class="comment-item @if(auth()->id() == $item->user->id) hidden-comment @endif">
                                <div class="d-flex">
                                    <div class="comment-avatar">
                                        <img src="{{ $item->user->getAvatar() }}" alt="{{ $item->user->name }}">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <span class="comment-author">{{ $item->user->name }}</span>
                                                @if ($item->is_visible)
                                                    <span class="badge badge-success visibility-badge"><i class="la la-eye mr-1"></i>{{ __('Public')}}</span>
                                                @else
                                                    <span class="badge badge-danger visibility-badge"><i class="la la-eye-slash mr-1"></i>{{ __('Private')}}</span>
                                                @endif
                                            </div>
                                            <div class="comment-date">{{ $item->created_at }}</div>
                                        </div>
                                        <div class="comment-text">
                                            {!! $item->comment !!}
                                        </div>
                                        <div class="comment-actions">
                                            @if ($item->is_visible)
                                                <a class="btn btn-outline-secondary btn-sm toggle-visibility" href="{{ route('admin.requests.comment.visible', $item->id) }}">
                                                    <i class="fas fa-eye-slash mr-1"></i>{{ __('Masquer')}}
                                                </a>
                                            @else
                                                <a class="btn btn-outline-success btn-sm toggle-visibility" href="{{ route('admin.requests.comment.visible', $item->id) }}">
                                                    <i class="fas fa-eye mr-1"></i>{{ __('Rendre visible')}}
                                                </a>
                                            @endif
                                            <a class="btn btn-outline-danger btn-sm delete-comment" href="{{ route('admin.requests.comment.delete', $item->id) }}">
                                                <i class="fas fa-trash mr-1"></i>{{ __('Supprimer')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>
                    <div id="emptyComments" class="empty-comments @if($request->comments()->count() != 0) d-none @endif">
                        <i class="far fa-comments"></i>
                        <h5>{{ __('Aucun commentaire')}}</h5>
                        <p>{{ __('Soyez le premier à partager votre avis !')}}</p>
                    </div>
                </div>
            </div>
            <div id="commentForm">
                <form id="newCommentForm" method="POST" action="{{ route('admin.requests.comment.add') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <input type="hidden" name="request_id" value="{{$request->id}}">
                    <div class="form-group">
                        <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                    </div>
                    <div class="form-footer">
                        <div class="visibility-options">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_visible" id="publicVisibility" value="1" checked>
                                <label class="form-check-label" for="publicVisibility">
                                    <i class="la la-eye mr-1"></i>{{ __('Public')}}
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_visible" id="privateVisibility" value="0">
                                <label class="form-check-label" for="privateVisibility">
                                    <i class="la la-eye-slash mr-1"></i>{{ __('Private')}}
                                </label>
                            </div>
                        </div>
                        <button type="submit" form="newCommentForm" class="btn btn-primary">
                            <i class="fas fa-paper-plane mr-1"></i>{{ __("Publier")}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .floating-comments-btn {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #002960;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .floating-comments-btn:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
        .floating-comments-btn .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            font-size: 0.7rem;
        }
        @media (max-width: 767.98px) {
            .floating-comments-btn {
                width: 45px;
                height: 45px;
                bottom: 60px;
                right: 15px;
            }
            
            .floating-comments-btn i {
                font-size: 1.2rem;
            }
        }
        @media (max-width: 400px) {
            .floating-comments-btn {
                width: 40px;
                height: 40px;
            }
        }
        @media (min-width: 992px) {
            #commentsModal.modal.right .modal-dialog {
                position: fixed;
                margin: auto;
                width: 100%;
                max-width: 600px;
                height: 100%;
                transform: translate3d(0%, 0, 0);
            }
            
            #commentsModal.modal.right .modal-content {
                height: 100%;
                overflow-y: auto;
                border-radius: 0;
                border: none;
            }
            
            #commentsModal.modal.right.fade .modal-dialog {
                right: -600px;
                transition: opacity 0.3s linear, right 0.3s ease-out;
            }
            
            #commentsModal.modal.right.fade.show .modal-dialog {
                right: 0;
            }
        }
        @media (max-width: 991.98px) {
            #commentsModal.modal.right .modal-dialog {
                margin: 0;
                max-width: 100%;
                height: 100%;
            }
            #commentsModal.modal.right .modal-content {
                height: 100%;
                border-radius: 0;
                border: none;
            }
            #commentsModal.modal.right.fade .modal-dialog {
                transform: translateY(100%);
                transition: transform 0.3s ease-out;
            }
            #commentsModal.modal.right.fade.show .modal-dialog {
                transform: translateY(0);
            }
        }
        #commentsModal .modal-header {
            border-radius: 0 !important;
            border-bottom: none;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        #commentsModal .modal-header .close {
            color: white;
            opacity: 0.8;
            font-size: 1.5rem;
        }
        #commentsModal .modal-header .close:hover {
            opacity: 1;
        }
        #commentsModal .comment-item {
            border-bottom: 1px solid #e9ecef;
            padding: 15px 10px;
            transition: all 0.3s ease;
        }
        #commentsModal .comment-item:last-child {
            border-bottom: none;
        }
        #commentsModal .comment-item.hidden-comment {
            background-color: #f8f9fa;
            opacity: 0.7;
        }
        #commentsModal .comment-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }
        @media (max-width: 575.98px) {
            #commentsModal .comment-avatar {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }
        }
        #commentsModal .comment-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #commentsModal .comment-author {
            font-weight: bold;
            margin-bottom: 3px;
            font-size: 0.95rem;
        }
        #commentsModal .comment-date {
            font-size: 0.75rem;
            color: #6c757d;
        }
        #commentsModal .comment-text {
            margin-top: 8px;
            line-height: 1.5;
            font-size: 0.9rem;
        }
        #commentsModal .comment-actions {
            margin-top: 10px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        #commentsModal .comment-actions button {
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        @media (max-width: 400px) {
            #commentsModal .comment-actions {
                flex-direction: column;
                gap: 5px;
            }
            #commentsModal .comment-actions button {
                width: 100%;
            }
        }
        #commentsModal .visibility-badge {
            font-size: 0.65rem;
            padding: 2px 6px;
            margin-left: 8px;
        }
        #commentsModal .empty-comments {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
            position: sticky;
            top: 60px; /* Hauteur approximative de l'en-tête */
            z-index: 5;
            background-color: white;
            min-height: calc(100vh - 200px); /* Ajuster selon la hauteur de l'en-tête et du formulaire */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #commentsModal .empty-comments i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }
        @media (max-width: 767.98px) {
            #commentsModal .modal-title {
                font-size: 1.1rem;
            }
            #commentsModal .comment-item {
                padding: 12px 8px;
            }
        }
        @media (max-width: 400px) {
            #commentsModal .comment-item {
                padding: 10px 5px;
            }
            #commentsModal .comment-text {
                font-size: 0.85rem;
            }
        }
        #commentsModal .comment-item {
            transition: all 0.3s ease;
        }
        #commentsModal .comment-item.deleting {
            transform: translateX(100%);
            opacity: 0;
        }
        #commentsModal .modal-content::-webkit-scrollbar {
            width: 6px;
        }
        #commentsModal .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        #commentsModal .modal-content::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        #commentsModal .modal-content::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Styles pour le formulaire de commentaire */
        #commentsModal #commentForm {
            padding: 15px;
            border-top: 1px solid #e9ecef;
            background-color: #f8f9fa;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }
        #commentsModal #commentForm .form-group {
            margin-bottom: 10px;
        }
        #commentsModal #commentForm textarea {
            resize: vertical;
            min-height: 100px;
        }
        #commentsModal #commentForm .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        @media (max-width: 400px) {
            #commentsModal #commentForm .form-footer {
                flex-direction: column;
                align-items: stretch;
            }
            #commentsModal #commentForm .form-footer .btn {
                width: 100%;
            }
        }
        #commentsModal #commentForm .visibility-options {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        #commentsModal #commentForm .visibility-options label {
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        #commentsModal #commentForm .char-count {
            font-size: 0.8rem;
            color: #6c757d;
        }
        #commentsModal #commentForm .char-count.warning {
            color: #ffc107;
        }
        #commentsModal #commentForm .char-count.danger {
            color: #dc3545;
        }
        
        /* Styles pour la gestion de l'affichage des commentaires */
        #commentsModal #commentsContainer {
            position: relative;
            min-height: 200px;
        }
    </style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        ajaxForm('#newCommentForm');
        $('#comment').summernote();
        $('.delete-comment, .toggle-visibility').click(function(e) {
            if(!confirm("{{ __('Êtes-vous sûr de vouloir continuer ?')}}")) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush