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
    $pokemon = $_POST["pokemon"];
    $pokemonid = $_POST["pokemonid"];
    $pokemontype = $_POST["pokemontype"];
    $pokemonweight = randomWeight(0,10);
    $userID = $_SESSION["user_id"];

    $haspokemon = "SELECT * FROM unlocked_pokemon WHERE pokemon_id = '$pokemonid' AND user_id = '$userID'";

    if ($conn->query($haspokemon)->num_rows == 0) {
        $conn->query("INSERT INTO unlocked_pokemon (user_id, pokemon_id, pokemon_name, pokemon_type, pokemon_weight)
        VALUES ('$userID', '$pokemonid', '$pokemon', '$pokemontype', '$pokemonweight')");

        header("Location:pokedex.php");
    } else {
        $message = "Pokemon already unlocked!";
        header("Location: pokedex.php?message=" . urlencode($message));
    };
}

$conn->close();
?>