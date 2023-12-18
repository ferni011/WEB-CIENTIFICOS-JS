<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();


$con = new BD();

//Si existe sesión de usuario guardamos el usuario
if (isset($_SESSION['nickUsuario'])) {
    $usuario = $con->getUsuario($_SESSION['nickUsuario']);

}

//Si se escribe en la barra de búsqueda, guardamos lo escrito 
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    //Si el usuario existe y es Gestor o SuperUsuario, muestra todos los científicos hasta los no publicados
    if (isset($usuario) && ($usuario['TipoUsuario'] == "GESTOR" || $usuario['TipoUsuario'] == "SUPERUSUARIO")) {       
        $cientificos = $con->buscarCientificos($keyword);
    }
    //Si no, muestra solo los cientificos publicados
    else{
        $cientificos = $con->buscarCientificosPublicados($keyword);
    }


    // Devolver los resultados como JSON
    echo json_encode($cientificos);
}


?>