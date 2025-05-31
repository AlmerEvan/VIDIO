<?php 
    session_start();
    require_once "dbcontroller.php";
    $db = new DB;

    if(isset($_POST['register'])) {
        $pelanggan = $_POST['pelanggan'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "INSERT INTO ibpelanggan (pelanggan, alamat, telp, email, password) VALUES ('$pelanggan', '$alamat', '$telp', '$email', '$password')";
        $db->runSQL($sql);
        
        echo "<script>alert('Registrasi berhasil!');</script>";
    }

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM ibpelanggan WHERE email='$email' AND password='$password'";
        $row = $db->getITEM($sql);
        
        if(!empty($row)) {
            $_SESSION['pelanggan'] = $row['email'];
            $_SESSION['idpelanggan'] = $row['idpelanggan'];
            header("location: index.php");
        } else {
            echo "<script>alert('Email atau password salah!');</script>";
        }
    }

    if(isset($_GET['logout'])) {
        session_destroy();
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2><a href="index.php" class="text-decoration-none text-dark">Restoran</a></h2>
            </div>
            <div class="col-md-9">
                <div class="float-end mt-4">
                    <?php if(!isset($_SESSION['pelanggan'])) : ?>
                        <a href="registrasi.php" class = "me-2" >Daftar</a>
                        <a href="login.php">Login</a>
                    <?php else : ?>
                        <?php
                            $idpelanggan = $_SESSION['idpelanggan'];
                            $sql = "SELECT COUNT(*) as total_items FROM ibkeranjang WHERE idpelanggan = $idpelanggan AND status = 0";
                            $result = $db->getITEM($sql);
                            $total_items = $result['total_items'];
                        ?>
                        <a href="keranjang.php" class="me-3 text-decoration-none">
                            <i class="bi bi-cart"></i> Cart (<?php echo $total_items; ?>)
                        </a>
                        <a href="order/select.php" class="me-3 text-decoration-none">
                            <i class="bi bi-clock-history"></i> Histori
                        </a>
                        <span class="me-3">Pelanggan : <?php echo $_SESSION['pelanggan']; ?></span>
                        <a href="?logout=true">Logout</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

          
        <div class="row mt-5">
            <div class="col-md-3">
                <h3 class="mb-4">Kategori</h3>
                <ul class="nav flex-column">
                    <?php 
                        $sql = "SELECT * FROM ibkategori ORDER BY kategori ASC";
                        $row = $db->getALL($sql);

                        if (!empty($row)) {
                            foreach ($row as $r) {
                    ?>
                                <li class="nav-item"><a class="nav-link" href="?id=<?php echo $r['idkategori'] ?>"><?php echo $r['kategori'] ?></a></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?php 
                    if (isset($_GET['id'])) {
                        // Tampilkan menu berdasarkan kategori
                        $sql = "SELECT * FROM ibkategori WHERE idkategori = " . $_GET['id'];
                        $kategori = $db->getALL($sql);

                        if (!empty($kategori)) {
                            foreach ($kategori as $k) {
                ?>
                                <div class="mb-5">
                                    <h3 class="mb-4"><?php echo $k['kategori'] ?></h3>
                                    <div class="row">
                                        <?php 
                                            $sql = "SELECT * FROM ibmenu WHERE idkategori = " . $k['idkategori'];
                                            $menu = $db->getALL($sql);

                                            if (!empty($menu)) {
                                                foreach ($menu as $r) {
                                        ?>
                                                    <div class="col-md-4 mb-4">
                                                        <div class="card">
                                                            <img style="height: 200px; object-fit: cover;" src="upload/<?php echo $r['gambar'] ?>" class="card-img-top" alt="...">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $r['menu'] ?></h5>
                                                                <p class="card-text">Rp. <?php echo number_format($r['harga']) ?></p>
                                                                <?php if(isset($_SESSION['pelanggan'])) : ?>
                                                                    <form action="keranjang.php" method="post">
                                                                        <input type="hidden" name="idmenu" value="<?php echo $r['idmenu'] ?>">
                                                                        <div class="input-group mb-3">
                                                                            <input type="number" name="jumlah" class="form-control" value="1" min="1">
                                                                            <button type="submit" name="tambah" class="btn btn-primary">Beli</button>
                                                                        </div>
                                                                    </form>
                                                                <?php else : ?>
                                                                    <a href="login.php" class="btn btn-primary">Login untuk Membeli</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php
                                                }
                                            } else {
                                                echo "<p>Tidak ada menu dalam kategori ini</p>";
                                            }
                                        ?>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    } else {
                        // Tampilkan semua menu
                        $sql = "SELECT * FROM ibmenu ORDER BY menu ASC";
                        $menu = $db->getALL($sql);
                        
                        if (!empty($menu)) {
                            echo "<h3 class='mb-4'>Daftar Makanan</h3>";
                            echo "<div class='row'>";
                            foreach ($menu as $r) {
        ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img style="height: 200px; object-fit: cover;" src="upload/<?php echo $r['gambar'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $r['menu'] ?></h5>
                                            <p class="card-text">Rp. <?php echo number_format($r['harga']) ?></p>
                                            <?php if(isset($_SESSION['pelanggan'])) : ?>
                                                <form action="keranjang.php" method="post">
                                                    <input type="hidden" name="idmenu" value="<?php echo $r['idmenu'] ?>">
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="jumlah" class="form-control" value="1" min="1">
                                                        <button type="submit" name="tambah" class="btn btn-primary">Beli</button>
                                                    </div>
                                                </form>
                                            <?php else : ?>
                                                <a href="login.php" class="btn btn-primary">Login untuk Membeli</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
        <?php
                            }
                            echo "</div>";
                        } else {
                            echo "<p>Tidak ada menu tersedia</p>";
                        }
                    }
                ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <p class="text-center">2024 - copyright@smkrevit.com</p>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>