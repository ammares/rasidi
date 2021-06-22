@props(['label', 'column', 'placeholder' => ''])

<div class="form-group">
    <div class="row d-flex align-items-center">
        <h6 class="col-sm-3 control-label text-right">{{ $label }}</h6>
        <div class="col-sm-3">
            <input type="hidden" name="filter.column" value="{{ $column }}">
            <select name="filter.operator" class="filter-text-operator form-control operator {{ $column.'.operator'}}">
                <option value="eq"> &#61;</option>
                <option value="neq"> &#33;&#61;</option>
                <option value="contains">@lang('global.table_grid.contains')</option>
                <option value="startswith">@lang('global.table_grid.starts_with')</option>
                <option value="endswith">@lang('global.table_grid.ends_with')</option>
                <option value="empty">@lang('global.table_grid.is_empty')</option>
                <option value="not_empty">@lang('global.table_grid.not_empty')</option>
            </select>
        </div>
        <div class="col-sm-6">
            <input type="text" name="filter.value" value="" class="form-control" placeholder="{{ $placeholder }}"
                id="{{ $column }}" autocomplete="off">
        </div>
    </div>
</div>