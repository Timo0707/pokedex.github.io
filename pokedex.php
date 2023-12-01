<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pokedex</title>
</head>
<body>
    <div class="container">
        <h2>Pokemon</h2>
        
        <?php
            session_start();
            $userID = $_SESSION["user_id"];
            
            if ($userID == 1) {
        ?>
        <div class="admin-panel">
            <form action="addunlock_pokemon.php" method="post">
                <label>Admin controls:</label><br>
                <label for="pokemon"><b>Pokemon</b></label>
                <br>
                <input type="text" placeholder="Pokemon" name="pokemon" required>
                <br>
                <label for="pokemonid"><b>ID</b></label>
                <br>
                <input type="number" placeholder="ID" name="pokemonid" required>
                <br>
                <label for="pokemontype"><b>Type</b></label>
                <br>
                <input type="text" placeholder="Type" name="pokemontype" required>
                <br><br>
                <button type="submit">Add pokemon to database</button>
            </form>

            <form action="removeunlock_pokemon.php" method="post">
                <br>
                <label for="pokemon"><b>Pokemon</b></label>
                <br>
                <input type="text" placeholder="Pokemon" name="pokemon" required>
                <br><br>
                <button type="submit">Remove pokemon from database</button>
            </form>

            <form action="fullwipe_pokemon.php" method="post">
                <br>
                <button type="submit">Wipe all pokemon from all users</button>
            </form>
        </div>
        <?php
            }
        ?>

        <div class="unlockablePokemonBlock">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "A5XDup=f>rNi3sn";
                $dbname = "pokedex";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT * FROM unlockable_pokemon");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<form action='add_pokemon.php' method='post'>";
                        echo "<input type='hidden' name='pokemon' value='" . $row["pokemon_name"] . "'>";
                        echo "<input type='hidden' name='pokemonid' value='" . $row["id"] . "'>";
                        echo "<input type='hidden' name='pokemontype' value='" . $row["type"] . "'>";
                        echo "<button class='addPokemonButton' type='submit'>Add " . $row["pokemon_name"] . "</button>";
                        echo "</form>";
                    }
                }
            ?>
        </div>

        <?php
            if (isset($_GET['message'])) {
                echo "<br>" . $_GET['message'];
            }
        ?>

        <h2>Unlocked Pokemon</h2>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "A5XDup=f>rNi3sn";
            $dbname = "pokedex";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM unlocked_pokemon WHERE user_id = '$userID'");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='pokemon-card'>";
                    echo "<form class='remove-form' action='remove_pokemon.php' method='post'>";
                    echo "<input type='hidden' name='pokemon_id' value='" . $row["pokemon_id"] . "'>";
                    echo "<button type='submit'>X</button>";
                    echo "</form>";
                    echo "Pokedex #: " . $row["pokemon_id"] . "<br>";
                    echo "Name: " . $row["pokemon_name"] . "<br>";
                    echo "Type: " . $row["pokemon_type"] . "<br>";
                    echo "Weight: " . $row["pokemon_weight"] . "<br>";
                    echo "</div><br>";
                }
            } else {
                echo "No unlocked Pokémon.<br>";
            }

            $conn->close();
        ?>
        <a class="returnLogin" href="index.php">Return to login</a>
        <!-- <form action="wipe_pokemon.php" method="post">
            <button type="submit">Remove all pokemon</button>
        </form> -->
    </div>
</body>
</html>
