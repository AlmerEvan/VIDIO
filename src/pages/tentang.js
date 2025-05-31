import '../App.css';
import './Tentang.css';
import { useState } from 'react';

function Tentang() {
  const [counter, setCounter] = useState(0);

  const handleTambah = () => {
    setCounter(counter + 1);
  };

  const handleKurang = () => {
    setCounter(counter - 1);
  };

  return (
    <div className="Tentang">
      <h1>Halaman Tentang</h1>
      <p>Ini adalah halaman yang menjelaskan tentang kami dan visi misi kami</p>
      <div className="counter-container">
        <button type="button" className="btn btn-danger" onClick={handleKurang}>Kurang</button>
        <span className="counter-value">{counter}</span>
        <button type="button" className="btn btn-primary" onClick={handleTambah}>Tambah</button>
      </div>
    </div>
  );
}

export default Tentang;