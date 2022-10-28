<?php
// demo verzending via Ajax, vanuit javascript, ipv form.submit()
// op server wordt formulier ontvangen en een bericht terug gestuurd in json format
// de javascript vangt het retourbericht op en plaatst het in een div

// check of er een Ajax bericht is verstuurd door javascript in de browser, via normale $_POST check
if(isset($_POST['user_name'])){
  // yes, er is een bericht
  // tekstvelden, textarea's, hiddens, lijsten via normale manier ophalen, via $_POST
  $user_name = $_POST['user_name'];
  // output maken
  // user name
  $output = "De username is $user_name<br><br>";
  // als voorbeeld voor gebruik json, nog een aparte bericht erbij, melding aan gebruiker
  $melding = "Yes, gelukt";
  // omzetten naar een json string en terugsturen naar de browser
  // zie ook http://php.net/manual/en/function.json-encode.php
  echo json_encode(array("output" => $output, "melding" => $melding));
  // ps: je kunt ook array's maken voor inhoud van verschillende divs in de browser

  // code stoppen, anders wordt alle html hieronder ook verstuurd naar de browser
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        // aanroep door klik op button, form als object meegegeven
        function AJAXSubmit(oFormElement) {
            // versturen formulier via json
            //   zie ook https://www.w3schools.com/js/js_ajax_http_send.asp
            var oReq = new XMLHttpRequest();
            // onload ipv onreadystatechange
            //   zie ook https://zqzhang.github.io/blog/2016/04/18/why-use-onload-in-cross-domain-ajax.html
            // hiermee wordt bepaald dat als er een bericht van de server terug komt
            //   de functie ajaxSuccess moet worden aangeroepen
            oReq.onload = ajaxSuccess;
            // verzending voorbereiden, 3 vars nodig:
            //   1) type: post (kan ook get zijn)
            //   2) het php bestand die moet worden aangeroepen,
            //      in dit geval index.php, vastgelegd in action van het formulier
            //   3) asynchronously, true of false (false is not recommended, default = true)
            oReq.open("post", oFormElement.action, true);
            // het echt verzenden van het bericht, waarbij het formulier via FormData wordt omgezet naar
            oReq.send(new FormData(oFormElement));
        }

        // aanroep door server, geinitialiseerd in AJAXSubmit
        function ajaxSuccess() {
            var response_text;

            // retourbericht van de server opvangen, via try catch
            try {
                response_text = JSON.parse(this.responseText);
            } catch (e) {
                // e bevat de javascript tekst van het foutbericht
                // vaak geeft this.responseText meer info: dit is het gehele bericht van de server
                alert('fout in json retourbericht, melding:\n' + e + '\ntekst:\n' + this.responseText);
                return;
            }
            // check er er een gevulde melding in zit
            if (response_text.melding !== '') {
                // ja, via alert tonen
                alert(response_text.melding);
            }
            // check of er een gevulde output is
            if (response_text.output !== '') {
                // ja, de div vullen
                document.getElementById('output').innerHTML = response_text.output;
            }
        }
    </script>
</head>
<body>
<div style="background-color:#0A9297;margin:10px;padding:10px;color:#000000">
    <!-- voorbeeld divje, met menu -->
    Dit is het menu
</div>
<div id="input" style="background-color:#6b5e90;margin:10px;padding:10px;color:#000000">
    <!-- een div voor input, retour html zou ook hier weer ingezet kunnen worden -->
    Invoer div<br>
    <br>
    <!-- de form die wordt verzonden -->
    <form id="demo" name="demo" method="post" action="index.php" enctype="multipart/form-data"
          accept-charset="UTF-8">
        <!-- voorbeeld object, een input type is text -->
        User name <input type="text" id="user_name" name="user_name"><br>
        <br>
        <!-- de button, waarbij onclick de javascript wordt aangeroepen,
             waarbij het form als object wordt meegestuurd -->
        <input type="button" value="Send" onclick="AJAXSubmit(document.getElementById('demo'))">
        <!-- het testen van de php is lastig, door json retour, voor test kan ook ff een normale sumbmit worden gebruikt -->
        <!-- <input type="button" value="Send" onclick="submit()">-->
    </form>
</div>
<div id="output" style="background-color:#050011;margin:10px;padding:10px;color:#ffffff">
    <!-- hierin komt de output -->
</div>
</body>
</html>
