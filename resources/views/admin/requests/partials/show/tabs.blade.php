<section>
    <div class="row">
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 bg-white shadow-lg">
                <li class="nav-item">
                    <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                        <i class="fas fa-info-circle mr-50"></i> {{ __('Informations de la Demande')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" id="account-pill-docs" data-toggle="pill" href="#account-vertical-docs" aria-expanded="false">
                        <i class="la la-folder-open mr-50"></i> {{ __('Documents') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" id="account-pill-customer" data-toggle="pill" href="#account-vertical-customer" aria-expanded="false">
                        <i class="fas fa-user mr-50"></i> {{ __('Customer') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" id="account-pill-histo" data-toggle="pill" href="#account-vertical-histo" aria-expanded="false">
                        <i class="fas fa-history mr-50"></i> {{ __('Historique de la Demande') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                    @include('admin.requests.partials.show.general')
                </div>
                <div class="tab-pane fade" id="account-vertical-docs" role="tabpanel" aria-labelledby="account-pill-docs" aria-expanded="false">
                    @include('admin.requests.partials.show.docs')
                </div>
                <div class="tab-pane fade" id="account-vertical-customer" role="tabpanel" aria-labelledby="account-pill-customer" aria-expanded="false">
                    @include('admin.customers.fiche',['customer' => $request->customer])
                </div>
                <div class="tab-pane fade" id="account-vertical-histo" role="tabpanel" aria-labelledby="account-pill-histo" aria-expanded="false">
                    @include('admin.requests.partials.show.histo')
                </div>
            </div>
        </div>
    </div>
</section>