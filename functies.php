<?php
function get_var($variabelenaam, $startwaarde){
    $retour= $startwaarde;
    if (isset($_GET[$variabelenaam])) {
        $retour = $_GET[$variabelenaam];	
    }
    return $retour;
}
?>