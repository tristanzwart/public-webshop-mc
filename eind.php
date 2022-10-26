<?php
$_SESSION["punten"] = rand(0,300);
echo "Dit is de eindpagina. <br>";
echo "Je hebt " . $_SESSION["punten"] . " punten gehaald. <br>";
echo "Als je terug wil gaan klik dan hier: <br>";
echo "<a href='index.php'>Startpagina</a>";

//Form gegevens ophalen en opslaan
$naam = $_POST["naam"];
$email = "";
if (isset($_POST["email"])){
    $email = $_POST["email"];
}
//$_SESSION["user_id"] = ;


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

//controleren of naam voorkomt in de user tabel en anders toevoegen
$sql = "SELECT ID FROM user WHERE naam='$naam'";
// aanroep van MySql
$result = mysqli_query($conn, $sql);
// check of query is gelukt
if(!$result){
    die("Query mislukt, fout: " . mysqli_error($conn));
}

//controleer of er rijen zijn
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user_id"] = $row["ID"];
}else{
    //voor als de user niet bestaat en het e-mail heeft ingevuld
    if($email != ""){
        $sql = "INSERT INTO user (naam, email, wachtwoord) VALUES ('$naam', '$email', '***')";
        // aanroep van MySql
        $result = mysqli_query($conn, $sql);
        // check of query is gelukt
        if(!$result){
            die("Query mislukt, fout: " . mysqli_error($conn));
        }
        //Haal opniew op
        //controleren of naam voorkomt in de user tabel
        $sql = "SELECT ID FROM user WHERE naam='$naam'";
        // aanroep van MySql
        $result = mysqli_query($conn, $sql);
        // check of query is gelukt
        if(!$result){
            die("Query mislukt, fout: " . mysqli_error($conn));
        }
    
        //controleer of er rijen zijn
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user_id"] = $row["ID"];
        }
    }else{
        header("location:http://localhost/po4/sprint2/index.php?p=login&l=1");
        die();
    }
}


// de query voor het ophalen van de data, voor overzichtelijkheid in aparte variabele
$sql = "INSERT INTO score (user_id, punten) VALUES (".$_SESSION["user_id"].",".$_SESSION["punten"].")";
// aanroep van MySql
$result = mysqli_query($conn, $sql);
// check of query is gelukt
if(!$result){
    die("Query mislukt, fout: " . mysqli_error($conn));
}
// print resultaat
//echo ('Het is gelukt:' . $result);

// Sluit de connective weer
mysqli_close($conn);

?>