<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons & Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/country-flag-emoji-polyfill/index.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.documentElement.setAttribute('lang', '{{ app()->getLocale() }}');
    </script>
</head>

<body class="bg-gray-50 text-gray-800 pt-10">
    <!-- Demo Banner -->
    <div
        class="fixed top-0 left-0 w-full bg-yellow-400 text-black text-center py-2 z-[9999] font-bold text-sm shadow-md flex justify-center items-center gap-4">
        <span>🚧 {{ __('messages.demo_version') }}</span>
        <a href="#contact" class="bg-black text-white px-3 py-1 rounded-full text-xs hover:bg-gray-800 transition">
            {{ __('messages.buy_now') }}
        </a>
    </div>

    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        const AI_HANDLE_ROUTE = "{{ route('ai.handle') }}";
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>