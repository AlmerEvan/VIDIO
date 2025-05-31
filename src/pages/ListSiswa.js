import React from 'react';
import '../App.css';

function ListSiswa(props) {
  return (
    <div className="container mt-4">
      <h2>Daftar Siswa</h2>
      <ul className="list-group">
        {props.nama && props.nama.map((item, index) => (
          <li key={index} className="list-group-item">{item}</li>
        ))}
      </ul>
    </div>
  );
}

export default ListSiswa;