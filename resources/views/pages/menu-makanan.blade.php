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
            
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Menu</h2>
                <button onclick="closeModal('modalMenu')" class="text-gray-500 hover:text-black">✕</button>
            </div>

            <!-- Form Tambah Menu -->
            <form action="{{ route('menu-makanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Menu -->
                <label class="block mb-2 text-sm">Nama Menu</label>
                <input 
                    type="text" 
                    name="name" 
                    class="w-full border rounded p-2 mb-3" 
                    placeholder="Masukkan nama menu" 
                    required
                >

                <!-- Harga -->
                <label class="block mb-2 text-sm">Harga</label>
                <input 
                    type="number" 
                    name="harga" 
                    class="w-full border rounded p-2 mb-3" 
                    placeholder="Masukkan harga" 
                    min="0" 
                    required
                >

                <!-- Kategori -->
                <label class="block mb-2 text-sm">Kategori</label>
                <select 
                    name="kategori_id" 
                    class="w-full border rounded p-2 mb-4" 
                    required
                >
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>

                <!-- Foto -->
                <label class="block mb-2 text-sm">Foto</label>
                <input 
                    type="file" 
                    name="foto" 
                    class="w-full border rounded p-2 mb-4"
                    accept="image/*"
                >

                <!-- Submit -->
                <button 
                    type="submit" 
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700"
                >
                    Simpan
                </button>
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
        @foreach ($menus as $menu)
            <!-- Card 1 -->
            <div class="bg-white rounded shadow overflow-hidden">
                <img src="{{ asset('storage/public/fotos/'.$menu->foto) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <p class="inline-block px-3 py-1 rounded-full text-white font-semibold text-sm
                        {{ $kategori->name == 'Makanan' ? 'bg-green-500' : '' }}
                        {{ $kategori->name == 'Minuman' ? 'bg-blue-500' : '' }}
                        {{ $kategori->name == 'Snack' ? 'bg-yellow-500' : '' }}">
                        {{ $menu->kategori->name }}
                    </p> 
                    <h2 class="font-semibold text-lg py-1">{{ $menu->name }}</h2>
                    <p class="text-gray-500 mt-1">Rp {{ $menu->harga }}</p>

                    <div class="mt-4 flex gap-2">
                        <button class="flex-1 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600" onclick="openModal('editModalMenu{{ $menu->id }}')">Edit</button>
                        <form action="{{ route('menu-makanan.destroy', $menu->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="flex-1 bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="editModalMenu{{ $menu->id }}" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
                <div class="bg-white w-96 rounded-lg p-5 shadow-lg">
                    
                    <!-- Header Modal -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Tambah Menu</h2>
                        <button onclick="closeModal('editModalMenu{{ $menu->id }}')" class="text-gray-500 hover:text-black">✕</button>
                    </div>

                    <!-- Form Tambah Menu -->
                    <form action="{{ route('menu-makanan.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Nama Menu -->
                        <label class="block mb-2 text-sm">Nama Menu</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="w-full border rounded p-2 mb-3" 
                            placeholder="Masukkan nama menu" 
                            required
                            value="{{ $menu-> name}}"
                        >

                        <!-- Harga -->
                        <label class="block mb-2 text-sm">Harga</label>
                        <input 
                            type="number" 
                            name="harga" 
                            class="w-full border rounded p-2 mb-3" 
                            placeholder="Masukkan harga" 
                            min="0" 
                            required
                            value="{{ $menu-> harga}}"
                        >

                        <!-- Kategori -->
                        <label class="block mb-2 text-sm">Kategori</label>
                        <select 
                            name="kategori_id" 
                            class="w-full border rounded p-2 mb-4" 
                            required
                        >
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $menu->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Foto -->
                        <label class="block mb-2 text-sm">Foto</label>
                        <input 
                            type="file" 
                            name="foto" 
                            class="w-full border rounded p-2 mb-4"
                            accept="image/*"
                        >
                        @if($menu->foto)
                            <img src="{{ asset('storage/public/fotos/'.$menu->foto) }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover mb-4">
                        @endif

                        <!-- Submit -->
                        <button 
                            type="submit" 
                            class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700"
                        >
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    


</x-layouts.app>
