<?php
session_start();
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

    echo"Password: "."$password";
    echo"<br>Username: "."$username";

    // Validate credentials
    $sql = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        $sql = "SELECT * FROM accounts WHERE password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Successful login

            $_SESSION["user_id"] = $row["ID"];

            echo "<br>Login successful! Redirecting...";
            header("Location:pokedex.php");
        } else {
            // Invalid password
            echo "<br>Invalid password";
        }
    } else {
        // Invalid username
        echo "<br>Invalid username";
    }
}

$conn->close();
?>
