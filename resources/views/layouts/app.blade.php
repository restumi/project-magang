<!DOCTYPE html>
<html lang="zxx" dir="ltr" class="light">
<head>
    <!-- Meta + CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashcode')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Template -->
    <link rel="stylesheet" href="{{ asset('assets/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/settings.js') }}" sync></script>
</head>
<body class="font-inter dashcode-app" id="body_class">

<main class="app-wrapper">

    <!-- ✅ SIDEBAR -->
    @include('layouts.sidebar')

    <!-- ✅ SETTINGS OFFCANVAS (panel settings) -->
    @include('layouts.settings')

    <!-- ✅ HEADER -->
    @include('layouts.header')

    <!-- ✅ KONTEN DINAMIS -->
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
        <div class="page-content">
            <div class="transition-all duration-150 container-fluid" id="page_layout">
                <div id="content_layout">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ MOBILE FOOTER -->
    <div class="bg-white bg-no-repeat custom-dropshadow footer-bg md:hidden ...">
        <!-- ... -->
    </div>

</main>

<!-- ✅ SCRIPT JS (wajib!) -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/rt-plugins.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- ✅ Script tambahan buat tahun footer -->
<script>
    document.getElementById('thisYear').textContent = new Date().getFullYear();
</script>

</body>
</html>
