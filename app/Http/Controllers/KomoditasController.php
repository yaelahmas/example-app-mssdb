<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komoditas = Komoditas::latest()->paginate(10);
        return view('komoditas.index', compact('komoditas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode = $this->generateKode();
        return view('komoditas.create', [
            'kode' => $kode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5',
        ]);

        Komoditas::create([
            't_komoditas_kode' => $request->t_komoditas_kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('komoditas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $komodita = Komoditas::findOrFail($id);
        return view('komoditas.edit', compact('komodita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|min:5',
        ]);

        $komodita = Komoditas::findOrFail($id);

        $komodita->update([
            't_komoditas_kode' => $request->t_komoditas_kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('komoditas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komodita = Komoditas::findOrFail($id);
        $komodita->delete();
        return redirect()->route('komoditas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    private function generateKode()
    {
        $last = Komoditas::orderBy('id', 'DESC')->first();
        $number = $last ? intval(substr($last->t_komoditas_kode, 1)) + 1 : 1;
        return 'K' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
