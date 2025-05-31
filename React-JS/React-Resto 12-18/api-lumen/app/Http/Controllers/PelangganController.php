<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelanggan::all();
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
        'pelanggan' => 'required', 
        'alamat' => 'required', 
        'telp' => 'required | numeric '
        ]); 

        $pelanggan = Pelanggan::create($request->all()); 
        return response()->json($pelanggan); 
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
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pelanggan::where('id_pelanggan', $id)->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->first();
    
        if ($pelanggan) {
            $pelanggan->update($request->all());
            return response()->json('Data pelanggan berhasil diperbarui');
        } else {
            return response()->json('Data pelanggan tidak ditemukan', 404);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Cari data pelanggan berdasarkan id
    $pelanggan = Pelanggan::where('idpelanggan', $id)->first();

    if ($pelanggan) {
        $pelanggan->delete();
        return response()->json('Data pelanggan berhasil dihapus');
    } else {
        return response()->json('Data tidak ditemukan', 404);
    }
}

}
