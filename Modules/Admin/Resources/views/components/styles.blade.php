@props(['files' => []])

@foreach($files as $file)
    <link rel="stylesheet" href="{{ asset($file .'?v='. config('constants.version'))}}"/>
@endforeach