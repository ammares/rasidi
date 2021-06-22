<table class="table table-striped">
    <thead>
        <tr>
            @forelse($columns as $column)
            <th style="text-align: left;">{!! $column['name'] !!}</th>
            @empty
            <th style="text-align: left;">{{__('global.power_module')}}</th>
            <th style="text-align: left;">{{__('global.comfortable_temperature')}}</th>
            <th style="text-align: left;">{{__('global.power_avg_value')}}</th>
            <th style="text-align: left;">{{ __('global.enabled?') }}</th>
            <th style="text-align: left;">{{ __('global.common?') }}</th>
            @endforelse
        </tr>
    </thead>
    <tbody>
        @foreach($data['aaData'] as $device)
        <tr>
            @forelse($columns as $column)
            @component('admin::export.current_fields_data', ['column' => $column, 'row' => $device]) @endcomponent
            @empty
            <td style="text-align: left;">{{ empty($device->title) ? '-' : $device->title }}</td>
            <td style="text-align: left;">
                {{ empty($device->comfortable_temperature) ? '-' : $device->comfortable_temperature }}</td>
            <td style="text-align: left;">{{ empty($device->avg_power) ? '-' : $device->avg_power }}</td>
            <td style="text-align: left;">{{($device->enabled == 0)? __('global.disabled') : __('global.enabled') }}</td>
            <td style="text-align: left;">{{($device->common == 1)? __('global.common') : __('global.normal') }}</td>

            @endforelse
        </tr>
        @endforeach
    </tbody>
</table>