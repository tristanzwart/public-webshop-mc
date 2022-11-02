<style>
  .flex-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-color: DodgerBlue;
    flex-wrap: wrap;
  }

  .flex-container>div {
    background-color: white;
    color: black;
    text-align: center;
    width: 250px;
    height: 400px;
    margin: 10px;
    font-size: 30px;
    border-radius: 50px;
  }

  .a-cart{
    position: absolute;
    right: 10px;
    top: 0px;
  }

  .cart-img{
    max-width: 50px;
    height: 40px;
  }


  .titel-item{
    font-size: 30px;
    margin: auto;
    margin-top: 20%;
  }

  .img-item{
    margin-top: 5%;
    max-width: 65%;
    height: auto;
    border-radius: 50px;
  }

  .buy-item{
    margin-top: 5%;
    width: 85%;
    height: 2.5em;
    border-radius: 40px;
    font-size: 80%;
    cursor: pointer;
    background-color: DodgerBlue;
    color: white;
    border-color: lightblue;
  }

  .hoeveelheid-item{
    width: 25%
  }


</style>

<nav>
  <a class="a-cart" href="index.php?p=cart">
    <img class="cart-img" src=".\img\shopping.webp">
  </a>
  <a href=""></a>
  <a href=""></a>
  <a href=""></a>
</nav>

<script>
  	//function coookie(item_id, hoeveelheid, dagen_verval) {
      //var d = new Date();
      //d.setTime(d.getTime() + (dagen_verval*24*60*60*1000));
      //var verval_tijd = "verval_tijd="+d.toUTCString();
      //document.cookie = item_id + "=" + hoeveelheid + "; " + verval_tijd;
    //}
</script>

<head>
  <h1>Webshop</h1>
</head>

<p>testing</p>

<div class="flex-container">
  <div>
    <h1 class="titel-item">Item name 1</h1>
    <img class="img-item" src=".\img\test.png"> 

    <form method="post">
      <input type="hidden" name="item-naam" value="test item">
      <input class="hoeveelheid-item" type="number" name="hoeveelheid" min="1" max="1000">
      <input class="buy-item" type="submit" value="Buy me">
    </form>
  </div>

  
  <div><h1 class="titel-item">Item name 2</h1></div>
  <div><h1 class="titel-item">Item name 3</h1></div>
  <div><h1 class="titel-item">Item name 4</h1></div>
  <div><h1 class="titel-item">Item name 5</h1></div>
  <div><h1 class="titel-item">Item name 6</h1></div>
</div>

<?php
  if ((isset($_POST["item-naam"]))&& (isset($_POST["hoeveelheid"]))){
    //Stopt de geposte items in en variabele
    $item_naam = $_POST["item-naam"];
    $hoeveelheid = $_POST["hoeveelheid"];

    //stelt $winklelwagen gelijk aan de sesion versie
    $winkelwagen = &$_SESSION["winkelwagen"];

    //voegt het toe aan de $winkelwagen
    $winkelwagen[$item_naam] = $hoeveelheid;
  }
  
  //TODO: extra haal de items die beschikbaar zijn en hoe veel er zijn op uit database en de prijs
?>
