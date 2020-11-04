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

<!-- Home -->
<div class="container">

<div class="d-flex justify-content-center">
  <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
  <ol class="carousel-indicators">
  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
  <div class="carousel-item active">
    <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
  </div>
  <div class="carousel-item">
    <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
  </div>
  <div class="carousel-item">
    <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
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

<div class="row">

  <div class="col-lg-3">
    <h1 class="mb-4 text-center">Categorias</h1>
    <div class="list-group">

      <?php //ListaDeCategorias($a_categorias);
      
      foreach ($a_categorias as $key => $value) {
        $nombreCat = $a_categorias[$key]["nombre"];
      ?>
        <a href="#" class="list-group-item"><?php echo($nombreCat);?></a>
      <?php }?>
    </div>

  </div>

  <div class="col-lg-9">
    <div class="row">
      <?php
        foreach ($a_productos as $key => $value) {
          $nombrePro   = $a_productos[$key]["nombre"];
          $precioPro   = "$".$a_productos[$key]["precio"];
          $descPro     = $a_productos[$key]["descCorta"];
          $descImg     = "inc\\imagenes\\".$nombrePro."\\".$nombrePro."_min.jpg";
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
      <?php }?>
    </div>
  </div>
</div>
</div>