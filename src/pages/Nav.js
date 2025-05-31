
import '../App.css';
import './Nav.css';
import { Link } from 'react-router-dom';

function Nav() {
  return (
    <nav className="App-nav">
      <ul>
      <Link to="/">Home </Link>
      <Link to="/sejarah">Sejarah </Link>
      <Link to="/tentang">Tentang </Link>
      <Link to="/kontak">Kontak </Link>
      <Link to="/siswa">Siswa </Link>
      <Link to="/menu">Menu </Link>
      </ul>
    </nav>
  );
}

export default Nav;