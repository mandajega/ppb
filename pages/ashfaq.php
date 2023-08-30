<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momandme";

// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Function to escape and sanitize input
function sanitize_input($input, $conn) {
    return $conn->real_escape_string($input);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $date = sanitize_input($_POST['date'], $conn);
    $minutes = sanitize_input($_POST['minutes'], $conn);
    $seconds = sanitize_input($_POST['seconds'], $conn);

    // Combine minutes and seconds into "duration"
    $duration = sprintf("%02d:%02d", $minutes, $seconds);

    // Prepare and execute the INSERT statement
    $sql = "INSERT INTO breastfeeding (user_id, date, duration) VALUES ('$user_id','$date', '$duration')";
    if ($conn->query($sql) === TRUE) {
        header("Location: ashfaq.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
