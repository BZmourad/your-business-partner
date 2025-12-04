<script>
    $(document).ready((function(){
        var statusTypeFilter = '';
        var paidStatusTypeFilter = '';
        var serviceTypeFilter = '';
        var customerTypeFilter = '';
        $('#status').change(function() {
            statusTypeFilter = $(this).val();
            $('.dataex-res-constructor').DataTable().ajax.reload();
        });
        $('#paid_status').change(function() {
            paidStatusTypeFilter = $(this).val();
            $('.dataex-res-constructor').DataTable().ajax.reload();
        });
        $('#service_id').change(function() {
            serviceTypeFilter = $(this).val();
            $('.dataex-res-constructor').DataTable().ajax.reload();
        });
        $('#customer_id').change(function() {
            customerTypeFilter = $(this).val();
            $('.dataex-res-constructor').DataTable().ajax.reload();
        });
        var columns = [
            {
                targets: 0,
                orderable: true,
                searchable: true,
                responsivePriority: 1,
                data: 'reference',
                name: 'id'
            },
            {
                targets: 1,
                orderable: false,
                searchable: false,
                data: 'service',
                name: 'service.name'
            },
            {
                targets: 2,
                orderable: false, 
                searchable: false,
                data: 'customer',
                name: 'customer.last_name'
            },
            {
                targets: 3,
                orderable: false,
                searchable: false,
                data: 'status',
                name: 'status'
            },
            {
                targets: 4,
                orderable: false,
                searchable: false,
                data: 'paid_status',
                name: 'paid_status'
            },
            {
                targets: 5,
                orderable: true,
                searchable: false,
                data: 'created_at',
                name: 'created_at'
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
            searching: false,
            dom:"Bfrtip",
            serverSide: true,
            processing: true,
            ajax: {
                url: "/admin/requests",
                data: function (d) {
                    d.status = statusTypeFilter; 
                    d.paid_status = paidStatusTypeFilter; 
                    d.service = serviceTypeFilter; 
                    d.customer = customerTypeFilter; 
                }
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
                            type: "DELETE",
                            url: "/admin/requests/"+data_id,
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
        $("#setStatusForm").submit(function(e) {
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
                        $("#setStatusModal").modal('hide');
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
        $("#setPaidStatusForm").submit(function(e) {
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
                        $("#setPaidStatusModal").modal('hide');
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