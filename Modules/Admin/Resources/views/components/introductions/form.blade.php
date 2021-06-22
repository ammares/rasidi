@props(['introduction' => []])

<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{  __('global.image') }}
                </h4>
            </div>
            <div class="card-body">
                <a href="javascript:void(0);">
                    <img src="{{$introduction->image ?? null ? asset('storage/introductions/' . $introduction->image) : asset('images/custom/no_image.png')}}"
                        id="introduction-upload-img" class="img-thumbnail mr-50" alt="Introduction image" height="208"
                        width="208" />
                </a>
                <div class="media-body mt-2">
                    <label for="introduction-upload" class="btn btn-sm btn-primary mb-75 mr-75">
                        {{ __('global.upload') }}
                    </label>
                    <input type="file" id="introduction-upload" hidden accept="image/png, image/jpeg , image/gif"
                        name="image" />
                    <p>{{ __('global.allowed_extensin_and_size_pic') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <ul class="nav nav-tabs" role="tablist">
            @foreach (config('translatable.locales') as $key => $locale)
            <li class="nav-item">
                <a class="nav-link {{$loop->first ? 'active show':''}}" data-toggle="tab" href="#tabs-{{ $key }}"
                    role="tab">{{ __('global.'.$locale) }}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach (config('translatable.locales') as $key => $locale)
            <div class="tab-pane fade {{$loop->first ? 'show active':''}}" role="tabpanel" data-lang="{{ $locale }}"
                id="tabs-{{ $key }}">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-0">
                                <div class="form-group">
                                    <h6>{{ __('global.title') }}</h6>
                                    <input type="text" class="form-control" placeholder="title"
                                        name="{{ $locale }}[title]"
                                        value="{{ old($locale. '.title', $introduction->{'title:'.$locale} ?? null) }}"
                                        required>
                                </div>
                                <div class="form-group mt-2">
                                    <h6 for="introduction-summary">{{ __('global.summary') }}</h6>
                                    <div class="quill-editor" data-field="summary-{{$locale}}">
                                        {!! old($locale. '.summary', $introduction->{'summary:'.$locale} ?? null) !!}
                                    </div>
                                    <textarea class="summary-{{$locale}} hide" name="{{ $locale }}[summary]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>