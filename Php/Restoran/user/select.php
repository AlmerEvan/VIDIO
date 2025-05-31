<div class="float-start me-4">
    <a class="btn btn-primary" href="?f=user&m=insert" role="button">TAMBAH DATA</a>
</div>

<?php 
    $jumlahdata = $db->rowCOUNT("SELECT iduser FROM ibuser");
    $banyak = 4;

    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM ibuser ORDER BY username ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<h3>User</h3>

<table class="table table-bordered w-70">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <tr>
            <?php 
                if ($r['aktif'] == 1) {
                    $status = "Aktif";
                } else {
                    $status = "Banned";
                }
            ?>
            <td><?php echo $no++ ?></td>
            <td><?php echo $r['username'] ?></td>
            <td><a href="?f=user&m=updateuser&id=<?php echo $r['iduser'] ?>"><?php echo $r['email'] ?></a></td>
            <td><?php echo $r['level'] ?></td>
            <td><a href="?f=user&m=delete&id=<?php echo $r['iduser'] ?>">Delete</a></td>
            <td><a href="?f=user&m=update&id=<?php echo $r['iduser'] ?>"><?php echo $status ?></a></td>
        </tr>
        <?php endforeach; ?>
        <?php } ?>
    </tbody>
</table>

<?php 
    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a href="?f=user&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }
?>