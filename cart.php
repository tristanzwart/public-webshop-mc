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
        
        if (isset($winkelwagen)){
            foreach ($winkelwagen as $item_naam => $hoeveelheid){

                //TODO: Haal prijs uit database --> shop.php
                echo "
                <tr>
                    <th>
                        " . $item_naam . "
                    </th>
                    <th>
                        " . $hoeveelheid . "
                    </th>
                    <th>
                        nog iets
                    </th>
                </tr>";
            }
        }else{
            //TODO: voeg nog een lege winkel wagen stijl iets toe
        }

        //TODO: Items verwijderen
        // gebruik unset ($varnaam[item]);

        //TODO: Item hoeveelheid direct aapassen
    
        //var_dump($_SESSION["winkelwagen"]);
        //var_dump($winkelwagen);
        //session_destroy();
    ?>    
</table>