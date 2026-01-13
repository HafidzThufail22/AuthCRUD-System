<?php
session_start();
// Jika sudah login, langsung ke halaman data
if (isset($_SESSION['token'])) {
    header('Location: tampil_kota.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Akses ke API Login Laravel
    $ch = curl_init('http://127.0.0.1:8000/api/login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['email' => $email, 'password' => $password]));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($httpCode == 200 && isset($data['token'])) {
        // SIMPAN TOKEN KE SESSION
        $_SESSION['token'] = $data['token'];
        header('Location: tampil_kota.php');
        exit;
    } else {
        $error = "Login Gagal! Cek email/password.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AuthCRUD System</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Background Slideshow Container */
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

        /* Animasi geser */
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

        /* Overlay gelap - lebih transparan */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: -1;
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-card h2 {
            color: #ffffff;
        }

        .login-card .form-label {
            color: #ffffff;
            font-weight: 500;
        }

        .login-card .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .login-card a {
            color: #ffffff !important;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .login-card .bi-person-circle {
            color: #ffffff !important;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
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

        .btn-primary {
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 12px;
            font-weight: 600;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.35);
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

    <div class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-buildings" style="font-size: 60px; color: #ffffff; text-shadow: 0 0 15px rgba(255,255,255,0.5);"></i>
            <h2 class="mt-3" style="color: #ffffff;">Dashboard KotaKu.</h2>
            <p class="mb-0" style="color: rgba(255,255,255,0.7); font-size: 14px;">Silakan login untuk melanjutkan</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-envelope me-2"></i>Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email" required>
            </div>
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-lock me-2"></i>Password</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </form>

        <div class="text-center mt-3">
            <span class="text-muted">Belum punya akun?</span>
            <a href="register.php" class="text-decoration-none fw-bold" style="color: #2a5298;">Daftar Sekarang</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>