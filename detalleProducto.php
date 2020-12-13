<?php 

require_once('inc\funciones\funciones.php');
require_once('inc\funciones\fpdf\fpdf.php');

$a_productos = array();
$a_productos = json_decode(file_get_contents('json\productos.json'),true);

//MostrarArray($a_productos);

$title = $a_productos[$_GET["producto"]]["nombre"] .' - CandyLand';

function crearPDF_producto($id_pro, $a_pro){
  $pdf = new FPDF();

  $pdf->AddPage();
  $pdf->SetFont('Arial','',16);
  $pdf->Cell(40,10, 'Primer PDF');
  $pdf->Output();
   
}

function AñadirComentario($mail, $cali, $comm, $id_prodcuto){
  $a_comentarios = array();
  if (file_exists('json\comentarios.json')){
    $a_comentarios = json_decode(file_get_contents('json\comentarios.json'),true);

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
    $a_comentariosR = array_reverse($a_comentarios);
    $count = 0;
    foreach ($a_comentariosR as $key => $value) {
      $producto = $a_comentariosR[$key]["id_producto"];
      if($id_producto == $producto){
        $email    = $a_comentariosR[$key]["email"];
        $caliN    = $a_comentariosR[$key]["cali"];
        $comm     = $a_comentariosR[$key]["comm"];

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
        $count++;
      }
      if($count > 2){
      break;
      }
    }
  }else{
    echo '<p>no hay comentarios</p>';
  }
}


//crearPDF_producto(11, $a_productos);

?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="css\style.css" rel="stylesheet">

    <!-- Header -->
    <?php require_once('header.php');?>

    <!-- Detalle de Producto -->
    <div class="container my-5 mt-5">

      <div class="row">
        <?php
          $id_producto = $_GET["producto"];
          $nombrePro = $a_productos[$id_producto]["nombre"];
          $detallePro = $a_productos[$id_producto]["descLarga"];
          $precio = $a_productos[$id_producto]["precio"];
          $imgPro =  "inc\\imagenes\\".$nombrePro."\\".$nombrePro."_max.jpg";
          $linkDesc = "inc\\funciones\\descargarPDF.php?producto=".$id_producto;
        ?>


        <div class="col-lg-7">
          <img class="card-img-top" src="<?php echo($imgPro);?>" alt="">
        </div>
        <div class="col-lg-5 px-2 text-center">
          <h2 class="h3 my-4"><?php echo($nombrePro);?><a href="<?php echo($linkDesc)?>">       <i class="far fa-file-pdf"></i></a></h2>
          <h3 class="h4 mt-2"><?php echo($detallePro);?></h3>
          <?php 
            if($a_productos[$id_producto]["promo"] == "si"){
              $precioCDesc = $precio - (($a_productos[$id_producto]["descuento"] * $precio) / 100);
          ?>
              <h3 class="mt-4" style="text-decoration:line-through;"><?php echo('$'.number_format($precio, 2))?>
              <h3><?php echo('$'.number_format($precioCDesc, 2))?>
          <?php
            }else{
          ?>
            <h3 class="mt-4"><?php echo('$'.number_format($precio, 2))?></h3>
            <?php
            }
          ?>

          <br><button type="button" class="btn btn-primary mt-4">COMPRAR</button>
          <br><button type="button" class="btn btn-info mt-2">AÑADIR AL CARRITO</button>

        </div>
        
        
        
      </div>

      <div class="m-5 p-4">
        <form action="" method="post" onsubmit="alert('Comantario relizado!!')">
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

        <?php 

          if(isset($_POST['submit']))
          {
            if ($_POST['email']!='' and $_POST['calificacion']!='' and $_POST['comentario']!=''){
              AñadirComentario($_POST['email'], $_POST['calificacion'], $_POST['comentario'],$_GET["producto"]);
            }
          }

        ?>

        <div class="m-5 p-5 border border-dark rounded">
          <!--commentario-->
          <?php cargarComentarios($_GET["producto"]);?>
          
        </div>

      </div>
    </div>
    
    <!-- Footer -->
    <?php require_once('footer.php');?>
    

    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
