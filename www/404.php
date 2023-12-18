<?php
#Cargamos las dependencias
require_once "/usr/local/lib/php/vendor/autoload.php";
#Incluimos el fichero de la base de datos
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


#Cargamos la página error 404
echo $twig->render("404.twig",[]);

?>
