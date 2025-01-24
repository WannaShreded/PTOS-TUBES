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

// Get the search term
$searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare and execute SQL statement
$sql = "SELECT book_id, title, author, genre, stock, status FROM books WHERE title LIKE ? OR author LIKE ?";
$stmt = $conn->prepare($sql);
$likeTerm = "%" . $searchTerm . "%";
$stmt->bind_param("ss", $likeTerm, $likeTerm);
$stmt->execute();
$result = $stmt->get_result();

// Prepare the response
$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($books);

$stmt->close();
$conn->close();
?>