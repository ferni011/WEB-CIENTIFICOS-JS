<?php
#Cargamos las dependencias
require_once "/usr/local/lib/php/vendor/autoload.php";
#Incluimos el fichero de la base de datos
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

    session_start();

    session_destroy();


    header("Location: portada");
?>