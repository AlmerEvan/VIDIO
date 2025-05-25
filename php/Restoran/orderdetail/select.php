<?php 
    $jumlahdata = $db->rowCOUNT("SELECT idorderdetail FROM iborderdetail");
    $banyak = 3;

    $halaman =  ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else{
        $mulai = 0;
    }

    $sql = "SELECT od.*, o.tglorder, p.nama as pelanggan, p.alamat, m.menu, m.harga 
            FROM iborderdetail od
            JOIN iborder o ON od.idorder = o.idorder
            JOIN ibpelanggan p ON o.idpelanggan = p.idpelanggan
            JOIN ibmenu m ON od.idmenu = m.idmenu
            ORDER BY od.idorderdetail DESC LIMIT $mulai, $banyak";

    if (isset($_POST['simpan'])) {
        $tawal = $_POST['tawal'];
        $takhir = $_POST['takhir'];
        $sql = "SELECT od.*, o.tglorder, p.nama as pelanggan, p.alamat, m.menu, m.harga 
                FROM iborderdetail od
                JOIN iborder o ON od.idorder = o.idorder
                JOIN ibpelanggan p ON o.idpelanggan = p.idpelanggan
                JOIN ibmenu m ON od.idmenu = m.idmenu
                WHERE o.tglorder BETWEEN '$tawal' AND '$takhir' 
                ORDER BY od.idorderdetail DESC"; // Added ORDER BY for consistency
    }

    $row = $db->getALL($sql);

    $no = 1+$mulai;
    $total = 0;

?>

<h3>Detail Pembelian</h3>
<div class="">
    <form action="" method="post">
        <div class="row mb-3 align-items-end">
            <div class="col-md-4">
                <label for="" class="form-label">Tanggal Awal</label>
                <input type="date" name="tawal" required class="form-control">
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Tanggal Akhir</label>
                <input type="date" name="takhir" required class="form-control">
            </div>
            <div class="col-md-4">
                <input type="submit" name="simpan" value="Cari" class="btn btn-primary w-60">
            </div>
        </div>
    </form>
</div>

<table class="table table-bordered w-70">
    <thead>
        <tr>
            <th>No</th>
            <th>pelanggan</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['pelanggan'] ?></td>
            <td><?= $r['tglorder'] ?></td>
            <td><?= $r['menu'] ?></td>
            <td><?= $r['harga'] ?></td>
            <td><?= $r['jumlah'] ?></td>
            <td><?= $r['jumlah'] * $r['harga'] ?></td>
            <td><?= $r['alamat'] ?></td>

            <?php 
                $total = $total + ($r['jumlah'] * $r['harga']);
            ?>
        </tr>
        <?php endforeach; ?>
        <?php }?>
        <tr>
            <td colspan="6"><h4>Grand Total</h4></td>
            <td><?= $total ?></td>
        </tr>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman ; $i++) { 
    echo '<a href="?f=orderdetail&m=select&p='.$i.'">'.$i.'</a>';
    echo '&nbsp &nbsp &nbsp';
    }

?>