<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: System/login.php"); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Area</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/perpustakaan/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand" href="member_area.php">
            <img src="/perpustakaan/images/frlg.png" class="logo" alt="Logo Perpustakaan">
            </a>
            <span class="slogan"><b>Lightning The Way To Infinite Learning</b></span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="member_area.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-nav" href="Buku.php">Daftar Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-nav" href="Peminjaman.php">Peminjaman</a>
                    </li>
                    <li class="nav-item active">
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger ml-3" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron text-center py-5 color">
        <h2>Selamat Datang, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>!<br>Selamat Membaca!!</h2>
    </div>

    <div class="container">
        <h2 class="text-center mb-4 color"> <br>Coming Soon</h2>
        <h3 class="text-center mb-4 color">Buku Yang Akan Hadir Di Perpustakaan Ini</h3>
    
        <div id="comingSoonCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/insec.jpg" class="buku" alt="Buku Insecure">
                                    <h5 class="card-title mt-3">Insecure Is My Middle Name</h5>
                                    <p class="card-text">Alvi Syahrin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/sarup.jpg" class="buku" alt="Buku Selalu Ada Ruang Untuk Pulang">
                                    <h5 class="card-title mt-3">Selalu Ada Ruang Untuk Pulang</h5>
                                    <p class="card-text">Karima Ifha</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/aozm.jpg" class="buku" alt="Buku Act of zero money">
                                    <h5 class="card-title mt-3">Act Of (zero) Money</h5>
                                    <p class="card-text">Dinda Delvira</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/sab.jpg" class="buku" alt="Buku Si Anak Badai">
                                    <h5 class="card-title mt-3">Si Anak Badai</h5>
                                    <p class="card-text">Tere Liye</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/kphi.jpg" class="buku " alt="Buku Kita Pergi Hari Ini">
                                    <h5 class="card-title mt-3">Kita Pergi Hari Ini</h5>
                                    <p class="card-text">Ziggy Zezsyazeoviennazabrizkie</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/jttsv.jpg" class="buku" alt="Buku Jouney to the Stanger Village">
                                    <h5 class="card-title mt-3">Jouney To The Stranger Village</h5>
                                    <p class="card-text">Jenny Hermian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/jktpja.jpg" class="buku" alt="Buku Jika Kita Tak Pernah Jadi Apa-apa">
                                    <h5 class="card-title mt-3">Jika Kita Tak Pernah Jadi Apa-Apa</h5>
                                    <p class="card-text">Alvi Syahrin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/lonely.jpg" class="buku" alt="Buku Lonely">
                                    <h5 class="card-title mt-3">Loneliness Is My Bestfriend</h5>
                                    <p class="card-text">Alvi Syahrin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/jktpjc.jpg" class="buku" alt="Buku Jika Kita Tak Pernah Jatuh Cinta">
                                    <h5 class="card-title mt-3">Jika Kita Tak Pernah Jatuh Cinta</h5>
                                    <p class="card-text">Alvi Syahrin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/cntkitlk.jpg" class="buku" alt="Buku Baru 1">
                                    <h5 class="card-title mt-3">Cantik Itu Luka</h5>
                                    <p class="card-text">Eka Kurniawan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/dktnhkm.jpg" class="buku" alt="Buku Baru 2">
                                    <h5 class="card-title mt-3">Dikta & Hukum</h5>
                                    <p class="card-text">Dhia'an Farah</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="card shadow-sm text-center h-100">
                                <div class="card-body">
                                    <img src="/perpustakaan/images/5cm.jpg" class="buku" alt="Buku Baru 3">
                                    <h5 class="card-title mt-3">5 Cm</h5>
                                    <p class="card-text">Donny Dirgantoro</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#comingSoonCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Sebelumnya</span>
            </a>
            <a class="carousel-control-next" href="#comingSoonCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Selanjutnya</span> </a>
        </div>
    </div>

    <footer class="text-center py-4 mt-4">
        <p class="color">&copy; 2025 Fourmation. Semua hak dilindungi.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>