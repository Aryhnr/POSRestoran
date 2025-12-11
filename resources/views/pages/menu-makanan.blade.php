<x-layouts.app title="Menu Makanan">

    <!-- Header + Tombol Tambah -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Menu Makanan</h1>
        <div class="flex gap-2">
            <button onclick="openModal('modalKategori')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Tambah Kategori
            </button>
            <button onclick="openModal('modalMenu')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Tambah Menu
            </button>
        </div>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded bg-green-100">
            <div class="flex-1">{{ session('success') }}</div>
            <button onclick="this.parentElement.remove()" class="text-green-700 font-bold px-2">✕</button>
        </div>
    @endif

    @if(session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded bg-red-100">
            <div class="flex-1">{{ session('error') }}</div>
            <button onclick="this.parentElement.remove()" class="text-red-700 font-bold px-2">✕</button>
        </div>
    @endif

    <!-- Modal Tambah Kategori -->
    <div id="modalKategori" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
        <div class="bg-white w-96 rounded-lg p-5 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Kategori</h2>
                <button onclick="closeModal('modalKategori')" class="text-gray-500 hover:text-black">✕</button>
            </div>
            <form action="{{ route('menu-makanan.kategori.store') }}" method="POST">
                @csrf
                <label class="block mb-2 text-sm">Nama Kategori</label>
                <input type="text" name="name" class="w-full border rounded p-2 mb-4" placeholder="Masukkan nama kategori" required>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Menu -->
    <div id="modalMenu" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
        <div class="bg-white w-96 rounded-lg p-5 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Menu</h2>
                <button onclick="closeModal('modalMenu')" class="text-gray-500 hover:text-black">✕</button>
            </div>
            <form action="#" method="POST">
                @csrf
                <label class="block mb-2 text-sm">Nama Menu</label>
                <input type="text" class="w-full border rounded p-2 mb-3" placeholder="Masukkan nama menu" required>

                <label class="block mb-2 text-sm">Harga</label>
                <input type="number" class="w-full border rounded p-2 mb-3" placeholder="Masukkan harga" required>

                <label class="block mb-2 text-sm">Kategori</label>
                <select class="w-full border rounded p-2 mb-4" required>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Tabel Kategori -->
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700 font-medium">No</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-medium">Kategori</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $index => $kategori)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $kategori->name }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <button class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" onclick="openModal('editModal{{ $kategori->id }}')">Edit</button>

                            <form action="{{ route('menu-makanan.kategori.delete', $kategori->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Kategori per row (placeholder) -->
                    <div id="editModal{{ $kategori->id }}" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
                        <div class="bg-white w-96 rounded-lg p-5 shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold">Edit Kategori</h2>
                                <button onclick="closeModal('editModal{{ $kategori->id }}')" class="text-gray-500 hover:text-black">✕</button>
                            </div>
                            <form action="{{ route('menu-makanan.kategori.update', $kategori->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- <- ini wajib untuk method PUT -->
                                
                                <label class="block mb-2 text-sm">Nama Kategori</label>
                                <input type="text" name="name" value="{{ $kategori->name }}" class="w-full border rounded p-2 mb-4" required>

                                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                            </form>

                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Contoh Grid Menu -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <div class="p-4 bg-white rounded shadow">
            <h2 class="font-semibold">Nasi Goreng</h2>
            <p class="text-gray-500">Rp 15.000</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="font-semibold">Mie Ayam</h2>
            <p class="text-gray-500">Rp 12.000</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="font-semibold">Sate Ayam</h2>
            <p class="text-gray-500">Rp 20.000</p>
        </div>
    </div>

</x-layouts.app>
