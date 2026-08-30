<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.partials.css')
    @stack('styles')
</head>

<body>
    <div class="wrapper">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.header')
        <div class="content-page">
            @yield('content')
            @include('layouts.partials.footer')
        </div>
    </div>
    @include('layouts.partials.js')
    @stack('scripts')
</body>

</html>
