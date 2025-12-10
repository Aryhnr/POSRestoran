<aside id="sidebar-left" class="bg-white shadow w-64 p-4 shrink-0
    md:static absolute inset-y-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300">

    <h2 class="font-bold text-lg mb-4">Menu</h2>
    <ul class="space-y-2">
        <li>
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 py-2 px-4 rounded transition-colors
                {{ Request::is('dashboard') ? 'bg-red-100 text-red-600' : 'hover:bg-red-100 hover:text-red-600' }}">
                <i class="fa-solid fa-house w-5"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/pesanan') }}" class="flex items-center gap-3 py-2 px-4 rounded transition-colors
                {{ Request::is('pesanan') ? 'bg-red-100 text-red-600' : 'hover:bg-red-100 hover:text-red-600' }}">
                <i class="fa-solid fa-clipboard-list w-5"></i>
                <span>Pesanan</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/menu-makanan') }}" class="flex items-center gap-3 py-2 px-4 rounded transition-colors
                {{ Request::is('menu-makanan') ? 'bg-red-100 text-red-600' : 'hover:bg-red-100 hover:text-red-600' }}">
                <i class="fa-solid fa-utensils w-5"></i>
                <span>Menu Makanan</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/laporan') }}" class="flex items-center gap-3 py-2 px-4 rounded transition-colors
                {{ Request::is('laporan') ? 'bg-red-100 text-red-600' : 'hover:bg-red-100 hover:text-red-600' }}">
                <i class="fa-solid fa-book w-5"></i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>
</aside>

{{-- Overlay untuk mobile --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>
