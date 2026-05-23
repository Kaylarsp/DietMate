<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DietMate - Admin')</title>

    {{-- Google Fonts: Manrope --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css'])

    {{-- Optional additional head content --}}
    @yield('head')
</head>

<body class="font-sans antialiased"
    style="background: linear-gradient(141deg, #F9F9F9 0%, #CEE7E5 100%); min-height: 100vh;">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar', ['activeRoute' => $activeRoute ?? 'dashboard'])

    {{-- Main Content --}}
    <main class="ml-[256px] p-16" style="min-height: 100vh;">
        @yield('content')
    </main>

</body>

</html>