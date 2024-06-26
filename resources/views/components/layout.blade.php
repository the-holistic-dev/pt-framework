<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PTFramework</title>
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>

@php
    use App\Models\CnfFood;
@endphp

<body class="vh-100 d-flex flex-column justify-content-between">
    <main>
        {{ $slot }}
    </main>
    @include('partials._footer')
    <x-head.tinymce-config />
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
