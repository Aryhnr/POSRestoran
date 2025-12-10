<x-layouts.app title="Laporan">
    <h1 class="text-2xl font-bold mb-4">Laporan Penjualan</h1>

    <p class="mb-4 text-gray-600">Laporan ini menampilkan ringkasan penjualan harian.</p>

    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Total Pesanan</th>
                <th class="p-3 text-left">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="p-3">2025-12-10</td>
                <td class="p-3">20</td>
                <td class="p-3">Rp 3.000.000</td>
            </tr>
            <tr class="border-t">
                <td class="p-3">2025-12-09</td>
                <td class="p-3">15</td>
                <td class="p-3">Rp 2.500.000</td>
            </tr>
        </tbody>
    </table>
</x-layouts.app>
