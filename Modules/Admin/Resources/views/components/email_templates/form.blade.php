@props(['emailTemplate' => []])

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <h5>{{__('global.category')}}: </h5>
                    <select class="form-control" name="category" required>
                        {{!! $emailTemplate->category ?? '<option value="" selected>'.__('global.select_category').'</option>' !!}}
                        <option value="client"
                            {{ $emailTemplate->category ?? null ? ($emailTemplate->category=='client' ? 'selected' : '' ) :'' }}>
                            {{__('global.client')}}
                        </option>
                        <option value="staff"
                            {{ $emailTemplate->category ?? null ? ($emailTemplate->category=='staff' ? 'selected' : '' ) :'' }}>
                            {{__('global.staff')}}
                        </option>
                    </select>

                    <h5 class="mt-3">{{__('global.template_name')}}:</h5>
                    <input type="text" name="name" class="form-control"
                        value="{{ $emailTemplate->name ?? null ? Str::of($emailTemplate->name)->replace('_', ' ') :''  }}"
                        required>

                    <h5 class="mt-3">{{__('global.sent_rule')}}:</h5>
                    <textarea name="rule" rows="3" class="form-control" required>{{$emailTemplate->rule ?? ''}}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
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
                                    <h6 for="emailTemaplate-subject">{{ __('global.subject') }}:</h6>
                                    <input type="text" class="form-control" placeholder="subject"
                                        name="{{ $locale }}[subject]"
                                        value="{{ $emailTemplate->{'subject:'.$locale} ?? null}}" required>
                                </div>
                                <div class="form-group mt-2">
                                    <h6 for="emailTemaplate-message">{{ __('global.message') }}:</h6>
                                    <div class="quill-editor" data-field="message-{{$locale}}">
                                        {!! $emailTemplate->{'message:'.$locale} ?? null !!}
                                    </div>
                                    <textarea class="message-{{$locale}} hide" name="{{ $locale }}[message]" required>
                                    </textarea>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <div class="alert-body">
                                        {{$emailTemplate ? __('global.alert_when_edit_email_template') : __('global.alert_when_create_email_template') }}
                                    </div>
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