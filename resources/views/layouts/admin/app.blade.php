<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <div class="flex">
            <aside class="bg-gray-800 max-[600px]:w-2/6 w-1/5">
                @include('layouts.admin.sidebar')
            </aside>
            <main class="bg-gray-100 flex-1 p-12">
                {{$slot}}
            </main>
        </div>
    </div>

    <script src="https://flowbite.com/docs/flowbite.min.js"></script>
</body>

</html>