<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "dbcontroller.php";
$db = new DB;

if (!isset($_SESSION['pelanggan'])) {
    header("location: login.php");
}

$idpelanggan = $_SESSION['idpelanggan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pembelian</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Histori Pembelian</h2>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Order</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM iborder WHERE idpelanggan = $idpelanggan ORDER BY tglorder DESC";
                        $result = $db->getALL($sql);
                        $no = 1;
                        
                        if (!empty($result)) {
                            foreach ($result as $row) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($row['tglorder'])) ?></td>
                                <td>Rp. <?= number_format($row['total']) ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 0) {
                                        echo "<span class='badge bg-warning'>Belum Bayar</span>";
                                    } elseif ($row['status'] == 1) {
                                        echo "<span class='badge bg-success'>Sudah Bayar</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="orderdetail.php?id=<?= $row['idorder'] ?>" 
                                       class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php
                            endforeach;
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Belum ada histori pembelian</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary">Kembali ke Menu</a>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>