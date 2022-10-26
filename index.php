<?php
// Start de sesie
session_start();
//session_destroy();

//Zorgt er voor dat de functies werken
include("functies.php");
include("html_start.php");

//Verwijst naar de functie en stuurt ze terug
$page = get_var("p", "start");
$score = get_var("s", "");

//Kijkt of de pagina herlaad word en slaat het op in de session
if (isset( $_SESSION["load"])) {
	$_SESSION["load"] = 1 + $_SESSION["load"];
}else{
	$_SESSION["load"] = 1;
}

//De pagina's
switch ($page) {
	case "start":
		include("start.php");
		break;
	case "spel":
		include("spel.php");
		break;
	//Voor deze case moet nog een verwijzing en van deze naar eind verwijzen of naar acount en dan weer terug
	case "login":
		include("login.php");
		break;
	case "eind":
		include("eind.php");
		break;
		case "shop":
			include("shop.php");
			break;
		case "cart":
			include("cart.php");
			break;
	default:
		echo "<h2>404 Deze pagina is niet gevonden of bestaat niet!</h2><br>";
		echo "<a href='index.php'>Ga weer terug</a>";
}
include("html_eind.php");
?>