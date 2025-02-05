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

// Get the loan ID from the AJAX request
$loanId = $_POST['loanId'];

// Fetch the book ID based on the loan ID
$sql = "SELECT Book_id FROM Loans WHERE Loan_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $loanId);
$stmt->execute();
$stmt->bind_result($bookId);
$stmt->fetch();
$stmt->close();

// Check if the book ID was found
if (!$bookId) {
    echo json_encode(['status' => 'error', 'message' => 'Peminjaman tidak ditemukan.']);
    exit;
}

// Update the available copies in the Books table
$sql = "UPDATE Books SET stock = stock + 1 WHERE Book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);
$stmt->execute();

// Delete the loan record from the Loans table
$sql = "DELETE FROM Loans WHERE Loan_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $loanId);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Buku berhasil dikembalikan!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>