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

        //TODO: Items verwijderen
        // gebruik unset ($varnaam[item]);

        if(isset($_POST["verwijder-naam"])){
            unset ($winkelwagen[$_POST["verwijder-naam"]]);
        }
        
        if (isset($winkelwagen)){
            foreach ($winkelwagen as $item_naam => $hoeveelheid){

                //TODO: Haal prijs uit database --> shop.php
                echo '
                <tr>
                    <th>
                        ' . $item_naam . '
                    </th>
                    <th>
                        <input type="number" value="' . $hoeveelheid . '" name="hoeveelheid" min="1" max="1000">
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
    const input = document.querySelector('input');
    input.addEventListener('input', update_hoeveelheid);
    function update_hoeveelheid(e){
        console.log(e.target.value);
        //TODO: xml httprequest for send var to php
    }
</script>