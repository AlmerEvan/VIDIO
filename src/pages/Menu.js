import '../App.css';
import './Menu.css';
import { useState } from 'react';
import Table from './Table';

function Menu() {
  const [selectedKategori, setSelectedKategori] = useState('Semua');
  const [menus] = useState([
    { id: 1, nama: 'Nasi Goreng', kategori: 'Makanan', harga: 25000 },
    { id: 2, nama: 'Mie Goreng', kategori: 'Makanan', harga: 22000 },
    { id: 3, nama: 'Sate Ayam', kategori: 'Makanan', harga: 30000 },
    { id: 4, nama: 'Es Teh', kategori: 'Minuman', harga: 5000 },
    { id: 5, nama: 'Es Jeruk', kategori: 'Minuman', harga: 7000 },
    { id: 6, nama: 'Es Krim Vanilla', kategori: 'Dessert', harga: 15000 },
    { id: 7, nama: 'Pudding Coklat', kategori: 'Dessert', harga: 12000 },
    { id: 8, nama: 'Fruit Parfait', kategori: 'Dessert', harga: 20000 },
  ]);

  const columns = [
    { field: 'nama', header: 'Nama Menu' },
    { field: 'kategori', header: 'Kategori' },
    { 
      field: 'harga', 
      header: 'Harga',
      format: (value) => `Rp ${value.toLocaleString()}`
    }
  ];

  const kategoriList = ['Semua', ...new Set(menus.map(menu => menu.kategori))];

  const filteredMenus = selectedKategori === 'Semua'
    ? menus
    : menus.filter(menu => menu.kategori === selectedKategori);

  return (
    <div className="Menu container mt-4">
      <h1 className="text-center mb-4">Daftar Menu</h1>
      
      <div className="mb-4">
        <select 
          className="form-select w-25 mx-auto"
          value={selectedKategori}
          onChange={(e) => setSelectedKategori(e.target.value)}
        >
          {kategoriList.map(kategori => (
            <option key={kategori} value={kategori}>{kategori}</option>
          ))}
        </select>
      </div>

      <Table data={filteredMenus} columns={columns} />
    </div>
  );
}

export default Menu;