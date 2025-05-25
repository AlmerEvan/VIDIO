<h3>Insert User</h3>

<?php 
    $error = "";
    if(isset($_POST['simpan'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi = $_POST['konfirmasi'];
        $level = $_POST['level'];

        if($password === $konfirmasi) {
            $password = hash('sha256', $password);
            $sql = "INSERT INTO ibuser VALUES (NULL, '$username', '$email', '$password', '$level', 1)";
            $db->runSQL($sql);
            header("location:?f=user&m=select");
        } else {
            $error = "Password tidak sama dengan konfirmasi password!";
        }
    }
?>

<div class="">
    <?php if($error !== "") : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3 w-50">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" required class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
            <input type="password" name="konfirmasi" required class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="level" class="form-label">Level</label>
            <select name="level" required class="form-control">
                <option value="admin">Admin</option>
                <option value="koki">Koki</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>
        <div>
            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
        </div>
    </form>
</div>