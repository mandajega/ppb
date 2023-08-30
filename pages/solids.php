<?php

session_start();

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

$user_id = $_SESSION['user_id'];

// Get the data from the form
$foodType = $_POST['foodType'];
$date = $_POST['date'];
$age = $_POST['age'];
$intake = $_POST['amt'];

// Insert the data into the database
$sql = "INSERT INTO solids (user_id, foodType, date, age, amt) VALUES ('$user_id','$foodType', '$date', '$age', '$intake')";

if ($conn->query($sql) === TRUE) {
    header("Location: solids.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>