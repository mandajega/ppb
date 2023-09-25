<?php
session_start();

$host = "localhost";  
$username = "root";  
$password = "";  
$database = "momandme";  

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted data
    $entry_date = $_POST["entry_date"];
    $entry_notes = $_POST["entry_notes"];
    
    // Escape the user input to prevent SQL injection
    $entry_date = mysqli_real_escape_string($conn, $entry_date);
    $entry_notes = mysqli_real_escape_string($conn, $entry_notes);

    // Insert the data into the MySQL table
    $sql = "INSERT INTO diary_entries (date, notes) VALUES ('$entry_date', '$entry_notes')";

    if (mysqli_query($conn, $sql)) {
        header("Location: comnote.html"); // Redirect to the notes page or another appropriate page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
