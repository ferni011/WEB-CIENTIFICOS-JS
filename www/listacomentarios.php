<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

session_start();

$con = new BD();


$keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : "";

if (!empty($keyword)) {
    $comentarios = $con->buscarComentarios($keyword);
} else {
    $comentarios = $con->obtenerTodosComentarios(); 
}

echo $twig->render("listacomentarios.twig", [
    "comentarios" => $comentarios
]);
?>
