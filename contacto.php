<?php 

require_once('inc\funciones\funciones.php');

function AñadirContacto($mail, $nombre, $apellido, $telefono, $area,  $mensaje){
    $a_contactos = array();
    echo(file_exists('json\contactos.json'));
    if (file_exists('json\contactos.json')){
      $a_contactos = json_decode(file_get_contents('json\contactos.json'),true);
  
      $a_contactos[count($a_contactos)] = Array(
      'id_contactos' => count($a_contactos),
      'email'    => $mail,
      'nombre'   => $nombre,
      'apellido' => $apellido,
      'telefono' => $telefono,
      'area'     => $area,
      'mensaje'  => $mensaje
      );
  
      ExportArrayToJson($a_contactos, 'json', 'contactos');
    }else{
      $a_contactos[count($a_contactos)] = Array(
      'id_contactos' => count($a_contactos),
      'email'    => $mail,
      'nombre'   => $nombre,
      'apellido' => $apellido,
      'telefono' => $telefono,
      'area'     => $area,
      'mensaje'  => $mensaje
      );
  
      ExportArrayToJson($a_contactos, 'json', 'contactos');
    }
  }

?>


<?php require_once('header.php');?>


<link href="css\style.css" rel="stylesheet">

<div class="container my-5" style="background-color: darkgray;">

    <div class="row fade show" data-dismiss="alert" id="alertaEnvio">
        <div class="col-4">
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                Mensaje enviado satisfactoriamente!
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6" style="display:table;margin: auto;"><!--   -->
            <h2 class="text-center">Contactenos</h2>
            <form class="form-horizontal" method="post">
                
                <div class="row">
                    <div class="col-6">
                        <span class="col-md-1 col-md-offset-2 text-center"></span>
                        <input id="fname" name="nombre" type="text" placeholder="Nombre" class="form-control">
                    </div>
                    <div class="col-6">
                        <span class="col-md-1 col-md-offset-2 text-center"></span>
                        <input id="lname" name="apellido" type="text" placeholder="Apellido" class="form-control">
                    </div>
                </div>

                <div><!--   class="form-group" -->
                    <span class="col-md-1 col-md-offset-2 text-center"></span>
                    <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                </div>

                
                <div class="row">
                    <div class="col-6">
                        <span class="col-md-1 col-md-offset-2 text-center"></span>
                        <input id="phone" name="telefono" type="text" placeholder="Telefono" class="form-control">
                    </div>
                    <div class="col-6">
                        <span class="col-md-1 col-md-offset-2 text-center"></span>
                        <select type="text" class="form-control" name="area">
                            <option selected>Att. al Cliente</option>
                            <option>Ventas</option>
                            <option>Compras</option>
                            <option>Reclamos</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                    <textarea class="form-control" name="mensaje" placeholder="Mensaje" rows="7"></textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" name="submit" id="btnEnviar" class="btn btn-primary btn-lg">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php require_once('footer.php');

if(isset($_POST['submit'])){
    // echo 'mail: '.$_POST['email'];
    // echo 'calificacion: '.$_POST['nombre'];
    // echo 'comentario: '.$_POST['mensaje'];

    if ($_POST['email']!='' and $_POST['nombre']!='' and $_POST['mensaje']!='' and $_POST['apellido']!='' and $_POST['area']!='' and $_POST['telefono']!=''){
        AñadirContacto($_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['area'],  $_POST['mensaje']);
    }
}

?>