<x-layouts.app title="Pesanan">

<div class="flex flex-col lg:flex-row gap-6">

    <!-- Grid Menu Makanan -->
    <div class="flex-1">
        <h1 class="text-2xl font-bold mb-6">Pesan Makanan</h1>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @php
                $menus = [
                    ['nama' => 'Nasi Goreng', 'harga' => 15000, 'foto' => 'https://via.placeholder.com/150'],
                    ['nama' => 'Mie Ayam', 'harga' => 12000, 'foto' => 'https://via.placeholder.com/150'],
                    ['nama' => 'Sate Ayam', 'harga' => 20000, 'foto' => 'https://via.placeholder.com/150'],
                    ['nama' => 'Gado-Gado', 'harga' => 10000, 'foto' => 'https://via.placeholder.com/150'],
                ];
            @endphp

            @foreach($menus as $menu)
            <div class="border rounded-lg overflow-hidden shadow cursor-pointer menu-card" 
                data-menu="{{ $menu['nama'] }}" data-harga="{{ $menu['harga'] }}">
                <img src="{{ $menu['foto'] }}" alt="{{ $menu['nama'] }}" class="w-full h-32 object-cover">
                <div class="p-3">
                    <h2 class="font-semibold text-lg">{{ $menu['nama'] }}</h2>
                    <p class="text-gray-500">Rp {{ number_format($menu['harga'],0,',','.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Sidebar Form -->
    <aside class="w-full lg:w-96 bg-white shadow p-6 shrink-0 mt-6 lg:mt-0">
        <h2 class="text-xl font-bold mb-4">Form Pesanan</h2>

        <form action="{{ url('/pesanan') }}" method="POST" id="order-form">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Nama Pemesan</label>
                <input type="text" name="nama_pemesan" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Menu Terpilih</label>
                <div id="selected-menu-list" class="space-y-2">
                    <p class="text-gray-400">Belum ada menu dipilih.</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Total Harga</label>
                <input type="text" id="total-harga" class="w-full border rounded px-3 py-2" readonly value="0">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Bayar</label>
                <input type="number" name="bayar" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors w-full">
                Submit Pesanan
            </button>
        </form>
    </aside>

</div>

</x-layouts.app>
