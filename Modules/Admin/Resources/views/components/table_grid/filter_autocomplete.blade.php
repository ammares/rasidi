@props(['label', 'column', 'url', 'placeholder' => ''])

<div class="form-group grid-filter-autocomplete">
    <div class="row d-flex align-items-center">
        <h6 class="col-sm-3 control-label text-right">{{ $label }}</h6>
        <div class="col-sm-3">
            <input type="hidden" name="filter.column" value="{{ $column }}">
            <select name="filter.operator" class="form-control operator">
                <option value="eq"> &#61;</option>
                <option value="neq"> &#33;&#61;</option>
            </select>
        </div>
        <div class="col-sm-6">
            <select class="form-control select2" name="filter.value" id="{{ $column }}" autocomplete="off"
                style="width: 100%" data-placeholder="{{ $placeholder }}" data-ajax--url="{{ $url }}"
                data-allow-clear="true">
            </select>
        </div>
    </div>
</div>