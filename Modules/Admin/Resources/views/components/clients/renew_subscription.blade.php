<form class="form needs-validation" action="" method="POST">
    <input type="hidden" name="_method" value="PATCH" />
    <div class="row">
        <div class="col-12 col-md-6 form-group">
            <h6>{{ __('global.new_subscription_date') }}</h6>
            <input type="text" name="subscription_date" class="form-control subscription-date" placeholder=""
                required />
        </div>
    </div>
    <h6>
        {{ __('global.subscription_is_valid_till') }}
        <span class="current-subscription-date"></span>
    </h6>
</form>