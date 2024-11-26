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
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobileno'];
    $area_of_experience = $_POST['Area'];
    $why_cinevox = $_POST['why'];

    // SQL Query to insert data
    $sql = "INSERT INTO users (name, email, mobile_no, area_of_experience, why_cinevox) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $mobile_no, $area_of_experience, $why_cinevox);

    // Execute statement and check for errors
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
