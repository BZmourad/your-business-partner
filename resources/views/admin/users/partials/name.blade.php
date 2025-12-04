<div class="media">
    <div class="media-left pr-1">
        <span class="avatar avatar-xs @if(Cache::has('user-is-online-' . $data->id)) avatar-online @else avatar-busy @endif rounded-circle">
            <img src="{{ $data->getAvatar() }}" alt="avatar"><i></i>
        </span>
    </div>
    <div class="media-body media-middle">
        <a class="media-heading name">{{ $data->name }}</a>
    </div>
</div>