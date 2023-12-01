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
    $ranNumb = rand($min*10, $max*10)/10;
    return $ranNumb;
};

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION["user_id"];
    $selectallpokemon = "DELETE FROM unlocked_pokemon WHERE user_id = '$userID'";

    $conn->query($selectallpokemon);

    header("Location: pokedex.php?message=");
}

$conn->close();
?>