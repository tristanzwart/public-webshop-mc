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
    </tr>
    <?php
        
        $winkelwagen = &$_SESSION["winkelwagen"];

        var_dump($_POST);

        //verwijderd item uit de aray
        if(isset($_POST["verwijder-naam"])){
            unset ($winkelwagen[$_POST["verwijder-naam"]]);
        }

        //Past item hoeveelheid aan aan de hand van de geposte variabelen
        if((isset($_POST["hoeveelheid"])) && (isset($_POST["item_naam"]))){
            echo "test";
            $naam_item = $_POST["item_naam"];

            $winkelwagen[$naam_item] = $_POST["hoeveelheid"];
            echo json_encode(array("naam" => $naam_item, "hoeveel" => $winkelwagen[$naam_item]));
            var_dump($_SESSION["winkelwagen"]);
        }

        
        if (isset($winkelwagen)){
            var_dump($_SESSION["winkelwagen"]);
            foreach ($winkelwagen as $item_naam => $hoeveelheid){

                //TODO: Haal prijs uit database --> shop.php
                echo '
                <tr>
                    <th>
                        ' . $item_naam . '
                    </th>
                    <th>
                        <form method="post" id="' . $item_naam . '" action="index.php?p=cart">
                            <!-- TODO: Pas de knopen van hoeveelheid aan via javascript naar een + en - -->
                            <button onclick="meer()">+</button>
                            <input class="amount" type="number" onchange="update_hoeveelheid(document.getElementById(\'' . $item_naam . '\'))" value="' . $hoeveelheid . '" name="hoeveelheid" min="1" max="1000">
                            <button onclick="minder()">-</button>
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
        }else{
            //TODO: voeg nog een lege winkel wagen stijl iets toe
        }

        

        //TODO: Item hoeveelheid direct aapassen
    
        //var_dump($_SESSION["winkelwagen"]);
        //var_dump($winkelwagen);
        //session_destroy();
    ?>    
</table>
<script>
    /*const input = document.querySelector('input');
    if(document.getElementById('che')!= undefined){
        input.addEventListener('input', update_hoeveelheid);
        //xml httprequest for send var to php
        //newdata element?
        function update_hoeveelheid(e){
            console.log(e.target.value);
            var oReq = new XMLHttpRequest();
            //oReq.onload = ajaxSuccess;
            oReq.open("post", "cart.php", true);
            oReq.send(new FormData(document.getElementById('hoeveel')));
        }
    } else {
        console.log("element doesn't exist");
    }*/
    
    function update_hoeveelheid(id){
        var oReq = new XMLHttpRequest();
        //oReq.onload = ajaxSuccess;
        oReq.onload = ajaxSuccess;
        console.log(id);
        for ( var pair of new FormData(id).entries()) {
            console.log(pair[0] + "->" +pair[1])
        }
        oReq.open("post", id.action, true);
        oReq.send(new FormData(id));
        //console.log("changing " + id + " to " + document.getElementById(id).getElementsByClassName("amount")[0].value);
    }

    function ajaxSuccess() {
        var response_text;

        // retourbericht van de server opvangen, via try catch
        try {
            response_text = JSON.parse(this.responseText);
        } catch (e) {
            // e bevat de javascript tekst van het foutbericht
            // vaak geeft this.responseText meer info: dit is het gehele bericht van de server
            console.log('fout in json retourbericht, melding:\n' + e + '\ntekst:\n' + this.responseText);
            return;
        }
        // check er er een gevulde melding in zit
        if (response_text.melding !== '') {
            // ja, via alert tonen
            console.log(response_text.melding);
        }
        // check of er een gevulde output is
        if (response_text.output !== '') {
            // ja, de div vullen
            document.getElementById('output').innerHTML = response_text.output;
        }
    }

    //TODO: + of - code javascript
    function meer(){

    }

    function minder(){

    }

    //opvangen in php met $_POST["hoeveelheid"] en $_POST["item_naam"]
    //Vervolgens de aray aan passen
</script>