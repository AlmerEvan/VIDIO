<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Kategoris = Kategori::all();
        $Menus = Menu :: paginate(4);

        return view ('menu',[
        'Kategoris'=> $Kategoris,
        'Menus'=> $Menus
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'jeniskelamin' => 'required',
            'email' => 'required | email | unique:pelanggans',
            'password' => 'required | min:3',
        ]);
        Pelanggan::create([
            'pelanggan' => $data['pelanggan'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
            'jeniskelamin' => $data['jeniskelamin'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'aktif' => 1,
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Kategoris = Kategori::all();
        $Menus = Menu::where('idkategori',$id)->paginate(2);

        return view('kategori',[
            'Kategoris'=> $Kategoris,
            'Menus'=> $Menus
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function register()
    {
        $Kategoris = Kategori::all();

        return view('register',[
            'Kategoris'=> $Kategoris,
        ]);
    }

    public function login()
    {
        $Kategoris = Kategori::all();
        return view('login', [
            'Kategoris' => $Kategoris,
        ]);
    }

    public function loginProcess(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $data['email'])->first();

        if ($pelanggan && Hash::check($data['password'], $pelanggan->password)) {
            Session::put('idpelanggan', $pelanggan->idpelanggan);
            Session::put('email', $pelanggan->email);
            return redirect('/')->with('success', 'Login successful!');
        } else {
            return redirect('/login')->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}

