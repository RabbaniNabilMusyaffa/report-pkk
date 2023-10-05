<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Laporan::all();
        return view('home', compact('data'));
    }

    public function edit($id)
    {
        $datas = Laporan::find($id);
        return view('edit', compact('datas'));
    }

    public function listProduk()
    {
        return view('listProduk');
    }

    public function tambahLaporan()
    {
        return view('tambahLaporan');
    }
    public function tambahDataLaporan(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'tanggal_penjualan' => 'required',
            'pendapatan' => 'required'
        ]);
        Laporan::create([
            'nama_produk' => $request->nama_produk,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'pendapatan' => $request->pendapatan,
        ]);
        return redirect()->route('home')->with('message', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $datas = Laporan::find($id);
        $request->validate([
            'nama_produk' => 'required',
            'tanggal_penjualan' => 'required',
            'pendapatan' => 'required'
        ]);

        $datas->update([
            'nama_produk' => $request->nama_produk,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'pendapatan' => $request->pendapatan
        ]);
        return redirect()->route('home')->with('message', 'Data berhasil diperbarui');
    }

    public function Delete($id)
    {
        Laporan::destroy($id);

        return redirect()->route('home')->with('message', 'Data berhasil dihapus');
    }
}
