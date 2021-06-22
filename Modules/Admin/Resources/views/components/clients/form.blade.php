<form class="form needs-validation was-validated" action="" method="POST">
    <input type="hidden" name="_method" value="PATCH" />
    <div class="row">
        <div class="col-6 mb-2">
            <div class="media">
                <div class="avatar bg-light-primary rounded mr-1">
                    <div class="avatar-content">
                        <i data-feather="map-pin" class="avatar-icon font-medium-3"></i>
                    </div>
                </div>
                <div class="media-body">
                    <h6 class="mb-0 client-location"></h6>
                    <small class="client-lat-long">{{__('global.no_location')}}</small>
                </div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-6 form-group required">
            <h6>{{ __('global.first_name') }}</h6>
            <input type="text" name="first_name" class="form-control" required />
        </div>
        <div class="col-6 form-group required">
            <h6>{{ __('global.last_name') }}</h6>
            <input type="text" name="last_name" class="form-control" required />
        </div>
        <div class="col-6 form-group required">
            <h6>{{ __('global.email') }}</h6>
            <div class="input-group input-group-merge">
                <input type="text" name="email" class="form-control" required />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="ficon" data-feather="mail"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-6 form-group required">
            <h6>{{ __('global.phone') }}</h6>
            <div class="input-group input-group-merge">
                <input type="text" name="mobile" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="ficon" data-feather="phone"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>