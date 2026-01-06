<?php
session_start();
if (!isset($_SESSION['token'])) {
    header('Location: login.php');
    exit;
}

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
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataBaru));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);

    $res = curl_exec($ch);
    curl_close($ch);
    header('Location: tampil_kota.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kota - AuthCRUD System</title>
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

        .card-body {
            background: transparent;
        }

        /* Form Styles */
        .form-label {
            color: #ffffff;
            font-weight: 500;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        /* Buttons */
        .btn-warning {
            background: rgba(234, 179, 8, 0.6);
            border: 1px solid rgba(234, 179, 8, 0.8);
            color: #ffffff;
        }

        .btn-warning:hover {
            background: rgba(234, 179, 8, 0.8);
            border-color: rgba(234, 179, 8, 1);
            color: #ffffff;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: #ffffff;
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-3">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i>Ubah Data Kota
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-building me-2"></i>Nama Kota
                                </label>
                                <input type="text" name="nama_kota" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($dataLama['nama_kota'] ?? '') ?>" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt me-2"></i>ID Propinsi
                                </label>
                                <input type="number" name="propinsi_id" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($dataLama['propinsi_id'] ?? '') ?>" required>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="tampil_kota.php" class="btn btn-secondary btn-lg px-4">
                                    <i class="bi bi-x-circle me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-warning btn-lg px-4">
                                    <i class="bi bi-check-circle me-2"></i>Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>