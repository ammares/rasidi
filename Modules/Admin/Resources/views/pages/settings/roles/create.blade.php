@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.create_role'))

@section('content')
    <div class="card">
        <form method="post" action="{{route('settings.roles.store')}}">
            @csrf
            <x-admin::roles.form :permissions="$permissions"/>
            <div class="card card-footer">
                <div class="pull-right">
                    <a type="reset" class="btn btn-outline-secondary float-right"
                       href="{{ route('settings.roles') }}">{{__('global.cancel')}}</a>
                    <button type="submit"
                            class="btn btn-primary mr-1 save-btn float-right">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@section('page-script')
<script type="text/javascript">
    jQuery(document).ready(function () {
            jQuery('#checkAllAbilities').on('click', function () {
                jQuery('[type="checkbox"]', '.home-widget').prop('checked', this.checked);
            });
            jQuery('.check-all-abilities').on('click', function () {
                jQuery('[type="checkbox"]', jQuery('#' + jQuery(this).data('target'))).prop('checked', this.checked);
            });
            jQuery('[data-target="home"],[data-target="user_actions"]').trigger('click');
        });
</script>
@endsection