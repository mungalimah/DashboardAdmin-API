<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class KategoriController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('name', 'asc')->get();
        return view('kategori.kategori', [
            'kategori' => $kategori
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:kategori,name', // Cek unik di tabel kategori
        ]);

        $input = $request->all();

        Kategori::create($input);

        Alert::success('Success', 'Kategori has been saved !');
        return redirect('/kategori');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_kategori)
    {
        $kategori = kategori::findOrFail($id_kategori);

        return view('kategori', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        // Validasi data, buat gambar opsional (nullable)
        $validated = $request->validate([
            'name' => 'required|max:100|unique:kategori,name,' . $id_kategori . ',id_kategori',
        ]);

        // Update data kategori
        $kategori->update($validated);

        // Tampilkan pesan sukses
        Alert::info('Success', 'Kategori has been updated!');
        return redirect('/kategori');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kategori)
    {
        try {
            $deletedkategori = Kategori::findOrFail($id_kategori);
    
            $deletedkategori->delete();
    
            Alert::success('Success', 'Kategori has been deleted !');
            return redirect('/kategori');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Kategori already used !');
            return redirect('/kategori');
        }
    }
}