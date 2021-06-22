@props(['label', 'column', 'placeholder' => ''])

<div class="form-group">
    <div class="row d-flex align-items-center">
        <h6 class="col-sm-3 control-label text-right">{{ $label }}</h6>
        <div class="col-lg-9">
            <input type="text" class="form-control dt-date flatpickr-range dt-input" placeholder="{{__('global.from_date_to_date')}}"/>

            <input type="hidden" name="filter.column" value="{{ $column }}">
            <input type="hidden" name="filter.operator" value="d_gte">         
            <input type="text" name="filter.value" class="hide form-control dt-date start-date dt-input" value=""  />

            <input type="hidden" name="filter.column" value="{{ $column }}">
            <input type="hidden" name="filter.operator" value="d_lte">
            <input type="text" name="filter.value" class="hide form-control dt-date end-date dt-input" value=""  />    
        </div>
    </div>
</div>