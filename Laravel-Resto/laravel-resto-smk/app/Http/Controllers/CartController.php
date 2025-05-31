<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Kategori;
use App\Models\Orderdetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function beli($idmenu)
    {

        if (session()->missing('idpelanggan')) {
            return redirect('login');
        }

        $menu = Menu::where('idmenu', $idmenu)->first();

        $cart = session()->get('cart', []);
        // echo '1';
        // echo $menu->menu;
        // if(isset($cart[$idmenu])){
        //     $cart[$idmenu]['jumlah']++;
        // }else{
        //     echo '1';
        // }


        if (isset($cart[$idmenu])) {
            $cart[$idmenu]['jumlah']++;
        } else {
            $cart[$idmenu] = [
                'idmenu' => $menu->idmenu,
                'menu' => $menu->menu,
                'harga' => $menu->harga,
                'gambar' => $menu->gambar,
                'jumlah' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect('cart');
    }

    public function cart()
    {
        if (session()->missing('idpelanggan')) {
            return redirect('login');
        }

        $kategoris = Kategori::all();
        return view('cart', ['kategoris' => $kategoris]);
    }

    public function hapus($idmenu)
    {
        $cart = session()->get('cart');
        if (isset($cart[$idmenu])) {
            unset($cart[$idmenu]);
            session()->put('cart', $cart);
        }

        return redirect('cart');
    }

    public function batal()
    {
        session()->forget('cart');
        return redirect('/');

    }

    public function tambah($idmenu)
    {
        $cart = session()->get('cart');
        $cart[$idmenu]['jumlah']++;
        session()->put('cart', $cart);
        return redirect('cart');
    }
    public function kurang($idmenu)
    {
        $cart = session()->get('cart');

        if ($cart[$idmenu]['jumlah'] > 1) {
            $cart[$idmenu]['jumlah']--;
            session()->put('cart', $cart);
        } else {
            unset($cart[$idmenu]);
            session()->put('cart', $cart);
        }


        return redirect('cart');
    }

    public function checkout()
{
    $idorder = date('YmdHms');
    $total = 0;

    // Ambil keranjang dari sesi
    $cart = session('cart', []);

    // Pastikan keranjang tidak kosong
    if (empty($cart)) {
        return redirect('cart')->with('error', 'Keranjang Anda kosong.');
    }

    foreach ($cart as $key => $value) {
        // Pastikan $value adalah array dan memiliki kunci yang diperlukan
        if (is_array($value) && isset($value['idmenu'], $value['jumlah'], $value['harga'])) {
            $data = [
                'idorder' => $idorder,
                'idmenu' => $value['idmenu'],
                'jumlah' => $value['jumlah'],
                'hargajual' => $value['harga'],
            ];

            // Hitung total
            $total += $value['jumlah'] * $value['harga'];

            // Simpan detail pesanan
            Orderdetail::create($data);
        } else {
            // Jika data tidak valid, bisa log atau tangani sesuai kebutuhan
            return redirect('cart')->with('error', 'Data keranjang tidak valid.');
        }
    }

    $tanggal = date('Y-m-d');
    $data = [
        'idorder' => $idorder,
        'idpelanggan' => session('idpelanggan')['idpelanggan'] ?? null, // Pastikan idpelanggan ada
        'tglorder' => $tanggal,
        'total' => $total,
        'bayar' => 0,
        'kembali' => 0,
        'status' => 0,
    ];

    // Simpan pesanan
    Order::create($data);

    // Redirect dengan pesan sukses
    return redirect('logout')->with('pesan', 'Pesanan Berhasil Dibuat');
}

}