@props(['introduction' => [], 'type'])

<div class="row">
    @if($type == 'how_it_works')
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 for="icon" class="card-title">
                    {{__('global.icon')}}
                </h4>
            </div>
            <div class="card-body">
                <div class="input-group image-inline-preview" data-placement="bottom">
                    <input type="text" placeholder="upload svg file" class="form-control image-preview-filename"
                        disabled="disabled">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-outline-gray image-preview-clear" style="display:none;">
                            <span class="fas fa-times text-danger"></span> {{__('global.clear')}}
                        </button>
                        <div class="btn btn-outline-gray image-preview-input">
                            <span class="fa fa-folder-open text-default"></span>
                            <span class="image-preview-input-title">{{__('global.browse')}}</span>
                            <input class="image-upload" name="image" type="file" id="image" accept=".svg">
                        </div>
                    </span>
                </div>
                @if($introduction)
                <div class="image-preview-container mt-1">
                    <img class="img-responsive img-rounded"
                        src="{{$introduction->image ? asset('storage/howitworks/' . $introduction->image) : asset('images/custom/no_image.png')}}"
                        alt="howitworks icon" />
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    <div class="col-8">
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
                                @if($type == 'how_it_works')
                                <div class="form-group mt-2">
                                    <h6 for="introduction-summary">{{ __('global.summary') }}</h6>
                                    <div class="quill-editor" data-field="summary-{{$locale}}">
                                        {!! old($locale. '.summary', $introduction->{'summary:'.$locale} ?? null) !!}
                                    </div>
                                    <textarea class="summary-{{$locale}} hide"
                                        name="{{ $locale }}[summary]"></textarea>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>