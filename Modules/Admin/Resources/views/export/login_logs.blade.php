<table class="table table-striped">
    <thead>
        <tr>
            <th>@lang('global.login_date')</th>
            <th>@lang('global.username')</th>
            <th>@lang('global.email')</th>
            <th>@lang('global.role')</th>
            <th>@lang('global.ip_address')</th>
            <th>@lang('global.status')</th>
            <th>@lang('global.note')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['aaData'] as $login_log)
        <tr>
            <td>{{ $login_log->login_date }}</td>
            <td>{{ $login_log->username ?? '-' }}</td>
            <td>{{ $login_log->email ?? '-' }}</td>
            <td>{{ $login_log->role['name'] ?? '-' }}</td>
            <td>{{ $login_log->ip_address }}</td>
            <td>{{ $login_log->status }}</td>
            <td>{{ $login_log->note }}</td>
        </tr>
        @endforeach
    </tbody>
</table>