<script>
    $(document).ready((function(){
        var columns = [
            {
                targets: 0,
                orderable: false,
                searchable: true,
                responsivePriority: 1,
                data: 'name',
                name: 'name'
            },
            {
                targets: -1,
                orderable: false,
                searchable: false,
                responsivePriority: 2,
                data: 'action'
            }
        ];
        var table = $(".dataex-res-constructor").DataTable({
            fixedHeader:{
                header:!0,
                headerOffset:$(".header-navbar").outerHeight()
            },
            language: {
                url: "/dataTable/i18n/{{auth()->user()->lang}}.json"
            },
            dom:"Bfrtip",
            serverSide: true,
            processing: true,
            ajax: {
                url: "/admin/configuration/docs",
            },
            columns: columns,
            autoWidth: false,
            pagingType: "full_numbers",
            lengthMenu:[
                [10,25,50, 100,-1],
                ["10 {{ __('rows')}}","25 {{ __('rows')}}","50 {{ __('rows')}}", "100 {{ __('rows')}}","{{ __('Show all')}}"]
            ],
            buttons:[
                "pageLength"
            ],
            order: []
        });
        var data_id ;
        $('body').on('click', '.deleteData', function () {
            data_id = $(this).data("id");
            Swal.fire({
                title:"{{ __('Are you sure?')}}",
                type:"warning",
                showCancelButton:!0,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"{{ __('Yes, delete it!')}}",
                confirmButtonClass:"btn btn-success",
                cancelButtonClass:"btn btn-danger ml-1",
                buttonsStyling:!1
            }).then((
                function(t){
                    if (t.value) {
                        $("body").LoadingOverlay("show");
                        $.ajax({
                            type: "GET",
                            url: "/admin/configuration/docs/"+data_id+"/delete",
                            dataType: 'JSON',
                            data:{
                                'id': data_id,
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function (data) {
                                $("body").LoadingOverlay("hide", true);
                                if (data.success) {
                                    table.draw();
                                    Swal.fire({
                                        title:data.success,
                                        type:"success",
                                        confirmButtonClass:"btn btn-success",
                                        buttonsStyling:!1
                                    })
                                }else if (data.error) {
                                    Swal.fire({
                                        title: data.error,
                                        type:"error",
                                        confirmButtonClass:"btn btn-success",
                                        buttonsStyling:!1
                                    })
                                }
                            },
                            error: function (data) {
                                $("body").LoadingOverlay("hide", true);
                                Swal.fire({
                                    title:"{{ __('An error has occurred. Please try again.')}}",
                                    type:"error",
                                    confirmButtonClass:"btn btn-success",
                                    buttonsStyling:!1
                                })
                            }
                        });
                    } else if (t.dismiss) {
                        t.dismiss===Swal.DismissReason.cancel&&Swal.fire({
                            title:"{{ __('Cancelled')}}",
                            type:"error",
                            confirmButtonClass:"btn btn-success"
                        })
                    }
                }
            ))
        });
        $("#editDocsForm").submit(function(e) {
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
                    $("body").LoadingOverlay("hide", true);
                    if (resp.error) {
                        toastr.error(resp.error);
                    } else {
                        $("#editDocsModal").modal('hide');
                        toastr.success(resp.success);
                        table.draw();
                    }
                },
                error: function(xhr) {
                    $("body").LoadingOverlay("hide", true);
                    toastr.error("{{ __('An error has occurred. Please try again.')}}");
                }
            });
        });
        $("#addDocsForm").submit(function(e) {
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
                    $("body").LoadingOverlay("hide", true);
                    if (resp.error) {
                        toastr.error(resp.error);
                    } else {
                        $("#addDocsModal").modal('hide');
                        toastr.success(resp.success);
                        table.draw();
                    }
                },
                error: function(xhr) {
                    $("body").LoadingOverlay("hide", true);
                    toastr.error("{{ __('An error has occurred. Please try again.')}}");
                }
            });
        });
        new $.fn.dataTable.Responsive(table)
    }));
</script>