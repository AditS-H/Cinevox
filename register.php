<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$dbname = "cinevox";
$username = "root";
$password = "BESTADIT23@";

$conn = new mysqli($host, $username, $password, $dbname);

// Enable MySQL error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Debug input values
    echo "Debug: Name - $name, Email - $email";

    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO register (name, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing the statement: " . $conn->error);
        }

        $stmt->bind_param("ss", $name, $email);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid input. Please provide a valid name and email.";
    }
}

$conn->close();
?>
