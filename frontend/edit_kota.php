<?php
session_start();
if (!isset($_SESSION['token'])) { header('Location: login.php'); exit; }

$token = $_SESSION['token'];
$id = $_GET['id']; // Ambil ID dari URL

// 1. AMBIL DATA LAMA (GET)
$ch = curl_init("http://127.0.0.1:8000/api/kota/$id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
$response = curl_exec($ch);
curl_close($ch);
$dataLama = json_decode($response, true);

// 2. PROSES UPDATE (PUT)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataBaru = [
        'nama_kota' => $_POST['nama_kota'],
        'propinsi_id' => $_POST['propinsi_id']
    ];

    $ch = curl_init("http://127.0.0.1:8000/api/kota/$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Ganti Method jadi PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataBaru));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);
    
    $res = curl_exec($ch);
    curl_close($ch);
    header('Location: tampil_kota.php');
}
?>

<h3>Ubah Data Kota</h3>
<form method="POST">
    Nama Kota: <input type="text" name="nama_kota" value="<?= $dataLama['nama_kota'] ?? '' ?>"><br>
    ID Propinsi: <input type="number" name="propinsi_id" value="<?= $dataLama['propinsi_id'] ?? '' ?>"><br>
    <button type="submit">Update</button>
    <a href="tampil_kota.php">Batal</a>
</form>