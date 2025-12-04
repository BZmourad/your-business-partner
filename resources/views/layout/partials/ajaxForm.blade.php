<script>
    $(document).ready((function(){
        window.ajaxForm = function (formId) {
            $(formId).submit(function(e) {
                e.preventDefault(); 
                $("body").LoadingOverlay("show");
                var form = $(this);
                var formData = new FormData(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(resp) {
                        if (resp.error) {
                            $("body").LoadingOverlay("hide", true);
                            toastr.error(resp.error);
                        } else {
                            toastr.success(resp.success);
                            if (resp.goUrl) {
                                setTimeout(function() {
                                    window.location.href = resp.goUrl;
                                }, 1000);
                            } else if (resp.refresh) {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                $(formId).trigger('reset'); 
                                $("body").LoadingOverlay("hide", true);
                            }
                        }
                    },
                    error: function(xhr) {
                        toastr.error("{{ __('An error has occurred. Please try again.')}}");
                        $("body").LoadingOverlay("hide", true);
                    }
                });
            });
        };
    }));
</script>