<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    use App\Models\Menu;
use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Models\Menu;

public function create(Request $request)
{
    // Validasi input
    $this->validate($request, [
        'idkategori' => 'required|numeric',
        'menu' => 'required|uniqe:menus',
        'harga' => 'required|numeric',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Proses upload gambar
    $gambar = $request->file('gambar')->getClientOriginalName();
    $request->file('gambar')->move(public_path('upload'), $gambar);

    // Siapkan data
    $data = [
        'idkategori' => $request->input('idkategori'),
        'menu' => $request->input('menu'),
        'harga' => $request->input('harga'),
        'gambar' => 'upload/' . $gambar
    ];

    // Simpan data ke database
    $menu = Menu::create($data);

    // Format respons
    if ($menu) {
        $result = [
            // 'status' => 200,
            'pesan' => 'Data sudah ditambahkan',
            'data' => $data
        ];
    } else {
        $result = [
            // 'status' => 400,
            'pesan' => 'Data tidak bisa ditambahkan',
            'data' => null
        ];
    }

    return response()->json($result,200);
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
