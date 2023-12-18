<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

// realiza una conexión a la base de datos utilizando mysql
$con=new BD();

// devuelve la lista de palabras censuradas en formato JSON
echo json_encode($con->getProhibidas());


?>
