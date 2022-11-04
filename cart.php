<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }

</style>

<nav>
    <a href="index.php?p=shop">Terug naar winkel</a>
</nav>

<h1>Winkelwagen</h1>


    <?php
        
        $winkelwagen = &$_SESSION["winkelwagen"];


        //verwijderd item uit de aray
        if(isset($_POST["verwijder-naam"])){
            unset ($winkelwagen[$_POST["verwijder-naam"]]);
        }

        //Past item hoeveelheid aan aan de hand van de geposte variabelen
        if((isset($_POST["hoeveelheid"])) && (isset($_POST["item_naam"]))){
            $naam_item = $_POST["item_naam"];

            $winkelwagen[$naam_item] = $_POST["hoeveelheid"];
        }

        
        if (isset($winkelwagen)){
            if ( !empty(array_filter($winkelwagen))) {
                echo '
                <table>
                    <tr>
                        <th>
                            item
                        </th>
                        <th>
                            hoeveelheid
                        </th>
                        <th>
                            prijs
                        </th>
                    </tr>';
                foreach ($winkelwagen as $item_naam => $hoeveelheid){

                    echo '
                    <tr>
                        <th>
                            ' . $item_naam . '
                        </th>
                        <th>
                            <form method="post" id="' . $item_naam . '" action="index.php?p=cart">
                                <button onclick="minder(`' . $item_naam . 'veld`, `' . $item_naam . '`)" type="button">-</button>
                                <input class="amount" type="number" id="' . $item_naam . 'veld" onchange="update_hoeveelheid(document.getElementById(\'' . $item_naam . '\'))" value="' . $hoeveelheid . '" name="hoeveelheid" min="1" max="1000">
                                <button onclick="meer(`' . $item_naam . 'veld`, `' . $item_naam . '`)" type="button">+</button>
                                <input type="hidden" name="item_naam" value="' . $item_naam . '">
                                <!--<input type="submit" value="Opslaan">-->
                            </form>
                        </th>
                        <th>
                            nog iets
                            <form method="post">
                                <input type="hidden" name="verwijder-naam" value="' . $item_naam . '">
                                <input type="submit" value="Verwijder item">
                            </form>
                        </th>
                    </tr>';
                }
                echo '</table>';
            } else {
                //TODO: Hier een pagina toeveoegen voor een lege winkelwagen
                echo 'De winkelwagen is leeg';
            }

        }else{
            //TODO: Hier een pagina toeveoegen voor een lege winkelwagen die ook hier
            echo 'De winkelwagen is leeg';
        }

        //TODO: Voeg een msql functie toe
        //TODO: Haal prijs uit database --> shop.php
    
        //var_dump($_SESSION["winkelwagen"]);
        //var_dump($winkelwagen);
        //session_destroy();
    ?>    
</table>
<script>

    function update_hoeveelheid(id){
        var oReq = new XMLHttpRequest();
        //oReq.onload = ajaxSuccess;
        oReq.onload = console.log("Hoeveelheid versuurt");
        oReq.open("post", id.action, true);
        oReq.send(new FormData(id));
    }

    //+ of - code javascript en veruurd ook meteen de waarde
    function meer(veld, send){
        document.getElementById(veld).value++;

        id = document.getElementById(send);
        var oReq = new XMLHttpRequest();
        oReq.onload = console.log("Hoeveelheid versuurt");
        oReq.open("post", id.action, true);
        oReq.send(new FormData(id));

    }

    function minder(veld, send){
        document.getElementById(veld).value--;

        id = document.getElementById(send);
        var oReq = new XMLHttpRequest();
        oReq.onload = console.log("Hoeveelheid versuurt");
        oReq.open("post", id.action, true);
        oReq.send(new FormData(id));
    }

    //Stopt form versturen door enter te blokeren omdat er anders een bug optreed dit als tijdelijke fix tot een betere oplossing.
    var body = document.getElementsByTagName("body")[0];

    body.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        
        
        //box unfocusen als enter wordt ingedrukt en verzend daardoor via ajax
        document.activeElement.blur();
      }
    });
</script>