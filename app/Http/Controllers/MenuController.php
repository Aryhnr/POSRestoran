<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\KategoriMenu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $kategoris = KategoriMenu::all();

        return view('pages.menu-makanan', compact('menus', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_menu,id',
            'name'        => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['kategori_id', 'name', 'harga']);

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan di storage/app/public/fotos
            $file->storeAs('public/fotos', $filename);

            $data['foto'] = $filename;
        }

        Menu::create($data);

        return redirect()->route("pages.menu-makanan")
            ->with("success", "Data Menu Makanan Berhasil Ditambahkan");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_menu,id',
            'name'        => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->only(['kategori_id', 'name', 'harga']);

        // Upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($menu->foto && Storage::exists('public/fotos/' . $menu->foto)) {
                Storage::delete('public/fotos/' . $menu->foto);
            }

            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/fotos', $filename);

            $data['foto'] = $filename;
        }

        $menu->update($data);

        return redirect()->route("pages.menu-makanan")
            ->with("success", "Data Menu Makanan Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus foto
        if ($menu->foto && Storage::exists('public/fotos/' . $menu->foto)) {
            Storage::delete('public/fotos/' . $menu->foto);
        }

        $menu->delete();

        return redirect()->route('pages.menu-makanan')
            ->with('success', 'Menu berhasil dihapus');
    }
}
