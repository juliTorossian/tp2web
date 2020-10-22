<?php 

require_once('inc\funciones\funciones.php');

$a_productos  = array();
$a_categorias = array();

$j_productos  = file_get_contents('json\productos.json');
$a_productos  = json_decode($j_productos,true);
$j_categorias = file_get_contents('json\categorias.json');
$a_categorias = json_decode($j_categorias,true);

// MostrarArray($a_productos);

function CardProductoHome($produtos_a){
  foreach ($produtos_a as $key => $value) {
    $nombrePro = $produtos_a[$key]["nombre"];
    $precioPro = $produtos_a[$key]["precio"];
    $descPro   = $produtos_a[$key]["descripcion"];
    $descImg   = "http://placehold.it/700x400";

    //<a href="destino.php?saludo=hola&texto=Esto es una variable texto">Paso variables saludo y texto a la página destino.php</a>

    echo '<div class="col-lg-4 col-md-6 mb-4"><div class="card h-100">';
    echo '<a href="detalleProducto.php?producto='.$key.'"><img class="card-img-top" src='.$descImg.' alt=""></a>';
    echo '<div class="card-body"><h4 class="card-title" ><a href="detalleProducto.php?producto='.$key.'">'.$nombrePro.'</a></h4>';
    echo '<h5>$'.$precioPro.'</h5>';
    echo '<p class="card-text">'.$descPro.'</p></div>';
    echo '</div></div>';
    //<div class="card-footer"><small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small></div>
  }
}

function ListaDeCategorias($categorias_a){
  echo '<div class="list-group">';
  foreach ($categorias_a as $key => $value) {
    $nombreCat = $categorias_a[$key]["nombre"];
    echo '<a href="#" class="list-group-item">'.$nombreCat.'</a>';
  }
  echo '</div>';
}

?>


<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CandyLand</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css\style.css" rel="stylesheet">

</head>

<body>
  <?php //require_once('detalleProducto.php');?>

  <!-- Menu -->
  <?php require_once('menu.php');?>

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
        <?php ListaDeCategorias($a_categorias);?>
        <!-- <div class="list-group">
          <a href="#" class="list-group-item">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
        </div> -->

      </div>

      <div class="col-lg-9">
        <div class="row">
          <?php CardProductoHome($a_productos);?>

          <!-- <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Item One</a>
                </h4>
                <h5>$24.99</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once('footer.php');?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
