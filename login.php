
<?php
$login = get_var("l", "");
if ($login== 1){
    echo("Deze naam bestaat niet registreer alsjeblieft <br>");
}
?>
<div>
    <form action="index.php?p=eind" method="post">
        Login:<br>
        <input type="text" name="naam" placeholder="Typ hier je naam"><br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <form action="index.php?p=eind" method="post">
        Registreren:<br>
        <input type="text" name="naam" placeholder="Typ hier je naam"><br>
        <input type="text" name="email" placeholder="Typ hier je e-mail"><br>
        <input type="submit" value="Submit">
    </form>
</div>
