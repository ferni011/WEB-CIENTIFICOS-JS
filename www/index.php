<?php

session_start();

#Cargamos las dependencias
require_once "/usr/local/lib/php/vendor/autoload.php";
#Incluimos el fichero de la base de datos
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$con=new BD();
$usuario=null;


#Obtenemos los científicos
$cientificos=$con->getCientificosPublicados();

$boton=false;

if (isset($_SESSION['nickUsuario'])) {
    $usuario = $con->getUsuario($_SESSION['nickUsuario']);
    $boton=true;
    
}
  

#Pasamos a portada los científicos que aparecen en la base de datos
echo $twig->render("portada.twig", ['cientificos' => $cientificos,'session'=>$usuario,'boton'=>$boton]);

?>
