<script>
    $(document).ready((function(){
        var customerTypeFilter = '';
        $('#customer_type').change(function() {
            customerTypeFilter = $(this).val();
            $('.dataex-res-constructor').DataTable().ajax.reload();
        });
        var hasAccountFilter = '';
        $('#has_account').change(function() {
            hasAccountFilter = $(this).val();
            $('.dataex-res-constructor').DataTable().ajax.reload();
        });
        
        var idTypeFilter = '';
        $('#id_type').change(function() {
            idTypeFilter = $(this).val();
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
                orderable: true,
                searchable: true,
                data: 'name',
                name: 'last_name'
            },
            {
                targets: 2,
                orderable: false, 
                searchable: true,
                data: 'customer_type',
                name: 'customer_type'
            },
            {
                targets: 3,
                orderable: true,
                searchable: true,
                data: 'email',
                name: 'email'
            },
            {
                targets: 4,
                orderable: true,
                searchable: true,
                data: 'id_number',
                name: 'id_number'
            },
            {
                targets: 5,
                orderable: false,
                searchable: false,
                data: 'has_account',
                name: 'has_account'
            },
            {
                targets: 6,
                orderable: true,
                searchable: true,
                data: 'created_at',
                name: 'created_at'
            },
            {
                targets: 7,
                orderable: true,
                searchable: false,
                data: 'demandes_count',
                name: 'demandes_count'
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
                url: "/admin/customers",
                data: function (d) {
                    d.customer_type = customerTypeFilter;
                    d.has_account = hasAccountFilter;  
                    d.id_type = idTypeFilter;  
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
                            url: "/admin/customers/"+data_id,
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
        $('body').on('click', '.activateData', function () {
            data_id = $(this).data("id");
            Swal.fire({
                title:"{{ __('Are you sure?')}}",
                type:"warning",
                showCancelButton:!0,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"{{ __('Yes, do it!')}}",
                confirmButtonClass:"btn btn-success",
                cancelButtonClass:"btn btn-danger ml-1",
                buttonsStyling:!1
            }).then((
                function(t){
                    if (t.value) {
                        $("body").LoadingOverlay("show");
                        $.ajax({
                            type: "GET",
                            url: "/admin/customers/"+data_id+"/activationAccount",
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
        $('body').on('click', '.deleteAccountData', function () {
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
                            url: "/admin/customers/"+data_id+"/deleteAccount",
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
        $("#addAccountForm").submit(function(e) {
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
                        $("#addAccountModal").modal('hide');
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
        $("#emailForm").submit(function(e) {
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
                        $("#emailModal").modal('hide');
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