<?php 

require_once('inc\funciones\funciones.php');

$a_productos   = array();
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

function AñadirComentario($mail, $cali, $comm, $id_prodcuto){
  $a_comentarios = array();
  if (file_exists('json\comentarios.json')){
    $j_comentarios = file_get_contents('json\comentarios.json');
    $a_comentarios = json_decode($j_comentarios,true);

    $a_comentarios[count($a_comentarios)] = Array(
    'id_comentario' => count($a_comentarios),
    'email' => $mail,
    'cali' => $cali,
    'comm' => $comm,
    'id_producto' => $id_prodcuto
    );

    ExportArrayToJson($a_comentarios, 'json', 'comentarios');
  }else{
    $a_comentarios[count($a_comentarios)] = Array(
    'id_comentario' => count($a_comentarios),
    'email' => $mail,
    'cali' => $cali,
    'comm' => $comm,
    'id_producto' => $id_prodcuto
    );

    ExportArrayToJson($a_comentarios, 'json', 'comentarios');
  }
}

function cargarComentarios($id_producto){

  if (file_exists('json\comentarios.json')){
    $j_comentarios = file_get_contents('json\comentarios.json');
    $a_comentarios = json_decode($j_comentarios,true);
    
    foreach ($a_comentarios as $key => $value) {
      $producto = $a_comentarios[$key]["id_producto"];
      if($id_producto == $producto){
        $email    = $a_comentarios[$key]["email"];
        $caliN    = $a_comentarios[$key]["cali"];
        $comm     = $a_comentarios[$key]["comm"];

        switch ($caliN) {
          case 5:
            $caliE = '<div class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</div>';
            break;
          case 4:
            $caliE = '<div class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</div>';
            break;
          case 3:
            $caliE = '<div class="text-muted">&#9733; &#9733; &#9733; &#9734; &#9734;</div>';
            break;
          case 2:
            $caliE = '<div class="text-muted">&#9733; &#9733; &#9734; &#9734; &#9734;</div>';
            break;
          case 1:
            $caliE = '<div class="text-muted">&#9733; &#9734; &#9734; &#9734; &#9734;</div>';
            break;
          case 0:
            $caliE = '<div class="text-muted">&#9734; &#9734; &#9734; &#9734; &#9734;</div>';
            break;
        }
        
        echo '<div class="row my-2"><div class="col-4 text-center py-2" style="background-color: beige;">';
        echo '<div class="row"><p class=" m-0">'.$email.'</p></div>';
        echo '<div class="row">'.$caliE.'</div>';
        echo '</div><div class="col-8 p-3" style="background-color: skyblue;"><p>'.$comm.'</p></div></div>';
      }
    }
  }else{
    echo '<p>no hay comentarios</p>';
  }
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
    <div class="container my-5 mt-5">

      <div class="row">
        <?php DetalleProducto($a_productos, $_GET["producto"]); ?>
      </div>

      <div class="m-5 p-4">
        <form action="" method="post">
          <div class="row">
            <div class="col-6">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-6">
            <label>Calificacion</label>
              <select type="number" class="form-control" name="calificacion">
                <option selected>5</option>
                <option>4</option>
                <option>3</option>
                <option>2</option>
                <option>1</option>
                <option>0</option>
              </select>
            </div>
          </div>
          <div>
            <label>Comentario</label>
            <textarea class="form-control mb-2"  name="comentario" rows="3"></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-info">Comentar</button>
        </form>

        <div class="m-5 p-5 border border-dark rounded">
          <!--commentario-->
          <?php cargarComentarios($_GET["producto"]);?>
        </div>

      </div>
    </div>
    
    <!-- Footer -->
    <?php require_once('footer.php');?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

<?php 

  if(isset($_POST['submit']))
  {
    // echo 'mail: '.$_POST['email'];
    // echo 'calificacion: '.$_POST['calificacion'];
    // echo 'comentario: '.$_POST['comentario'];

    if ($_POST['email']!='' and $_POST['calificacion']!='' and $_POST['comentario']!=''){
      AñadirComentario($_POST['email'], $_POST['calificacion'], $_POST['comentario'],$_GET["producto"]);
    }
  }

?>