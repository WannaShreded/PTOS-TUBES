<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Database connection
$servername = "localhost"; // Server name
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "LibraryDB"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books from the database
$sql = "SELECT book_id, title, author, genre, stock, status FROM books"; // Adjust the table name and column names as necessary
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/perpustakaan/css/style.css">
    <style>
        /* CSS untuk mengatur tinggi tabel dan scrollbar */
        #book-list-container {
            max-height: 540px;
            /* Atur tinggi maksimum sesuai kebutuhan */
            overflow-y: auto;
            /* Tambahkan scrollbar vertikal */
        }

        table {
    background-image: url("/perpustakaan/images/bg1.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: top;
}



    </style>
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
                        <a class="nav-link btn-nav" href="Peminjaman.php">Peminjaman</a>
                    </li>
                    <li class="nav-item active">
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger ml-3" href="/perpustakaan/php/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3 color">
        <h2>Manajemen Buku</h2>
        <input type="text" id="search" placeholder="Cari buku..." class="form-control mb-3">

        <div id="book-list-container">
            <table class="table table-bordered color">
                <thead>
                    <tr>
                        <th>ID BUKU</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Genre</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="book-list">
                    <?php
                    // Batasi hasil menjadi 10 baris
                    $limit = 100000;
                    $offset = 0; // Anda bisa menambahkan logika untuk pagination di sini
                    $query = "SELECT * FROM books LIMIT $limit OFFSET $offset"; // Sesuaikan dengan query Anda
                    $result = $conn->query($query); // Pastikan $conn adalah koneksi database Anda

                    if ($result->num_rows > 0) {
                        // Output data dari setiap baris
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='book-row' data-id='" . htmlspecialchars($row['book_id']) . "'>
                                <td>" . htmlspecialchars($row['book_id']) . "</td>
                                <td>" . htmlspecialchars($row['title']) . "</td>
                                <td>" . htmlspecialchars($row['author']) . "</td>
                                <td>" . htmlspecialchars($row['genre']) . "</td>
                                <td>" . htmlspecialchars($row['stock']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada buku yang ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="member_area.php" class="btn btn-secondary mt-4">Kembali ke Menu Utama</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: 'BukuAJAX.php', // The PHP file that handles the search
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#book-list').empty(); // Clear the current book list
                        if (data.length > 0) {
                            $.each(data, function(index, book) {
                                $('#book-list').append(
                                    "<tr class='book-row' data-id='" + book.book_id + "'>" +
                                    "<td>" + book.book_id + "</td>" +
                                    "<td>" + book.title + "</td>" +
                                    "<td>" + book.author + "</td>" +
                                    "<td>" + book.genre + "</td>" +
                                    "<td>" + book.stock + "</td>" +
                                    "<td>" + book.status + "</td>" +
                                    "</tr>"
                                );
                            });
                        } else {
                            $('#book-list').append("<tr><td colspan='6' class='text-center'>Tidak ada buku yang ditemukan.</td></tr>");
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <footer class="text-center py-4 mt-4">
        <p class="color">&copy; 2025 Fourmation. Semua hak dilindungi.</p>
    </footer>
</body>

</html>

<?php
$conn->close(); // Close the database connection
?>