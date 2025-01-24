<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure all fields are set
    $memberName = $_POST['member-name'] ?? '';
    $address = $_POST['member-address'] ?? '';
    $birthdate = $_POST['member-birthdate'] ?? '';
    $phone = $_POST['member-phone'] ?? '';
    $email = $_POST['member-email'] ?? '';
    $job = $_POST['member-job'] ?? '';
    $gender = $_POST['member-gender'] ?? '';
    $password = $_POST['member-password'] ?? '';
    $username = $_POST['member-usn'] ?? '';

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO members (member_name, address, birthdate, phone, email, job, gender, password, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    // Bind parameters (s = string, i = integer, d = double, b = blob)
    $stmt->bind_param("sssssssss", $memberName, $address, $birthdate, $phone, $email, $job, $gender, $password, $username);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to login.php after successful registration
        header("Location: login.php");
        exit; // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>