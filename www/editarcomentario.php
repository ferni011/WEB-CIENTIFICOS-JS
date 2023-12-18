<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$con = new BD();

if (isset($_POST['idComentario'])) {
    $idComentario = $_POST['idComentario'];
    $textoEditado = $_POST['textoEditado'];
    
    $con->editaComentario($idComentario, $textoEditado);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}



?>