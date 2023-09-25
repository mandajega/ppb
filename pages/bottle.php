<?php

//Start session
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize it
  

    if ($ingredient == "option1") {
        $ingredient_label = "Breast Milk";
    } elseif ($ingredient == "option2") {
        $ingredient_label = "Formula";
    } elseif ($ingredient == "option3") {
        $ingredient_label = "Others";
    } else {
        $ingredient_label = "Unknown";
    }

    $duration = sprintf("%02d:%02d", $minutes, $seconds);

    // SQL query to insert data into the table
    $sql = "INSERT INTO bottlefeeding (user_id, ingredient, amt, date, duration)
            VALUES ('$user_id','$ingredient_label', '$amount', '$date', '$duration')";

    if ($conn->query($sql) === TRUE) {
        header("Location: bottle.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
