<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

session_start();

$con = new BD();

$hashtag = isset($_POST["hashtag"]) ? $_POST["hashtag"] : "";

if (!empty($hashtag)) {
    $cientificos = $con->buscarCientificosPorHashtag($hashtag); 
} else {
    // Obtener todos los científicos del sitio
    $cientificos = $con->getCientificos();
}

echo $twig->render("listacientificos.twig", [
    "cientificos" => $cientificos
]);
?>
