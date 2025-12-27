<?php
session_start();
// Cek apakah punya token. Jika tidak, tendang ke login
if (!isset($_SESSION['token'])) { header('Location: login.php'); exit; }

$token = $_SESSION['token'];

// Ambil data dari API
$ch = curl_init('http://127.0.0.1:8000/api/kota');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]); 
$response = curl_exec($ch);
curl_close($ch);

$kota = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head><title>Data Kota</title></head>
<body>
    <h1>Data Kota</h1>
    <a href="tambah_kota.php">[+] Tambah Kota Baru</a> | <a href="logout.php" style="color:red;">Logout</a>
    <br><br>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kota</th>
                <th>ID Propinsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($kota)): ?>
                <?php foreach ($kota as $k): ?>
                <tr>
                    <td><?= $k['id']; ?></td>
                    <td><?= $k['nama_kota']; ?></td>
                    <td><?= $k['propinsi_id']; ?></td>
                    <td>
                        <a href="edit_kota.php?id=<?= $k['id']; ?>">Ubah</a> | 
                        <a href="hapus_kota.php?id=<?= $k['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Belum ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>