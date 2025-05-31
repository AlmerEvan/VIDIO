<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $this->validate($request, [
        'kategori' => 'required|unique:kategoris',
        'keterangan' => 'required'
    ]);

    $kategori = Kategori::create($request->all());
    return response()->json($kategori);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kategori::where('id_kategori', $id)->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $kategori = Kategori::where('id_kategori', $id)->first();

    if ($kategori) {
        $kategori->update($request->all());
        return response()->json('Data kategori berhasil diperbarui');
    } else {
        return response()->json('Data kategori tidak ditemukan', 404);
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::where('idkategori', $id)->first();
    
        if ($kategori) {
            $kategori->delete();
            return response()->json('Data kategori berhasil dihapus');
        } else {
            return response()->json('Data kategori tidak ditemukan', 404);
        }
    }
    
}
