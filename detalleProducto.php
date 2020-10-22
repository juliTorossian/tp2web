<?php 

$a_productos  = array();
$j_productos = file_get_contents('json\productos.json');
$a_productos = json_decode($j_productos,true);

// MostrarArray($a_productos);

function DetalleProducto($produtos_a, $id_prodcuto){
    
    $nombreProducto = $produtos_a[$id_prodcuto]["nombre"];
    $detalleProducto = $produtos_a[$id_prodcuto]["descripcion"];
    $imgProducto = "http://placehold.it/700x400";

    echo '<div class="col-lg-7">';
    echo '<img class="card-img-top" src="'.$imgProducto.'" alt=""></div>';
    echo '<div class="col-lg-5 px-2 text-center">';
    echo '<h2 class="h3 my-4">'.$nombreProducto.'</h2>';
    echo '<h3 class="h4 mt-2">'.$detalleProducto.'</h3></div>';
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

    <!-- Menu -->
    <?php require_once('menu.php');?>

    <!-- Detalle de Producto -->
    <div class="container my-5">

        <div class="row">
            <?php DetalleProducto($a_productos, $_GET["producto"]); ?>
        </div>

        <div class="row">

        </div>


    </div>
    


    <!-- Footer -->
    <?php require_once('footer.php');?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>