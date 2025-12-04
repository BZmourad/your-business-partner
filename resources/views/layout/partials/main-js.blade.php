<script src="{{ asset('modern-admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/vendors/js/ui/prism.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/js/core/app.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/js/scripts/customizer.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/js/scripts/footer.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('libs/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('modern-admin/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@include('layout.partials.loader.script')
@include('layout.partials.scroll-top.script')
@include('layout.partials.ajaxForm')
@include('layout.partials.uploadFiles.script')
@if(session('success'))
    <script>$(document).ready((function() {toastr.success("{{ session('success') }}")}));</script>
@endif
@if(session('errors'))
    <script>$(document).ready((function() {toastr.error("{{ session('errors') }}")}));</script>
@endif
{{--<script>
    function fetchUnreadMessages() {
        $.ajax({
            url: "/getunreadmessages",
            method: "GET",
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function(response) {
                $(".notification-tag-2").text(response.count);
                $(".notification-tag-1").text(response.count + " {{ __('New')}}");

                let messagesHtml = "";
                response.messages.forEach(function (message) {
                    messagesHtml += `
                        <div class="media">
                            <div class="media-left">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img src="{{ asset('storage/users/${message.sender.avatar}') }}" alt="avatar">
                                </span>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">${message.sender.name}</h6>
                                <p class="notification-text font-small-3 text-muted">${message.message}</p>
                                <small>
                                    <time class="media-meta text-muted">${new Date(message.created_at).toLocaleString()}</time>
                                </small>
                            </div>
                        </div>`;
                });

                $("#media-list-chat").html(messagesHtml);
            }
        });
    }

    $(document).ready(function() {
        fetchUnreadMessages();
        setInterval(fetchUnreadMessages, 10000); // Rafraîchir toutes les 30 secondes
    });
</script>--}}
<script>
    $(document).ready(function() {
        if ($('.select2').length) {
            $('.select2').select2({
                dropdownAutoWidth: !0,
                width: "100%",
                placeholder: "{{ __('Select')}}",
                allowClear:!0,
            });
        }
    });
</script>
<script>
    function formatCountry(state) {
        if (!state.id) return state.text;
        const flagUrl = $(state.element).data('flag');
        if (!flagUrl) return state.text;
        return $(`
            <span>
                <img src="${flagUrl}" class="img-flag" style="width: 20px; height: 15px; margin-right: 5px;" />
                ${state.text}
            </span>
        `);
    }
    $(document).ready(function() {
        if ($('.select2-country').length) {
            $('.select2-country').select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                dropdownAutoWidth: !0,
                width: "100%",
                placeholder: "{{ __('Select')}}",
                allowClear:!0,
                escapeMarkup: function (m) { return m; }
            });
        }
    });
</script>
<script>
    window.addEventListener('load', function () {
        function checkConnection() {
            if (!navigator.onLine) {
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger text-center';
                alert.innerHTML = '<i class="fas fa-wifi-slash mr-2"></i> {{ __("Vous êtes hors ligne. Vérifiez votre connexion internet.")}}';
                alert.id = 'offline-alert';
                document.body.prepend(alert);
            } else {
                const existingAlert = document.getElementById('offline-alert');
                if (existingAlert) existingAlert.remove();
            }
        }

        window.addEventListener('online', checkConnection);
        window.addEventListener('offline', checkConnection);
        checkConnection();
    });
</script>