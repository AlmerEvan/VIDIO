<?php
session_start();
require_once "dbcontroller.php";
$db = new DB;

if (!isset($_SESSION['pelanggan'])) {
    header("location: login.php");
}

// Proses tambah ke keranjang
if (isset($_POST['tambah'])) {
    $idmenu = $_POST['idmenu'];
    $jumlah = $_POST['jumlah'];
    $idpelanggan = $_SESSION['idpelanggan'];
    
    // Ambil harga menu
    $sql = "SELECT * FROM ibmenu WHERE idmenu = $idmenu";
    $menu = $db->getITEM($sql);
    $harga = $menu['harga'];
    $total = $jumlah * $harga;
    
    $sql = "INSERT INTO ibkeranjang (idmenu, idpelanggan, jumlah, harga, total) 
            VALUES ($idmenu, $idpelanggan, $jumlah, $harga, $total)";
    $db->runSQL($sql);
    
    header("location: keranjang.php");
}

// Proses checkout
if (isset($_POST['checkout'])) {
    $idpelanggan = $_SESSION['idpelanggan'];
    
    // 1. Insert ke tabel iborder
    $sql = "INSERT INTO iborder (idpelanggan, tglorder, total, bayar, kembali, status)
            SELECT $idpelanggan, NOW(), SUM(total), SUM(total), 0, 0
            FROM ibkeranjang
            WHERE idpelanggan = $idpelanggan AND status = 0";
    $db->runSQL($sql);
    
    // 2. Ambil ID order yang baru dibuat
    $sql = "SELECT MAX(idorder) as idorder FROM iborder WHERE idpelanggan = $idpelanggan";
    $row = $db->getITEM($sql);
    $idorder = $row['idorder'];
    
    // 3. Insert ke tabel iborderdetail
    $sql = "INSERT INTO iborderdetail (idorder, idmenu, jumlah, hargajual)
            SELECT $idorder, idmenu, jumlah, harga
            FROM ibkeranjang
            WHERE idpelanggan = $idpelanggan AND status = 0";
    $db->runSQL($sql);
    
    // 4. Update status keranjang
    $sql = "UPDATE ibkeranjang SET status = 1 WHERE idpelanggan = $idpelanggan AND status = 0";
    $db->runSQL($sql);
    
    header("location: index.php");
}

// Proses update jumlah
if (isset($_POST['update_jumlah'])) {
    $idkeranjang = $_POST['idkeranjang'];
    $jumlah = $_POST['jumlah'];
    
    // Update jumlah dan total
    $sql = "SELECT harga FROM ibkeranjang WHERE idkeranjang = $idkeranjang";
    $item = $db->getITEM($sql);
    $total = $jumlah * $item['harga'];
    
    $sql = "UPDATE ibkeranjang SET jumlah = $jumlah, total = $total WHERE idkeranjang = $idkeranjang";
    $db->runSQL($sql);
    
    header("location: keranjang.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Keranjang Belanja</h2>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $idpelanggan = $_SESSION['idpelanggan'];
                        $sql = "SELECT ibkeranjang.*, ibmenu.menu 
                                FROM ibkeranjang 
                                INNER JOIN ibmenu ON ibkeranjang.idmenu = ibmenu.idmenu 
                                WHERE idpelanggan = $idpelanggan AND status = 0";
                        $result = $db->getALL($sql);
                        $no = 1;
                        $grandTotal = 0;
                        
                        if (!empty($result)) {
                            foreach ($result as $row) :
                                $grandTotal += $row['total'];
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['menu'] ?></td>
                                <!-- Dalam bagian tabel, ganti kolom jumlah dengan: -->
                                <td>
                                    <form action="" method="post" class="d-flex align-items-center">
                                        <input type="hidden" name="idkeranjang" value="<?= $row['idkeranjang'] ?>">
                                        <button type="submit" name="update_jumlah" class="btn btn-sm btn-secondary me-2" 
                                                onclick="document.getElementById('jumlah_<?= $row['idkeranjang'] ?>').value--">
                                            -
                                        </button>
                                        <input type="number" id="jumlah_<?= $row['idkeranjang'] ?>" name="jumlah" 
                                               value="<?= $row['jumlah'] ?>" min="1" class="form-control form-control-sm mx-2" 
                                               style="width: 60px;" onchange="this.form.submit()">
                                        <button type="submit" name="update_jumlah" class="btn btn-sm btn-secondary ms-2" 
                                                onclick="document.getElementById('jumlah_<?= $row['idkeranjang'] ?>').value++">
                                            +
                                        </button>
                                    </form>
                                </td>
                                <td>Rp. <?= number_format($row['harga']) ?></td>
                                <td>Rp. <?= number_format($row['total']) ?></td>
                                <td>
                                    <a href="hapus_keranjang.php?id=<?= $row['idkeranjang'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                            endforeach;
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Keranjang belanja kosong</td></tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                            <td colspan="2">Rp. <?= number_format($grandTotal) ?></td>
                        </tr>
                    </tfoot>
                </table>
                
                <?php if (!empty($result)) : ?>
                <div class="text-end mt-3">
                    <form action="" method="post">
                        <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
                    </form>
                </div>
                <?php endif; ?>
                
                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary">Kembali ke Menu</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>