<table class="table table-striped">
    <thead>
        <tr>
            @forelse($columns as $column)
            <th style="text-align: left;">{!! $column['name'] !!}</th>
            @empty
            <th style="text-align: left;">{{ __('global.message_id') }}</th>
            <th style="text-align: left;">{{ __('global.contacted_at') }}</th>
            <th style="text-align: left;">{{ __('global.replied_at') }}</th>
            <th style="text-align: left;">{{ __('global.name') }}</th>
            <th style="text-align: left;">{{ __('global.subject') }}</th>
            <th style="text-align: left;">{{ __('global.message') }}</th>
            @endforelse
        </tr>
    </thead>
    <tbody>
        @foreach($data['aaData'] as $message)
        <tr>
            @forelse($columns as $column)
            @component('admin::export.current_fields_data', ['column' => $column, 'row' => $message]) @endcomponent
            @empty
            <td style="text-align: left;">{{ ($message->id) }}</td>
                <td style="text-align: left;">
                    {{ empty($message->contacted_at) ? 0 : \Carbon\Carbon::parse($message->contacted_at)->format('Y-m-d, g:i A') }}
                </td>
                <td style="text-align: left;">{{ empty($message->replied_at) ? 'Not Yet' : \Carbon\Carbon::parse($message->replied_at)->format('Y-m-d, g:i A') }}</td>
                <td style="text-align: left;">{{ empty($message->client_name) ? '-' : $message->client_name }}</td>
                <td style="text-align: left;">{{ empty($message->subject) ? '-' : $message->subject }}</td>
                <td style="text-align: left;">{{ empty($message->message) ? '-' : $message->message }}</td>
            @endforelse
        </tr>
        @endforeach
    </tbody>
</table>