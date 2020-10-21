<?php 

function ExportArrayToJson($array, $carpeta, $archivo){
    if ( ! file_exists($carpeta)  )
        mkdir($carpeta);
    $fp = fopen( $carpeta.'\\'. $archivo.'.json' , 'w');
    fwrite($fp, json_encode($array));
    fclose($fp);
}

function MostrarArray($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>