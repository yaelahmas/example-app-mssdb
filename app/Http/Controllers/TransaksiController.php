<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::with('komoditas')->get();
        $report = [];
        foreach ($data as $row) {

            $tahun = date('Y', strtotime($row->tanggal_type));
            $bulan = date('n', strtotime($row->tanggal_type));
            $komoditas = $row->komoditas->nama;

            if (!isset($report[$tahun][$komoditas])) {
                $report[$tahun][$komoditas] = [
                    'tahun'     => $tahun,
                    'komoditas' => $komoditas,
                    'january'   => 0,
                    'february'  => 0,
                    'march'     => 0,
                    'april'     => 0,
                    'may'       => 0,
                    'june'      => 0,
                    'july'      => 0,
                    'august'    => 0,
                    'september' => 0,
                    'october'   => 0,
                    'november'  => 0,
                    'december'  => 0,
                ];
            }

            $monthNames = [
                1 => 'january',
                2 => 'february',
                3 => 'march',
                4 => 'april',
                5 => 'may',
                6 => 'june',
                7 => 'july',
                8 => 'august',
                9 => 'september',
                10 => 'october',
                11 => 'november',
                12 => 'december'
            ];

            $report[$tahun][$komoditas][$monthNames[$bulan]] += $row->produksi;
        }

        $final = [];
        foreach ($report as $tahun => $rows) {
            foreach ($rows as $row) {
                $final[] = $row;
            }
        }

        return view('transaksi.index',  [
            'transaksi' => $data,
            'report' => $final
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komoditas = Komoditas::all();
        return view('transaksi.create', compact('komoditas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_type'       => 'required|date|unique:transaksi,tanggal_type',
            't_komoditas_kode'   => 'required',
            'produksi'           => 'required|integer|min:0'
        ]);

        Transaksi::create([
            'tanggal_type' => $request->tanggal_type,
            't_komoditas_kode' => $request->t_komoditas_kode,
            'produksi' => $request->produksi,
        ]);

        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $data = Transaksi::findOrFail($id);
        $komoditas = Komoditas::all();
        return view('transaksi.edit', compact('data', 'komoditas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transkasi = Transaksi::findOrFail($id);

        $request->validate([
            'tanggal_type' => 'required|date|unique:transaksi,tanggal_type,' . $id,
            't_komoditas_kode' => 'required',
            'produksi' => 'required|integer|min:0'
        ]);

        $transkasi->update([
            'tanggal_type' => $request->tanggal_type,
            't_komoditas_kode' => $request->t_komoditas_kode,
            'produksi' => $request->produksi,
        ]);

        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
