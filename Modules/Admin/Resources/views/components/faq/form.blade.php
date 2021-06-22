@props(['faq' => []])
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach (config('translatable.locales') as $key => $locale)
                    <li class="nav-item">
                        <a class="nav-link {{$loop->first ? 'active show':''}}" data-toggle="tab"
                            href="#tabs-{{ $key }}" role="tab">{{ __('global.'.$locale) }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach (config('translatable.locales') as $key => $locale)
                    <div class="tab-pane fade {{$loop->first ? 'show active':''}}" role="tabpanel"
                        data-lang="{{ $locale }}" id="tabs-{{ $key }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            {{ __('global.question') }}
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                placeholder="question" name="{{ $locale }}[question]"
                                                value="{{ old($locale. '.question', $faq->{'question:'.$locale} ?? null) }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            {{ __('global.answer') }}
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="quill-editor" data-field="answer-{{$locale}}">
                                            {!! old($locale. '.answer', $faq->{'answer:'.$locale} ?? null) !!}
                                        </div>
                                        <textarea class="answer-{{$locale}} hide" name="{{ $locale }}[answer]">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>