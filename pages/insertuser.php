<?php
// Start a session (if not already started)
session_start();

// Replace these values with your database connection details
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["fullName"];
    $contactNumber = $_POST["contactNumber"];
    $email = $_POST["email"];
    $pword = $_POST["pword"];
    $category = $_POST["radio"]; // Get the selected category
    
    $categoryPrefix = ""; // Initialize an empty prefix
    
    // Determine the prefix based on the selected category
    if ($category === "Plan") {
        $categoryPrefix = "PL";
    } elseif ($category === "Current") {
        $categoryPrefix = "CU";
    } elseif ($category === "Post") {
        $categoryPrefix = "PO";
    }

    if (empty($fullName) || empty($contactNumber) || empty($email) || empty($pword)) {
        // Redirect back to the signup page with an error message
        header("Location: signup.html?error=empty_fields");
        exit();
    }

    // Generate the user ID in the format PL0001, PL0002, ...
    $userQuery = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = 'signup'";
    $result = $conn->query($userQuery);
    $lastAutoIncrement = $result->fetch_assoc()['AUTO_INCREMENT'];
    $newUserId = $categoryPrefix . str_pad($lastAutoIncrement, 4, "0", STR_PAD_LEFT);

    // Store the generated user_id in a session variable
    $_SESSION["user_id"] = $newUserId;

    // Insert data into signup table
    $signupQuery = "INSERT INTO signup (user_id, fullName, contactNumber, email, pword, type) VALUES ('$newUserId', '$fullName', '$contactNumber', '$email', '$pword', '$category')";
    if ($conn->query($signupQuery) === TRUE) {
        // Insert data into acclogin table
        $loginQuery = "INSERT INTO acclogin (user_id, email, password, type) VALUES ('$newUserId', '$email', '$pword', '$category')";
        if ($conn->query($loginQuery) === TRUE) {
           
            if ($category === "Plan") {
                header("Location: planqs.html");
            } elseif ($category === "Current") {
                header("Location: questionset.html");
            } elseif ($category === "Post") {
                header("Location: ppmqs.html");
            }
            exit();  

        } else {
            echo "Error inserting into acclogin table: " . $conn->error;
        }
    } else {
        echo "Error inserting into signup table: " . $conn->error;
    }
}

$conn->close();
?>
