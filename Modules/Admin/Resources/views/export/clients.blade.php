<table class="table table-striped">
    <thead>
        <tr>
            @forelse($columns as $column)
            <th style="text-align: left;">{!! $column['name'] !!}</th>
            @empty
            <th style="text-align: left;">{{__('global.name')}}</th>
            <th style="text-align: left;">{{__('global.email')}}</th>
            <th style="text-align: left;">{{__('global.location')}}</th>
            <th style="text-align: left;">{{__('global.provider')}}</th>
            <th style="text-align: left;">{{__('global.has_hardware?')}}</th>
            <th style="text-align: left;">{{__('global.appliance')}}</th>
            <th style="text-align: left;">{{__('global.verified?')}}</th>
            <th style="text-align: left;">{{__('global.phone')}}</th>
            <th style="text-align: left;">{{ __('global.registered_at') }}</th>
            @endforelse
        </tr>
    </thead>
    <tbody>
        @foreach($data['aaData'] as $client)
        <tr>
            @forelse($columns as $column)
                @component('admin::export.current_fields_data', ['column' => $column, 'row' => $client]) @endcomponent
            @empty
            <td style="text-align: left;">{{ $client->first_name}} {{ $client->last_name}}</td>
            <td style="text-align: left;">{{ $client->email }}</td>
            <td style="text-align: left;">
                {{ empty($client->country) ? '-' : $client->country }} {{ empty($client->city) ? '-' : $client->city }}
            </td>
            <td style="text-align: left;">{{ empty($client->provider_name) ? '-' : $client->provider_name }}</td>
            <td style="text-align: left;">{{ empty($client->serial_number) ? __('global.no_hardware') : $client->serial_number }}</td>
            <td style="text-align: left;">{{ empty($client->devices_count) ? 0 : $client->devices_count }}</td>
            <td style="text-align: left;">{{ ($client->email_verified==0) ? __('global.not_verified') : __('global.verified') }}</td>
            <td style="text-align: left;">{{ empty($client->mobile) ? '-' : $client->mobile }}</td>
            <td style="text-align: left;">{{ empty($client->registered_at) ? '0' : \Carbon\Carbon::parse($client->registered_at)->format('Y-m-d, g:i A') }}</td>

            @endforelse
        </tr>
        @endforeach
    </tbody>
</table>