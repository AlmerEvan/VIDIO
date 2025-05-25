<?php 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // First, delete the related menu items
        $sql_menu = "DELETE FROM ibmenu WHERE idkategori = $id";
        $db->runSQL($sql_menu);

        // Then delete the category
        $sql = "DELETE FROM ibkategori WHERE idkategori = $id";
        $db->runSQL($sql);

        header("location:?f=kategori&m=select");
    }
?>