<?php
session_start();
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momandme";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id']) && isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $foodName = $_POST['food_name'];

    // Update or insert the food entry
    $sql = "INSERT INTO babynutrition (user_id, foodType, AmountOfTimestried) 
            VALUES (?, ?, 1) 
            ON DUPLICATE KEY UPDATE AmountOfTimestried = AmountOfTimestried + 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_id, $foodName);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: nutbaby.html");
        exit();
    } else {
        echo "Error recording food.";
    }

    $stmt->close();
}

$conn->close();
?>