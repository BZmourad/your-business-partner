@if ($data->user)
    <div class="media">
        <div class="media-left pr-1">
            <a href="{{ $data->user->getAvatar() }}" data-fancybox>
                <span class="avatar avatar-xs @if($data->user && Cache::has('user-is-online-' . $data->user->id)) avatar-online @else avatar-busy @endif rounded-circle">
                    <img src="{{ $data->user->getAvatar() }}" alt="avatar"><i></i>
                </span>
            </a>
        </div>
        <div class="media-body media-middle">
            <a class="media-heading name">{{ $data->last_name .' '.$data->first_name }}</a>
        </div>
    </div>
@else
    {{ $data->last_name .' '.$data->first_name }}
@endif
