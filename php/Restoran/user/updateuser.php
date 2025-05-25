<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM ibuser WHERE iduser=$id";
        $row = $db->getITEM($sql);
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $level = $_POST['level'];
        $password = $_POST['password'];

        if ($password !== "") {
            $password = hash('sha256', $password);
            $sql = "UPDATE ibuser SET username='$username', email='$email', password='$password', level='$level' WHERE iduser=$id";
        } else {
            $sql = "UPDATE ibuser SET username='$username', email='$email', level='$level' WHERE iduser=$id";
        }
        
        $db->runSQL($sql);
        header("location:?f=user&m=select");
    }
?>

<h3>Update User</h3>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50 mt-3">
            <label for="">Username</label>
            <input type="text" name="username" required value="<?php echo $row['username'] ?>" class="form-control">
        </div>
        <div class="form-group w-50 mt-3">
            <label for="">Email</label>
            <input type="email" name="email" required value="<?php echo $row['email'] ?>" class="form-control">
        </div>
        <div class="form-group w-50 mt-3">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control">
            <span class="text-info">*Kosongkan password jika tidak ingin mengubah password</span>
        </div>
        <div class="form-group w-50 mt-3">
            <label for="">Level</label>
            <select name="level" class="form-control">
                <option value="admin" <?php echo ($row['level']==='admin')?'selected':'' ?>>admin</option>
                <option value="koki" <?php echo ($row['level']==='koki')?'selected':'' ?>>koki</option>
                <option value="kasir" <?php echo ($row['level']==='kasir')?'selected':'' ?>>kasir</option>
            </select>
        </div>
        <div class="form-group w-50 mt-3">
            <input type="hidden" name="id" value="<?php echo $row['iduser'] ?>">
            <input type="submit" name="update" value="UPDATE" class="btn btn-primary">
        </div>
    </form>
</div>