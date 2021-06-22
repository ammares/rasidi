@props(['label', 'column', 'options' => []])

<div class="form-group">
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
            <select name="filter.value" class="form-control operator">
                <option value="">{{__('global.choose_one')}}</option>
                @foreach($options as $key => $option)
                <option value="{{$key}}"> {{ Str::of($option)->replace('_', ' ') }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>