import '../App.css';
import logo from '../logo.svg';

function Home() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <h1>Selamat Datang</h1>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Pelajari React
        </a>
      </header>
    </div>
  );
}

export default Home;