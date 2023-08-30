<?php
// Start session
session_start();

// Database connection details
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

if (isset($_POST['submit'])) {
    // Get user_id from session

    $date = $_POST['date'];
    $hours = $_POST['hours'];

    // Calculate quality and remark based on hours of sleep
    if ($hours >= 8) {
        $quality = 5; // Excellent
        $remark = "Excellent";
    } elseif ($hours >= 7) {
        $quality = 4; // Good
        $remark = "Good";
    } elseif ($hours >= 6) {
        $quality = 3; // Fair
        $remark = "Fair";
    } elseif ($hours >= 5) {
        $quality = 2; // Poor
        $remark = "Poor";
    } else {
        $quality = 1; // Very Poor
        $remark = "Very Poor";
    }

    // Insert data into the database
    $sql = "INSERT INTO babysleeptracker (user_id, date, hoursSlept, quality) VALUES ('$user_id','$date', '$hours', '$remark')";

    if ($conn->query($sql) === TRUE) {
        header("Location: babysleepTrack.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
