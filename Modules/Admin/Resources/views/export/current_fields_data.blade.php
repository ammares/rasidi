

@switch($column['type'])
    @case('ucstring')
    <td style="text-align:left;">{{ ucwords(str_replace(['_', '-'], ' ', $row[$column['data']])) }}</td>
    @break
    @case('string')
    <td style="text-align:left;">{{ empty($row[$column['data']]) ? '-' : $row[$column['data']] }}</td>
    @break
    @case('numeric')
    <td style="text-align:left;">{{ number_format($row[$column['data']], 0) }}</td>
    @break
    @case('date')
    <td style="text-align:left;">{{ \Carbon\Carbon::parse($row[$column['data']])->format('Y-m-d, g:i A') }}</td>
    @break
    @case('boolean')
    <td style="text-align:left;">{{ $row[$column['data']]  > 0 ? 'Yes' : 'No' }}</td>
    @break
    @case('positive')
    <td style="text-align:left;">{{ $row[$column['data']] > 0 ? $row[$column['data']] : '-' }}</td>
    @break
    @default
    <td style="text-align:left;">{{$row[$column['data']]}}</td>
@endswitch
