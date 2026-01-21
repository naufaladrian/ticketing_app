<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeTiket;

class TipeTiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe_tikets = TipeTiket::all();
        return view('admin.tipe_tikets.index', compact('tipe_tikets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'nama' => 'required|string|unique:tipe_tikets,nama|max:255',
        ]);

        if(!isset($payload['nama'])) {
            return redirect()->route('admin.tipe_tikets.index')->with('error', 'Nama tipe tiket wajib diisi.');
        }

        TipeTiket::create($payload);

        return redirect()->route('admin.tipe_tikets.index')->with('success', 'Tipe tiket berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payload = $request->validate([
            'nama' => 'required|string|unique:tipe_tikets,nama,'.$id.'|max:255',
        ]);

        if(!isset($payload['nama'])) {
            return redirect()->route('admin.tipe_tikets.index')->with('error', 'Nama tipe tiket wajib diisi.');
        }

        $ticketType = TipeTiket::findOrFail($id);
        $ticketType->update($payload);
        return redirect()->route('admin.tipe_tikets.index')->with('success', 'Tipe tiket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticketType = TipeTiket::findOrFail($id);
        $ticketType->delete();
        return redirect()->route('admin.tipe_tikets.index')->with('success', 'Tipe tiket berhasil dihapus.');
    }
}
