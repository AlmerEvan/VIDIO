<?php 
    session_start();
    require_once "../dbcontroller.php";
    $db = new DB;

    if (!isset($_SESSION['user'])) {
        header("location:login.php");
    }

    if (isset($_GET['log'])) {
        session_destroy();
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2>Admin Page</h2>
            </div>
            <div class="col-md-9">
                <div class="float-end mt-4">
                    <span class="me-3">User : </span>
                    <a href="?f=user&m=updateuser&id=<?php echo $_SESSION['iduser'] ?>" class="me-3"><?php echo $_SESSION['user'] ?></a>
                    <?php if (isset($_SESSION['level'])) : ?>
                        <span class="me-3">Level : <?php echo $_SESSION['level'] ?></span>
                    <?php endif; ?>
                    <a href="?log=logout">logout</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-3">
                <ul class="nav flex-column">
                    <?php 
                        if (isset($_SESSION['level'])) {
                            if ($_SESSION['level'] == 'kasir') {
                                // Tampilkan hanya Order dan Order Detail untuk level kasir
                                echo '<li class="nav-item"><a class="nav-link" href="?f=order&m=select">Order</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>';
                            } elseif ($_SESSION['level'] == 'koki') {
                                // Tampilkan hanya Order Detail untuk level koki
                                echo '<li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>';
                            } else {
                                // Tampilkan semua navigasi untuk level lain
                                echo '<li class="nav-item"><a class="nav-link" href="?f=kategori&m=select">Kategori</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="?f=menu&m=select">Menu</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="?f=pelanggan&m=select">Pelanggan</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="?f=order&m=select">Order</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="?f=user&m=select">User</a></li>';
                            }
                        } else {
                             // Tampilkan semua navigasi jika level tidak diset (fallback)
                            echo '<li class="nav-item"><a class="nav-link" href="?f=kategori&m=select">Kategori</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="?f=menu&m=select">Menu</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="?f=pelanggan&m=select">Pelanggan</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="?f=order&m=select">Order</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="?f=user&m=select">User</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?php 
                    if (isset($_GET['f']) && isset($_GET['m'])) {
                        $f = $_GET['f'];
                        $m = $_GET['m'];

                        $file = '../'.$f.'/'.$m.'.php';
                        require_once $file;
                    }
                ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <p class="text-center">2019 - copyright@smkrevit.com</p>
            </div>
        </div>
    </div>
</body>
</html>