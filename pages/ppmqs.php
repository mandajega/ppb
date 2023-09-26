<?php

// Start a session (if not already started)


// Database connection details
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

session_start();

function sanitize_input($input, $conn){
    return $conn->real_escape_string($input);

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user_id from the session
    $user_id = $_SESSION["user_id"];
    
    // Retrieve the form data
    $gender = sanitize_input($_POST["gender"], $conn);
    $name = sanitize_input($_POST["name"], $conn);
    $dd = sanitize_input($_POST["dd"], $conn);
    $mm = sanitize_input($_POST["mm"], $conn);
    $yyyy = sanitize_input($_POST["yyyy"], $conn);
    $weight = sanitize_input($_POST["weight"], $conn);

    $date_of_birth = $yyyy . "-" . $mm . "-" . $dd;
    $sql_postpartumquestions = "INSERT INTO postpartumquestions (user_id, gender, name, date_of_birth, weight) VALUES ('$user_id','$gender', '$name', '$date_of_birth','$weight')";
    if ($conn->query($sql_postpartumquestions) === TRUE){
        header("Location: intro.html");
        exit();
    } else {
        echo "Error inserting data.";
    }
}
    // Close the database connection
    
    $conn->close();


?>
