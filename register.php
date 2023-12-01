<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "A5XDup=f>rNi3sn";
$dbname = "pokedex";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate credentials
    $sql = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Username already exists";
        echo"<br><a href='index.php'>Return to login page</a>";
    } else {
        $addAccount = $conn->query("INSERT INTO accounts (username, email, password, ID)
        VALUES ('$username', NULL, '$password', NULL)");
        echo"Successfully registered!";
        echo"<br><a href='index.php'>Return to login page</a>";
    }
}

$conn->close();
?>
