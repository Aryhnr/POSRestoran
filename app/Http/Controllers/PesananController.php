<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\PesananDetail;

class PesananController extends Controller
{
    // Tampilkan halaman pesanan
    public function index()
    {
        $menus = Menu::all();
        return view('pages.pesanan', compact('menus'));
    }


    // Simpan pesanan
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'items' => 'required',
            'total_harga' => 'required|integer|min:1',
            'bayar' => 'required|integer|min:1',
            'kembalian' => 'required|integer|min:0',
        ]);

        // Decode data item
        $items = json_decode($request->items, true);

        if (!$items || !is_array($items) || count($items) === 0) {
            return back()->with('error', 'Item pesanan tidak valid');
        }

        // Simpan ke tabel pesanan
        $pesanan = Pesanan::create([
            'nama_pemesan' => $request->nama_pemesan,
            'total_harga' => $request->total_harga,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
            'status' => 'selesai', // langsung selesai
        ]);

        // Insert detail pesanan
        foreach ($items as $item) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'menu_id' => $item['id'],
                'qty' => $item['jumlah'],
                'subtotal' => $item['harga'] * $item['jumlah'],
            ]);
        }

        return redirect('/pesanan')->with('success', 'Pesanan berhasil disimpan!');
    }
}
