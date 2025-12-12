<!-- resources/views/components/layout/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script src="https://kit.fontawesome.com/268ca19cdb.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <x-sidebar />

    <div class="flex-1 flex flex-col">
        {{-- Navbar --}}
        <x-navbar />

        {{-- Main Content --}}
        <main class="p-6 flex-1">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-footer />
    </div>

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
