<section class="mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <div class="btn-group float-md-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addDocumentModal"> <i class="fa fa-plus"></i> {{ __('Add')}} </button>
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#filterModal"> <i class="la la-filter"></i>  {{ __('Filter')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-dashboard mt-2">
                        <table class="table table-bordered dataex-res-constructor">
                            <thead class="text-uppercase text-center bg-blue-dark text-white">
                                <tr>
                                    <th>{{ __('ID')}}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Month') }}</th>
                                    <th>{{ __('Crée Le')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>