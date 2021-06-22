@props(['label', 'column', 'placeholder' => ''])

<div class="form-group">
    <div class="row d-flex align-items-center">
        <h6 class="col-sm-3 control-label text-right">{{ $label }}</h6>
        <div class="col-sm-3">
            <input type="hidden" name="filter.column" value="{{ $column }}">
            <select name="filter.operator" class="form-control operator {{ $column.'.operator'}}">
                <option value="eq"> &#61;</option>
                <option value="neq"> &#33;&#61;</option>
                <option value="lt"> &lt;</option>
                <option value="lte"> &lt;&#61;</option>
                <option value="gt"> &gt;</option>
                <option value="gte"> &gt;&#61;</option>
            </select>
        </div>
        <div class="col-sm-6">
            <input type="number" name="filter.value" value="" class="form-control" placeholder="{{ $placeholder }}"
                id="{{ $column }}" autocomplete="off">
        </div>
    </div>
</div>