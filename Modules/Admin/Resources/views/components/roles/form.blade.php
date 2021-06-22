@props(['role' => [], 'rolePermissions' => [], 'permissions'])

<div class="card-body">
    <div class="row">
        @if($role && $role->id==1)
        <div
            class="form-group required col-md-4 col-sm-6 no-pr mb-25 needs-validation {{$role->id ?? null ? 'was-validated' :null }}">
            <h6 for="title">{{__('global.role_name')}}</h6>
            <input name="title" class="mt-1 form-control" value="{{$role->name ?? null}}" required disabled>
        </div>
        <div
            class="form-group required col-md-8 col-sm-6 no-pr mb-25 needs-validation {{$role->id ?? null ? 'was-validated' :null }}">
            <h6 for="description">{{ucfirst(__('global.description'))}}</h6>
            <textarea name="description" class="mt-1 form-control" rows="4" maxlength="255"
                required>{{$role->description ?? null}}</textarea>
        </div>
        @else
        <div
            class="form-group required col-md-4 col-sm-6 no-pr mb-25 needs-validation {{$role->id ?? null ? 'was-validated' :null }}">
            <h6 for="title">{{__('global.role_name')}}</h6>
            <input name="title" class="mt-1 form-control" value="{{$role ? Str::of($role->name)->replace('_', ' ') : null}}" required>
        </div>
        <div
            class="form-group required col-md-8 col-sm-6 no-pr mb-25 needs-validation {{$role->id ?? null ? 'was-validated' :null }}">
            <h6 for="description">{{ucfirst(__('global.description'))}}</h6>
            <textarea name="description" class="mt-1 form-control" rows="4" maxlength="255"
                required>{{$role->description ?? null}}</textarea>
        </div>
        <div class="clearfix mb-2"></div>
        <div class="col-12 my-3">
            <h4>{{__('global.abilities')}}</h4>
            <div class="custom-control custom-checkbox mt-2">
                <input type="checkbox" class="custom-control-input" id="checkAllAbilities">
                <label class="font-weight-bold custom-control-label"
                    for="checkAllAbilities">{{__('global.check_all')}}</label>
            </div>
        </div>
        @foreach($permissions as $category => $permission)
        <div class="home-widget col-3 col-xs-12">
            <div class="card card-primary">
                <div class="custom-control custom-checkbox ml-2">
                    <input type="checkbox" class="custom-control-input check-all-abilities" id="{{$category}}-abilities"
                        data-target="{{ $category }}" value="">
                    <label class="font-weight-bold custom-control-label"
                        for="{{$category}}-abilities">{{ucwords(str_replace('_',' ',$category))}}</label>
                    <hr />
                </div>
                <div class="card-body pt-0">
                    <ul class="list-unstyled" id="{{ $category }}">
                        @foreach($permission as $value)
                        <li>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="abilities[]" id="{{$value}}-ability"
                                    class="custom-control-input" {{ isset($rolePermissions[$value]) ? 'checked' : '' }}
                                    value="{{ $value }}">
                                <label class="custom-control-label" for="{{$value}}-ability">
                                    {{ __('permissions'.'.'.str_replace('.','_',$value)) }}</label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @if($loop->iteration % 3 == 0)
        <div class="clearfix hidden-xs"></div>
        @endif
        @endforeach
        @endif
    </div>
</div>