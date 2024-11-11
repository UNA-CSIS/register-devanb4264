<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "softball";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Softball Games</title>
    </head>
    <body>
        <h1>Softball Games</h1>

        <?php
        // Fetch games data from the database
        $sql = "SELECT * FROM games ORDER BY id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // If there are games in the database, display them as a list
            echo "<ul>";
            
            // Loop through each game and display it as a list item
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<strong>ID:</strong> " . $row['id'] . "<br>";
                echo "<strong>Opponent:</strong> " . $row['opponent'] . "<br>";
                echo "<strong>Site:</strong> " . $row['site'] . "<br>";
                echo "<strong>Result:</strong> " . $row['result'] . "<br>";
                echo "</li><hr>";  // Add a horizontal rule between each game
            }

            echo "</ul>";
        } else {
            // If no games are found in the database
            echo "No games found.";
        }

        // Close the database connection
        $conn->close();
        ?>

        <a href="index.php">Home</a>
    </body>
</html>