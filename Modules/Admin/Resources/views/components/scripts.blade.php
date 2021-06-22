@props(['files' => []])

@foreach($files as $file)
    <script type="text/javascript" src="{{ asset($file .'?v='. config('constants.version'))}}"></script>
@endforeach