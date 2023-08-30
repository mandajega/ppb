<?php
session_start();
// Replace with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momandme";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $user_id = $_SESSION['user_id'];
    $date = $_POST["date"];
    $poop = isset($_POST["poop"]) ? 1 : 0;
    $wet = isset($_POST["wet"]) ? 1 : 0;
    $notes = $_POST["notes"];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO diaper (user_id, date, poop, wet, Notes) VALUES (?,?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $user_id, $date, $poop, $wet, $notes);
    $stmt->execute();

    // Close statement
    $stmt->close();

header("Location: diaper.html");
exit(); 
}

// Close connection
$conn->close();
?>
