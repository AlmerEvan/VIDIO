<?php
session_start();
require_once "dbcontroller.php";
$db = new DB;

if (!isset($_SESSION['pelanggan'])) {
    header("location: login.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM ibkeranjang WHERE idkeranjang = $id";
    $db->runSQL($sql);
}

header("location: keranjang.php");