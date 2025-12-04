<section id="timeline" class="timeline-left timeline-wrapper container">
    <ul class="timeline">
        <li class="timeline-line"></li>
        @foreach ($request->histo as $item)
            @php
                $icon = "";
                $text = "";
                switch ($item->status) {
                    case 'pending': $icon = '<i class="la la-pause"></i>'; $text = __("Demande en attente"); $color = "warning"; break;
                    case 'unpaid': $icon = '<i class="la la-times-circle"></i>'; $text = __("Demande impayé"); $color = "secondary"; break;
                    case 'paid': $icon = '<i class="la la-check-square"></i>'; $text = __("Demande payé"); $color = "primary"; break;
                    case 'in_progress': $icon = '<i class="la la-play"></i>'; $text = __("Traitement démarré"); $color = "info"; break;
                    case 'completed': $icon = '<i class="fa fa-check"></i>'; $text = __("Demande terminée"); $color = "success"; break;
                    case 'refused': $icon = '<i class="fa fa-times"></i>'; $text = __("Demande rejetée"); $color = "danger"; break;
                    default: break;
                }
            @endphp
            <li class="timeline-item">
                <div class="timeline-badge">
                    <span class="bg-{{$color}}" data-toggle="tooltip" data-placement="right" title="{!! $text !!}"> {!! $icon !!} </span>
                </div>
                <div class="timeline-card mb-0 card border-grey border-lighten-2">
                    <div class="card-header p-1">
                        <h4 class="card-title">{!! $text !!}</h4>
                        <p class="card-subtitle text-muted pt-1">
                            <span class="font-small-3">{{ $item->created_at }}</span>
                        </p>
                        @if ($item->notes)
                            <small> <i class="la la-quote-right {{$color}}"></i> {{$item->notes}} </small>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</section>