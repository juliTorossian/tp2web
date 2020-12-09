<?php 

require_once('inc\funciones\funciones.php');

$a_productos  = array();
$a_categorias = array();

$j_productos  = file_get_contents('json\productos.json');
$a_productos  = json_decode($j_productos,true);
$j_categorias = file_get_contents('json\categorias.json');
$a_categorias = json_decode($j_categorias,true);

// MostrarArray($a_productos);



?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css\style.css" rel="stylesheet">

<!-- Home -->
<div class="container">

<div class="d-flex justify-content-center mt-5">
  <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="http://placehold.it/900x350" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://placehold.it/900x350" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="http://placehold.it/900x350" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<div class="row" >

  <div class="col-3">
    <h1 class="mb-4 text-center" id="productos">Categorias</h1>
    <div class="list-group">

      <a href="index.php?categoria=0" class="list-group-item">Todo</a>
      <?php //ListaDeCategorias($a_categorias);

      foreach ($a_categorias as $key => $value) {
        $nombreCat = $a_categorias[$key]["nombre"];
        $linkcategoria = "index.php?categoria=".$key;
      ?>
        <a href="<?php echo ($linkcategoria);?>" class="list-group-item"><?php echo($nombreCat);?></a>

      <?php }?>
    </div>


  </div>

  <div class="col-lg-9">
    <div class="row">
      <?php
        $imprime = false;
        foreach ($a_productos as $key => $value) {
          if(!(isset($_GET["categoria"])) or $_GET["categoria"] == 0){
            $imprime = true;
          }elseif($a_productos[$key]["id_categoria"] == $_GET["categoria"]  ){
            $imprime = true;
          }
          
          if($imprime){
            $imprime = false;

            $nombrePro   = $a_productos[$key]["nombre"];
            $precioPro   = "$".$a_productos[$key]["precio"];
            $descPro     = $a_productos[$key]["descCorta"];
            $descImg     = "inc\imagenes\\".$nombrePro."\\".$nombrePro."_min.jpg";
            $linkDetalle = "detalleProducto.php?producto=".$key;

      ?>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="<?php echo($linkDetalle);?>"><img class="card-img-top" src="<?php echo($descImg)?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo($linkDetalle);?>"><?php echo($nombrePro)?></a>
            </h4>
            <h5><?php echo($precioPro)?></h5>
            <p class="card-text"><?php echo($descPro)?></p>
          </div>
        </div>
      </div>
      <?php }}?>
    </div>
  </div>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>