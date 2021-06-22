<table class="table table-striped">
    <thead>
        <tr>
            @forelse($columns as $column)
            <th style="text-align: left;">{!! $column['name'] !!}</th>
            @empty
            <th style="text-align: left;">{{__('global.gateway_sn')}}</th>
            <th style="text-align: left;">{{ __('global.active') }}</th>
            <th style="text-align: left;">{{__('global.connected')}}</th>
            <th style="text-align: left;">{{__('global.power_modules')}}</th>
            <th style="text-align: left;">{{__('global.registered_at')}}</th>
            @endforelse
        </tr>
    </thead>
    <tbody>
        @foreach($data['aaData'] as $gateway)
        <tr>
            @forelse($columns as $column)
            @component('admin::export.current_fields_data', ['column' => $column, 'row' => $gateway]) @endcomponent
            @empty
                <td style="text-align: left;">{{ $gateway->serial_number }}</td>
                <td style="text-align: left;">{{( $gateway->active == 0 )? __('global.not_active') : __('global.active')}}</td>
                <td style="text-align: left;">{{ ($gateway->connected > 0) ? __('global.yes') : __('global.no') }}</td>
                <td style="text-align: left;">{{ ($gateway->power_modules_num> 0) ? $gateway->power_modules_num : '-'  }}</td>
                <td style="text-align: left;">{{ empty($gateway->created_at) ? 0 : \Carbon\Carbon::parse($gateway->created_at)->format('Y-m-d, g:i A') }}</td>
            @endforelse
        </tr>
        @endforeach
    </tbody>
</table>