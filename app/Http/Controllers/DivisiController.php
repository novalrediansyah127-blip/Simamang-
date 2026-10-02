<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    // Menampilkan semua data divisi
    public function index()
    {
        $divisis = Divisi::latest()->get();

        return view('divisi.index', compact('divisis'));
    }

    // Menampilkan form tambah divisi
    public function create()
    {
        return view('divisi.create');
    }

    // Menyimpan data divisi
    public function store(Request $request)
    {
        $request->validate([
            'kode_divisi' => 'required|string|max:20|unique:divisis,kode_divisi',
            'nama_divisi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Divisi::create([
            'kode_divisi' => $request->kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Data divisi berhasil ditambahkan.');
    }

    // Menampilkan detail divisi
    public function show(Divisi $divisi)
    {
        return view('divisi.show', compact('divisi'));
    }

    // Menampilkan form edit
    public function edit(Divisi $divisi)
    {
        return view('divisi.edit', compact('divisi'));
    }

    // Memperbarui data divisi
    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'kode_divisi' => 'required|string|max:20|unique:divisis,kode_divisi,' . $divisi->id,
            'nama_divisi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $divisi->update([
            'kode_divisi' => $request->kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Data divisi berhasil diperbarui.');
    }

    // Menghapus data divisi
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Data divisi berhasil dihapus.');
    }
}   