<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h2>Daftar Akun Baru</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nama Lengkap" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="register">Daftar</button>
    </form>
    <a href="login.php">Sudah punya akun? Login</a>

    <?php
    if (isset($_POST['register'])) {
        $url = 'http://127.0.0.1:8000/api/register'; // Endpoint Backend
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        if (isset($result['token'])) {
            echo "<h3 style='color:green;'>Registrasi Berhasil!</h3>";
        } else {
            echo "<h3 style='color:red;'>Registrasi Gagal!</h3>";
        }
    }
    ?>
</body>

</html>