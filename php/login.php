<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/perpustakaan/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand" href="/perpustakaan/index.html">
                <img src="/perpustakaan/images/frlg.png" class="logo" alt="Logo Perpustakaan">
            </a>
            <span class="slogan">Lightning The Way To Infinite Learning</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-black" href="/perpustakaan/index.html">Beranda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 color">
        <h2 class="text-center">Login</h2>
        <form id="login-form" action="login.php" method="POST">
            <div class="form-group">
                <label class="color" for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-center">
            Belum punya akun? <a href="/Perpustakaan/Anggota.html">Daftar di sini</a>
        </p>
    </div>

    <?php
    // Koneksi ke database
    $servername = "127.0.0.1"; // Ganti dengan server Anda
    $usr = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "LibraryDB"; // Nama database

    // Membuat koneksi
    $conn = new mysqli($servername, $usr, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Proses login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Cek di tabel Members
        $stmt = $conn->prepare("SELECT username, password FROM Members WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc(); // Ambil data pengguna

            // Verify password (assuming passwords are hashed)
            if ($user['password'] === $password) { // Change this to password_verify() if using hashed passwords
                // Login berhasil
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username']; // Simpan member_name di session

                // Redirect ke member area
                echo "<script>
                        window.location.href = 'member_area.php'; // Redirect ke member area
                      </script>";
            } else {
                // Password salah
                echo "<script>alert('Nama anggota atau password salah.');</script>";
            }
        } else {
            // Username tidak ditemukan
            echo "<script>alert('Nama anggota atau password salah.');</script>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>

</html>