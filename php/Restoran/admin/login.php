<?php 
    session_start();
    require_once "../dbcontroller.php";
    $db = new DB;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Restoran</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4 mx-auto">
                <div class="text-center">
                    <h2>Login Restoran</h2>
                </div>

                <?php 
                    if(isset($_POST['login'])) {
                        $email = $_POST['email'];
                        $password = hash('sha256', $_POST['password']);

                        $sql = "SELECT * FROM ibuser WHERE email='$email' AND password='$password' AND aktif=1";
                        $count = $db->rowCOUNT($sql);

                        if($count == 0) {
                            echo "<div class='alert alert-danger'>Email atau Password Salah</div>";
                        } else {
                            $sql = "SELECT * FROM ibuser WHERE email='$email' AND password='$password' AND aktif=1";
                            $row = $db->getITEM($sql);

                            $_SESSION['user'] = $row['email'];
                            $_SESSION['level'] = $row['level'];
                            $_SESSION['iduser'] = $row['iduser'];

                            header("location:index.php");
                        }
                    }
                ?>

                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" required class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>