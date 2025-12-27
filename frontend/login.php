<?php
session_start();
// Jika sudah login, langsung ke halaman data
if (isset($_SESSION['token'])) { header('Location: tampil_kota.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Akses ke API Login Laravel
    $ch = curl_init('http://127.0.0.1:8000/api/auth/login');
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
<html>
<head><title>Login</title></head>
<body>
    <h2>Login Sistem</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <a href="register.php">Belum punya akun?</a>
</body>
</html>