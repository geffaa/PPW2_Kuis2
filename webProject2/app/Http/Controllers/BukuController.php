<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Carbon\Carbon;


class BukuController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 4;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->simplePaginate($batas);


        $no = $batas * ($data_buku->currentPage()-1);

        // menghitung total harga
        $total_harga = 0;
        foreach ($data_buku as $buku) {
            $total_harga = $total_harga +  (int)$buku->harga;
        }



        // me-return hasilnya menggunakan sebuah view
        return view('index', compact('data_buku', 'total_harga', 'no', 'jumlah_buku'));

    }

    public function search(Request $request)
    {
        $batas = 4;
        $cari = $request->kata;

        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")->simplePaginate($batas);


        $jumlah_buku = $data_buku->count();

        $no = $batas * ($data_buku->currentPage()-1);
        $total_harga = 0;
        foreach ($data_buku as $buku) {
            $total_harga = $total_harga +  (int)$buku->harga;
        }

        return view('index', compact('data_buku', 'total_harga', 'no', 'jumlah_buku', 'cari'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);


        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;

        $buku->tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));
        $buku->save();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $buku = Buku::find($id);
        return view('edit',compact( 'buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id = $request->id;

        $judul = $request->judul;
        $penulis = $request->penulis;
        $harga = $request->harga;
        $tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));


        Buku::where('id', $id)->update([
            'judul' => $judul,
            'penulis' => $penulis,
            'harga' => $harga,
            'tgl_terbit' => $tgl_terbit,
        ]);

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Hapus');
    }
}
