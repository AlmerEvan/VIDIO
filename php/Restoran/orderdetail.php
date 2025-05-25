<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "dbcontroller.php";
$db = new DB;

if (!isset($_SESSION['pelanggan'])) {
    header("location: login.php");
}

if (!isset($_GET['id'])) {
    header("location: histori.php");
}

$idorder = $_GET['id'];
$idpelanggan = $_SESSION['idpelanggan'];

// Verifikasi order milik pelanggan yang login
$sql = "SELECT * FROM iborder WHERE idorder = $idorder AND idpelanggan = $idpelanggan";
$order = $db->getITEM($sql);

if (empty($order)) {
    header("location: histori.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Detail Order</h2>
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Informasi Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Tanggal Order:</strong> <?= date('d-m-Y H:i:s', strtotime($order['tglorder'])) ?></p>
                                <p><strong>Status:</strong> 
                                    <?php
                                    if ($order['status'] == 0) {
                                        echo "<span class='badge bg-warning'>Belum Bayar</span>";
                                    } elseif ($order['status'] == 1) {
                                        echo "<span class='badge bg-success'>Sudah Bayar</span>";
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-6 text-end">
                                <p><strong>Total:</strong> Rp. <?= number_format($order['total']) ?></p>
                                <?php if ($order['status'] == 1) : ?>
                                    <p><strong>Bayar:</strong> Rp. <?= number_format($order['bayar']) ?></p>
                                    <p><strong>Kembali:</strong> Rp. <?= number_format($order['kembali']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Detail Menu</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT od.*, m.menu 
                                        FROM iborderdetail od 
                                        INNER JOIN ibmenu m ON od.idmenu = m.idmenu 
                                        WHERE od.idorder = $idorder";
                                $result = $db->getALL($sql);
                                $no = 1;
                                
                                if (!empty($result)) {
                                    foreach ($result as $row) :
                                        $total = $row['jumlah'] * $row['hargajual'];
                                ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['menu'] ?></td>
                                            <td>Rp. <?= number_format($row['hargajual']) ?></td>
                                            <td><?= $row['jumlah'] ?></td>
                                            <td>Rp. <?= number_format($total) ?></td>
                                        </tr>
                                <?php
                                    endforeach;
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>Tidak ada detail order</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        <div class="mt-3">
                            <a href="histori.php" class="btn btn-primary">Kembali ke Histori</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>