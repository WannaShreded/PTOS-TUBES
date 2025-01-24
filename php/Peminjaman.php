<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: System/login.php"); // Redirect to login if not logged in
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

// Fetch member name using username from session
$username = $_SESSION['username'];
$sql = "SELECT member_name FROM members WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($memberName);
$stmt->fetch();
$stmt->close();

// Fetch book titles from the database
$bookTitles = [];
$sql = "SELECT title FROM books"; // Assuming 'books' is the table name and 'title' is the column name
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookTitles[] = $row['title'];
    }
}

// Fetch loan records with a limit of 10
$loans = [];
$sql = "SELECT b.title, m.member_name, l.Borrow_Date, l.Return_Date, 
               CASE 
                   WHEN l.Return_Date >= CURDATE() THEN 'Dipinjam' 
                   ELSE 'Dikembalikan' 
               END AS status
        FROM Loans l 
        JOIN Books b ON l.Book_id = b.Book_id 
        JOIN Members m ON l.Member_id = m.Member_id
        LIMIT 100000"; // Limit to 10 records
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $loans[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/perpustakaan/css/style.css">
    <style>
        /* CSS untuk mengatur tinggi tabel dan scrollbar */
        #status-list-container {
            max-height: 540px; /* Atur tinggi maksimum sesuai kebutuhan */
            overflow-y: auto; /* Tambahkan scrollbar vertikal */
        }
        table {
    background-image: url("/perpustakaan/images/bg1.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: top;
    background-color: white;
}
td{
    color: black;
}
th{
    color: black;
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
                    <a class="nav-link btn-nav" href="Buku.php">Daftar Buku</a>
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

<div class="container mt-5 color">
    <h2>Peminjaman Buku</h2>
    <form id="loan-form">
        <div class="form-group">
            <label for="loan-book-title">Judul Buku</label>
            <select class="form-control" id="loan-book-title" required>
                <option value="">Pilih Judul Buku</option>
                <?php foreach ($bookTitles as $title): ?>
                    <option value="<?php echo htmlspecialchars($title); ?>"><?php echo htmlspecialchars($title); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="loan-member-name">Nama Anggota</label>
            <input type="text" class="form-control" id="loan-member-name" value="<?php echo htmlspecialchars($memberName); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="loan-date">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="loan-date" readonly required>
        </div>
        <div class="form-group">
            <label for="return-date">Tanggal Kembali</label>
            <input type="date" class="form-control" id="return-date" readonly required>
        </div>
        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
    </form>

    <h3 class="mt-4">Status Peminjaman Buku</h3>
    <div id="status-list-container">
        <table class="table table-bordered color">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="status-list">
                <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($loan['title']); ?></td>
                        <td><?php echo htmlspecialchars($loan['member_name']); ?></td>
                        <td><?php echo htmlspecialchars($loan['Borrow_Date']); ?></td>
                        <td><?php echo htmlspecialchars($loan['Return_Date']); ?></td>
                        <td><?php echo htmlspecialchars($loan['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="member_area.php" class="btn btn-secondary mt-4">Kembali ke Menu Utama</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Set today's date as the loan date
    const today = new Date().toISOString().split('T')[0];
    $('#loan-date').val(today);

    // Automatically set the return date to 7 days after the loan date
    $('#loan-date').on('change', function() {
        const loanDate = new Date($(this).val());
        loanDate.setDate(loanDate.getDate() + 7); // Set return date to 7 days after loan date
        $('#return-date').val(loanDate.toISOString().split('T')[0]); // Set the return date input
    });

    // Set the return date when the page loads
    const loanDate = new Date(today);
    loanDate.setDate(loanDate.getDate() + 7); // Set return date to 7 days after today's date
    $('#return-date').val(loanDate.toISOString().split('T')[0]); // Set the return date input

    $('#loan-form').on('submit', function(e) {
        e.preventDefault();

        const loanBookTitle = $('#loan-book-title').val();
        const loanMemberName = $('# loan-member-name').val();
        const loanDate = $('#loan-date').val();
        const returnDate = $('#return-date').val();
        const action = 'borrow'; // Set action to 'borrow' for borrowing books

        $.ajax({
            type: 'POST',
            url: 'handle_loan.php',
            data: {
                loanBookTitle: loanBookTitle,
                loanMemberName: loanMemberName,
                loanDate: loanDate,
                returnDate: returnDate,
                action: action // Send action parameter
            },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    // Update the loan status list without refreshing the page
                    updateStatusList(loanBookTitle, loanMemberName, loanDate, returnDate, result.author);
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat memproses permintaan.');
            }
        });
    });
});

// Function to update the loan status list
function updateStatusList(bookTitle, memberName, loanDate, returnDate, author) {
    const statusList = document.getElementById('status-list');
    const row = document.createElement('tr');
    
    // Get today's date
    const today = new Date();
    const returnDateObj = new Date(returnDate);
    
    // Determine the status based on the return date
    const status = returnDateObj >= today ? 'Dipinjam' : 'Dikembalikan';
    
    row.innerHTML = `
        <td>${bookTitle}</td>
        <td>${memberName}</td>
        <td>${loanDate}</td>
        <td>${returnDate}</td>
        <td>${status}</td>
    `;
    statusList.appendChild(row);
}
</script>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>