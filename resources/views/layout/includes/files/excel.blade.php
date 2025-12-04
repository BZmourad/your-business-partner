@php
    $viewerUrl = 'https://docs.google.com/gview?url=' . urlencode($fileUrl) . '&embedded=true';
@endphp
<iframe src="{{ $viewerUrl }}" style="width:100%; height:600px;" frameborder="0" class="shadow-lg"></iframe>