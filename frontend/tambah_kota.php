<?php
session_start();
if (!isset($_SESSION['token'])) { header('Location: login.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_SESSION['token'];
    $data = [
        'nama_kota' => $_POST['nama_kota'],
        'propinsi_id' => $_POST['propinsi_id']
    ];

    $ch = curl_init('http://127.0.0.1:8000/api/kota');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); // Method POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 || $httpCode == 201) {
        header('Location: tampil_kota.php');
    } else {
        echo "Gagal menambah data.";
    }
}
?>

<h3>Tambah Kota</h3>
<form method="POST">
    Nama Kota: <input type="text" name="nama_kota" required><br>
    ID Propinsi: <input type="number" name="propinsi_id" required><br>
    <button type="submit">Simpan</button>
    <a href="tampil_kota.php">Batal</a>
</form>