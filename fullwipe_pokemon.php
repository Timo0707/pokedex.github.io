<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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

function randomWeight($min, $max) {
    $ranNumb = rand($min*100, $max*100)/100;
    return $ranNumb;
};

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userID = $_SESSION["user_id"];

    $conn->query("DELETE FROM unlocked_pokemon");
    header("Location:pokedex.php");
}

$conn->close();
?>