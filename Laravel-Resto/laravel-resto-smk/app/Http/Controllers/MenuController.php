<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        $menus = Menu::join('kategoris', 'menus.idkategori', '=', 'kategoris.idkategori')
            ->select('menus.*', 'kategoris.*')
            ->paginate(2);

        return view('backend.menu.select', ['menus' => $menus, 'kategoris' => $kategoris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('backend.menu.insert', ['kategoris' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|max:2048',
        ]);

        $id = $request->idkategori;

        $file = $request->file('gambar');
        $filename = $file->getClientOriginalName();
        $request->gambar->move('gambar', $filename);

        Menu::create([
            'idkategori' => $id,
            'menu' => $data['menu'],
            'deskripsi' => $data['deskripsi'],
            'harga' => $data['harga'],
            'gambar' => $filename,
        ]);

        return redirect('admin/menu')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($idmenu)
    {
        Menu::where('idmenu', '=', $idmenu)->delete();
        return redirect('admin/menu');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $idmenu)
    {
        $kategoris = Kategori::all();
        $menu = Menu::where('idmenu', $idmenu)->first();
        return view('Backend.menu.update', [
            'menu' => $menu,
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idmenu)
    {
        $file = $request->file('gambar');
        $filename = $file->getClientOriginalName();

        if (isset($request->gambar)) {
            $data = $request->validate([
                'menu' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required|numeric',
                'gambar' => 'required|image|max:2048',
            ]);

            $menu = Menu::where('idmenu', $idmenu)->update([
                'menu' => $data['menu'],
                'deskripsi' => $data['deskripsi'],
                'harga' => $data['harga'],
                'gambar' => $filename,
            ]);
            $request->gambar->move('gambar', $filename);

        }else{
            $data = $request->validate([
                'menu' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required|numeric',
            ]);

            $menu = Menu::where('idmenu', $idmenu)->update([
                'menu' => $data['menu'],
                'deskripsi' => $data['deskripsi'],
                'harga' => $data['harga'],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Hapus file gambar jika ada
        $path = public_path('gambar/' . $menu->gambar);
        if (file_exists($path)) {
            unlink($path);
        }
    
        // Hapus data dari database
        $menu->delete();
    
        return redirect('admin/menu')->with('success', 'Menu berhasil dihapus');
    }
    
    
    public function select(Request $request)
    {
        $id = $request->idkategori;
        $kategoris = Kategori::all();
        $menus = Menu::join('kategoris', 'menus.idkategori', '=', 'kategoris.idkategori')
            ->select('menus.*', 'kategoris.*')
            ->where('menus.idkategori', $id)
            ->paginate(2);

        return view('backend.menu.select', ['menus' => $menus, 'kategoris' => $kategoris]);
    }


    }