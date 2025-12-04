<script>
    $(document).ready((function(){
        var columns = [
            {
                targets: 0,
                orderable: true,
                searchable: true,
                responsivePriority: 1,
                data: 'name',
                name: 'name'
            },
            {
                targets: 1,
                orderable: true,
                searchable: true,
                data: 'role',
                name: 'role'
            },
            {
                targets: 2,
                orderable: false, 
                searchable: true,
                data: 'email',
                name: 'email'
            },
            {
                targets: 3,
                orderable: false, 
                searchable: true,
                data: 'status',
                name: 'status'
            },
            {
                targets: 4,
                orderable: false, 
                searchable: true,
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
            dom:"Bfrtip",
            serverSide: true,
            processing: true,
            ajax: {
                url: "/admin/users"
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
                text:"{{ __('You won’t be able to revert this!')}}",
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
                            url: "/admin/users/"+data_id,
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
                confirmButtonClass:"btn btn-success",
                cancelButtonClass:"btn btn-danger ml-1",
                buttonsStyling:!1
            }).then((
                function(t){
                    if (t.value) {
                        $("body").LoadingOverlay("show");
                        $.ajax({
                            type: "GET",
                            url: "/admin/users/"+data_id+"/activation",
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
        new $.fn.dataTable.Responsive(table)
    }));
</script>