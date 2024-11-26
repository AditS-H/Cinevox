<?php
// Database connection
$host = "localhost"; // Change as needed
$dbname = "cinevox"; // Your database name
$username = "root"; // Your MySQL username
$password = "BESTADIT23@"; // Your MySQL password

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Validate inputs
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // SQL Query to insert data
        $sql = "INSERT INTO register (name, email) VALUES (?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $name, $email); // Corrected to match two parameters

            // Execute statement and check for success
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    } else {
        echo "Please provide a valid name and email.";
    }
}

// Close the connection
$conn->close();
?>
