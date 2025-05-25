<?php
    session_start();
    require_once "dbcontroller.php";
    $db = new DB;

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Cek apakah email terdaftar
        $sql = "SELECT * FROM ibpelanggan WHERE email='$email'";
        $row = $db->getITEM($sql);
        
        if(empty($row)) {
            $error = "Email belum terdaftar! Silakan daftar terlebih dahulu.";
        } else {
            // Cek password
            $sql = "SELECT * FROM ibpelanggan WHERE email='$email' AND password='$password'";
            $row = $db->getITEM($sql);
            
            if(!empty($row)) {
                $_SESSION['pelanggan'] = $row['email'];
                $_SESSION['idpelanggan'] = $row['idpelanggan'];
                header("location: index.php");
            } else {
                $error = "Password salah!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Login Pelanggan</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) : ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>