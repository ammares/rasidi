@props(['roles' => [] ])
<form method="POST" enctype="multipart/form-data" class="needs-validation">
    <div class="row">
        <div class="col-md-6">
            <div class="col-12">
                <h6 for="name">{{ __('global.name') }}</h6>
                <div class="input-group">
                    <input type="text" name="name" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="ficon" data-feather="user"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-1">
                <h6 for="email">{{__('global.email')}}</h6>
                <div class="input-group">
                    <input type="text" name="email" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="ficon" data-feather="mail"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-1">
                <h6 for="password">{{__('global.password')}}</h6>
                <div class="input-group form-password-toggle">
                    <input type="password" class="form-control" name="password" required />
                    <div class="input-group-append">
                        <div class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-1">
                <h6 for="mobile">{{__('global.phone')}}</h6>
                <div class="input-group">
                    <input type="text" name="mobile" class="form-control" />
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="ficon" data-feather="phone"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-1">
                <h6 for="role">{{__('global.role')}}</h6>
                <div class="input-group">
                <select class="form-control" name="role">
                <option class="role" value="">{{__('global.select_role')}}</option>
                @foreach($roles as $role)
                        <option class="{{$role['name']}}" value="{{$role['name']}}">
                            {{ucfirst($role['name'])}}
                        </option>
                        @endforeach
                </select>
                </div>
            </div>
        </div>

        <div class="col-md-6 icon-container">
            <h6 for="avatar">
                {{__('global.avatar')}}
            </h6>
            <div data-class="input-group image-inline-preview" data-placement="bottom">
                <input type="text"  data-class="form-control image-preview-filename"
                    disabled="disabled">
                <span class="input-group-btn">
                    <button type="button" data-class="btn btn-outline-gray image-preview-clear" style="display:none;">
                        <span data-class="fas fa-times text-danger"></span> {{__('global.clear')}}
                    </button>
                    <div class="btn btn-outline-gray image-preview-input">
                        <span class="fa fa-folder-open text-default"></span>
                        <span class="image-preview-input-title">{{__('global.browse')}}</span>
                        <input class="image-upload" name="avatar" type="file" accept=".png,.jpeg,.jpg">
                    </div>
                </span>
            </div>
        </div> 
    </div>
</form>