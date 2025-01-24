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

// Get the loan data from the AJAX request
$loanBookTitle = $_POST['loanBookTitle'];
$loanMemberName = $_POST['loanMemberName'];
$loanDate = $_POST['loanDate'];
$returnDate = $_POST['returnDate'];

// Fetch the book ID and available copies based on the title
$sql = "SELECT Book_id, stock FROM Books WHERE Title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loanBookTitle);
$stmt->execute();
$stmt->bind_result($bookId, $stock);
$stmt->fetch();
$stmt->close();

// Check if there are available copies
if ($stock <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada salinan buku yang tersedia.']);
    exit;
}

// Fetch the member ID based on the member name
$sql = "SELECT Member_id FROM Members WHERE member_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loanMemberName);
$stmt->execute();
$stmt->bind_result($memberId);
$stmt->fetch();
$stmt->close();

// Check if the member ID was found
if (!$memberId) {
    echo json_encode(['status' => 'error', 'message' => 'Member tidak ditemukan.']);
    exit;
}

$sql = "SELECT author FROM books WHERE Title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loanBookTitle);
$stmt->execute();
$stmt->bind_result($author);
$stmt->fetch();
$stmt->close();

// Prepare and execute SQL statement to insert loan data
$sql = "INSERT INTO Loans (Book_id, Member_id, Borrow_Date, Return_Date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $bookId, $memberId, $loanDate, $returnDate);

if ($stmt->execute()) {
    // Update the available copies in the Books table
    $newStock = $stock - 1; // Correctly reduce the stock
    $sql = "UPDATE Books SET stock = ? WHERE Book_id = ?"; // Ensure you are updating the correct column
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newStock, $bookId);
    $stmt->execute();
    

    echo json_encode(['status' => 'success', 'message' => 'Peminjaman berhasil!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}


$stmt->close();
$conn->close();
?>