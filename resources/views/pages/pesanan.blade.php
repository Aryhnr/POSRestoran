<x-layouts.app title="Pesanan">

<div class="flex flex-col lg:flex-row gap-6">

    <!-- Grid Menu Makanan -->
    <div class="flex-1">
        <h1 class="text-2xl font-bold mb-6">Pesan Makanan</h1>

        <div class="mb-4">
            <input type="text" id="searchMenu" placeholder="Cari menu..."
                class="w-full p-2 border rounded">
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($menus as $menu)
            <div class="border rounded-lg overflow-hidden shadow cursor-pointer menu-card menu-item"
                data-id="{{ $menu->id }}"
                data-menu="{{ $menu->name }}"
                data-harga="{{ $menu->harga }}">

                @if($menu->foto)
                    <img src="{{ asset('storage/public/fotos/' . $menu->foto) }}"
                        class="w-full h-32 object-cover">
                @else
                    <img src="https://via.placeholder.com/150"
                        class="w-full h-32 object-cover">
                @endif

                <div class="p-3">
                    <h2 class="font-semibold text-lg">{{ $menu->name }}</h2>
                    <p class="text-gray-500">Rp {{ number_format($menu->harga,0,',','.') }}</p>
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

            <!-- Hidden Input (wajib tidak duplikat!) -->
            <input type="hidden" name="items" id="items-input">
            <input type="hidden" name="total_harga" id="total-harga-hidden" value="0">
            <input type="hidden" name="kembalian" id="kembalian-hidden" value="0">

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

            <!-- Total Harga -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Total Harga</label>

                <span id="total-harga-display" class="font-bold text-lg">Rp 0</span>
            </div>

            <!-- Bayar -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Bayar</label>
                <input type="text" name="bayar" id="bayar-input"
                    class="w-full border rounded px-3 py-2"
                    required inputmode="numeric" placeholder="Masukkan nominal bayar">
                <p id="bayar-help" class="text-sm text-red-600 mt-1 hidden">
                    Pembayaran kurang dari total.
                </p>
            </div>

            <!-- Kembalian -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Kembalian</label>
                <input type="text" id="kembalian-display"
                    class="w-full border rounded px-3 py-2" readonly value="Rp 0">
            </div>

            <button type="submit" id="submit-btn"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors w-full">
                Checkout
            </button>


            <!-- TOMBOL CLEAR -->
            <button type="button" id="clear-btn"
                class="mt-3 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors w-full">
                Clear Pesanan
            </button>
        </form>

    </aside>
</div>

</x-layouts.app>
