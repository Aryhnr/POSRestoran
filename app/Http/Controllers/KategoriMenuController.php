<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMenu as Kategori;
class KategoriMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view("pages.menu-makanan", compact("kategoris"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.menu-makanan");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        Kategori::create($request->all());

        return redirect()->route("pages.menu-makanan")
            ->with("success", "Data Kategori Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view("pages.menu-makanan", compact($kategori));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view("pages.menu-makanan", compact($kategori));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);


        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only('name'));

        return redirect()->route("pages.menu-makanan")
            ->with("success", "Data Kategori Berhasil Diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route("pages.menu-makanan")
            ->with("success", "Data Kategori Berhasil Dihapus");

    }
}
