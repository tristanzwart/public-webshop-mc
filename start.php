<?php
// database gegevens, voor overzichtelijkheid in aparte variabelen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game";

// connectie maken, met dus die variabelen
$conn = mysqli_connect($servername, $username, $password, $dbname);
// check connectie, als mislukt, geef fout aan
if (!$conn) {
    die("Verbindingmislukt, fout: " . mysqli_connect_error());
}

// de query voor het ophalen van de data, voor overzichtelijkheid in aparte variabele
$sql = "SELECT * FROM score INNER JOIN user ON user.ID=score.user_id ORDER BY punten DESC LIMIT 10";
// aanroep van MySql
$result = mysqli_query($conn, $sql);
// check of query is gelukt
if(!$result){
    die("Query mislukt, fout: " . mysqli_error($conn));
}

// check of er rijen opgehaald uit de database
if (mysqli_num_rows($result) > 0) {
    // ja, er zijn rijen, ga ze 1 voor 1 langs
    while($row = mysqli_fetch_assoc($result)) {
        // nette rij tonen, met de id van de user en het aantal punten
        echo "User met naam " . $row["naam"] . " heeft " . $row["punten"] . " punten<br>";
    }
} else {
    // nee, geen scores
    echo "Er zijn geen scores<br>";
}
// en sluit de connective weer
mysqli_close($conn);

//"SELECT naam FROM user WHERE ID=1" de 1 kan door een var worden vervagen worden die eerst alle user_id's bij langs gaat


?>
<br>
<a href="index.php?p=spel">Start het spel</a><br>
<a href="index.php?p=shop">Ga naar shop</a>

