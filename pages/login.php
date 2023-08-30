<?php
// Replace these variables with your MySQL database credentials
$servername = "localhost";
$username = "root";
$password_db = "";
$database = "momandme";



// Function to redirect to another page
function redirectTo($page) {
    header("Location: $page");
    exit;
}

// Start the session (this should be at the top of every page that uses sessions)
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        // Redirect back to the login page with an error message
        redirectTo("login.html?error=empty_fields");
    }

    // Establish a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a query to validate the credentials
    $stmt = $conn->prepare("SELECT * FROM acclogin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows == 1) {
        // Fetch the user_id from the result
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];
        
        // Set user_id in the session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['login_time'] = time();


        // Redirect to different pages based on user type
        if ($user['type'] === "Plan") {
            redirectTo("planintro.html");
        } elseif ($user['type'] === "Current") {
            redirectTo("firstpage.html");
        } elseif ($user['type'] === "Post") {
            redirectTo("babycare, mothercare selection page.html");
        }
    } else {
        // Credentials are invalid
        // Redirect back to the login page with an error message
        redirectTo("login.html?error=invalid_credentials");
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
