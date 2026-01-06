<?php
session_start();
// Cek apakah punya token. Jika tidak, tendang ke login
if (!isset($_SESSION['token'])) {
    header('Location: login.php');
    exit;
}

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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kota - AuthCRUD System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Background Slideshow */
        .slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 300%;
            height: 100%;
            display: flex;
            animation: slide 15s ease-in-out infinite;
            z-index: -2;
        }

        .slideshow .slide {
            width: 100vw;
            height: 100%;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }

        .slide:nth-child(1) {
            background-image: url('assets/images/borobudur.jpeg');
        }

        .slide:nth-child(2) {
            background-image: url('assets/images/kota-jogja.png');
        }

        .slide:nth-child(3) {
            background-image: url('assets/images/kota-lama-semarang.jpg');
        }

        @keyframes slide {

            0%,
            25% {
                transform: translateX(0);
            }

            30%,
            55% {
                transform: translateX(-100vw);
            }

            60%,
            85% {
                transform: translateX(-200vw);
            }

            90%,
            100% {
                transform: translateX(0);
            }
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        /* Glass Card */
        .card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.1) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px 20px 0 0 !important;
        }

        .card-header h4 {
            color: #ffffff;
        }

        .card-header h4 i {
            color: #ffffff !important;
        }

        .card-body {
            background: transparent;
            padding: 0;
        }

        .table-responsive {
            background: transparent;
        }

        .card-footer {
            background: rgba(255, 255, 255, 0.1) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8) !important;
            border-radius: 0 0 20px 20px !important;
        }

        /* Glass Table */
        .table {
            color: #ffffff;
            background: transparent !important;
            margin-bottom: 0;
        }

        .table thead th {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff;
            border: none;
            backdrop-filter: blur(10px);
            padding: 15px;
        }

        .table tbody {
            background: transparent !important;
        }

        .table tbody tr {
            background: rgba(255, 255, 255, 0.08) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .table td {
            border: none;
            color: #ffffff;
            padding: 15px;
            background: transparent !important;
        }

        .table-hover>tbody>tr:hover>* {
            background: transparent !important;
            color: #ffffff;
        }

        .badge.bg-secondary {
            background: rgba(255, 255, 255, 0.3) !important;
        }

        .badge.bg-info {
            background: rgba(59, 130, 246, 0.5) !important;
        }

        /* Buttons */
        .btn-primary {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: rgba(255, 255, 255, 0.5);
            color: #ffffff;
        }

        .btn-warning {
            background: rgba(234, 179, 8, 0.6);
            border: 1px solid rgba(234, 179, 8, 0.8);
            color: #ffffff;
        }

        .btn-warning:hover {
            background: rgba(234, 179, 8, 0.8);
            color: #ffffff;
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.6);
            border: 1px solid rgba(239, 68, 68, 0.8);
            color: #ffffff;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.8);
            color: #ffffff;
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 14px;
        }

        /* Empty State */
        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* Footer */
        footer {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>
    <!-- Background Slideshow -->
    <div class="slideshow">
        <div class="slide"></div>
        <div class="slide"></div>
        <div class="slide"></div>
    </div>
    <div class="overlay"></div>

    <?php include 'components/navbar.php'; ?>

    <!-- Main Content -->
    <div class="container">
        <div class="card">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-building me-2"></i>Data Kota
                    </h4>
                    <a href="tambah_kota.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Kota Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="rounded-start">ID</th>
                                <th>Nama Kota</th>
                                <th>ID Propinsi</th>
                                <th class="rounded-end text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($kota)): ?>
                                <?php foreach ($kota as $k): ?>
                                    <tr>
                                        <td><span class="badge bg-secondary"><?= $k['id']; ?></span></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($k['nama_kota']); ?></td>
                                        <td><span class="badge bg-info"><?= $k['propinsi_id']; ?></span></td>
                                        <td class="text-center">
                                            <a href="edit_kota.php?id=<?= $k['id']; ?>" class="btn btn-warning btn-action me-1">
                                                <i class="bi bi-pencil-square"></i> Ubah
                                            </a>
                                            <a href="hapus_kota.php?id=<?= $k['id']; ?>" class="btn btn-danger btn-action" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="bi bi-inbox" style="font-size: 48px; color: #ccc;"></i>
                                        <p class="text-muted mt-2 mb-0">Belum ada data kota.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <small><i class="bi bi-info-circle me-1"></i>Total: <?= is_array($kota) ? count($kota) : 0 ?> data kota</small>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 mt-4">
        <small class="text-muted">&copy; 2026 Dashboard KotaKu. All rights reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>