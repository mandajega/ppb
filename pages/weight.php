<?php
session_start();
// Establish a connection to your MySQL database
$host = "localhost";  // Replace with your MySQL host
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$database = "momandme";  // Replace with your MySQL database name

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$lastDate = 'N/A';

$lastWeight = $_SESSION['weight'];



// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted data
    $newWeight = $_POST["new_weight"];
    $newDate = $_POST["new_date"];
    $user_id = $_SESSION["user_id"];

    $weightDifference = $newWeight - $lastWeight;

    // Insert the data into the MySQL table
    $sql = "INSERT INTO babyweighttracker (user_id, weight, date) VALUES ('$user_id','$newWeight', '$newDate')";

    if (mysqli_query($conn, $sql)) {
        header("Location: weight1.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

   
}

$user_id = $_SESSION["user_id"];
$newWeight = $_SESSION["weight"];

// Query to retrieve the latest weight and date for the user
$query = "SELECT weight, date FROM babyweighttracker WHERE user_id = '$user_id' ORDER BY date DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lastWeight = $row['weight'];
    $lastDate = $row['date'];
} else {
    // Default values if no data found
    $lastWeight = 'N/A';
    $lastDate = 'N/A';
}



// Close the database connection
mysqli_close($conn);
?>
<!-- Rest of your HTML code -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight Tracker</title>

    <!--================ style ==================-->
    <link rel="stylesheet" href="../src/css/weight.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="mom&me.jpg" alt="logo">
                        </span>
                        <span class="title1"><h1>Mom & Me</h1></span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="clipboard-outline"></ion-icon>
                        </span>
                        <span class="title">Note</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="call-outline"></ion-icon>
                        </span>
                        <span class="title">Contact</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                  <label>
                    <input type="text" placeholder="Account">
                    <img src="asq.jpg" alt="">
                  </label>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">

                <a href="track.html">
                <div class="back-card">
                    <div>
                        <button class="back-button">Back</button>
                    </div>
                </div>
                </a>
  
                <div class="head-card">
                    <div>
                        <div class="cardName">Weight Tracker</div>
                    </div>
                </div>

            </div>

            <!-- ================ Order Details List ================= -->
            <div class="row">
                <div class="leftcolumn">

                <form method="POST" action="weight1.php">

                  <div class="card">
                    <h2>New Weight</h2>
                    <input class="nw-text" type="text" name="new_weight">
                    <h2>Today Date</h2>
                    <input class="td-text" type="date" name="new_date">
                    <button type="submit">Save</button>
                  </div>

</form>
                  <div class="card">
                    <h2>Last Weight</h2>
                    <input class="lw-text" type="text" name="last_weight" value="<?php echo $lastWeight; ?>" disabled>
                    <h2>Last Date</h2>
                    <input class="ld-text" type="date" name="last_date" value="<?php echo $lastDate; ?>" disabled>
                  </div>

                </div>

                <div class="rightcolumn">

                  <div class="card">
                    <div class="wd">
                        <h2>Weight Difference</h2>
                       
            <input class="wd-text" type="text" name="Weight Difference" value="<?php echo $weightDifference =  $newWeight - $lastWeight; ?>" disabled>
                    </div>

                    

                    <div class="sug">
                        <h3>Suggestion :</h3>
                    </div>
                  </div>

                </div>

              </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../scripts/first.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>