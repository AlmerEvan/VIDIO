import ListSiswa from "./ListSiswa";

function Siswa() {
    const nama = ["Rizki", "Ahmad", "Fadilah", "Rizky", "Rizal"];

    return (
      <ListSiswa nama={nama} />
    );
  }
  
  export default Siswa;