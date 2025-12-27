<?php
session_start();
if (!isset($_SESSION['token'])) { header('Location: login.php'); exit; }

if (isset($_GET['id'])) {
    $token = $_SESSION['token'];
    $id = $_GET['id'];

    $ch = curl_init("http://127.0.0.1:8000/api/kota/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Method DELETE
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);

    curl_exec($ch);
    curl_close($ch);

    header('Location: tampil_kota.php');
}
?>