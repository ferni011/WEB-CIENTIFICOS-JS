<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
session_start();

$con = new BD();

$usuarios = $con->getUsuarios();

// Obtener el rol actual de cada usuario
foreach ($usuarios as &$usuario) {
    $rolActual = $con->getRolUsuario($usuario['ID']);
    $usuario['RolActual'] = $rolActual;
}

if(isset($_SESSION['nickUsuario'])){
    $usuarioactual = $con->getUsuario($_SESSION['nickUsuario']);
    $iduseractual=$usuarioactual['ID'];
}

$superusuarios = $con->getSuperUsuarios();
$selectedUser = null;
$currentUserID = null;
$user = null;
$newUserRole = null;
$usuariosesion = null;
$rolsesion = null;
$errores=array();


// Verificar si se ha enviado el formulario de cambio de rol
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['usuario']) && isset($_POST['tipoUsuario'])) {
        // Obtener el nombre de usuario seleccionado
        $selectedUser = $_POST['usuario'];

        // Obtener el nuevo tipo de usuario
        $newUserRole = $_POST['tipoUsuario'];

        // Obtener el ID del usuario seleccionado
        $user = $con->getUsuario($selectedUser);

        // Verificar si se encontró el usuario
        if ($user) {
            // Obtener el ID del usuario actual
            $currentUserID = $user['ID'];

            if (!empty($_SESSION['nickUsuario'])) {
                $usuariosesion = $con->getUsuario($_SESSION['nickUsuario']);
                $rolsesion = $con->getRolUsuario($usuariosesion);

                if ($rolsesion == "SUPERUSUARIO") {
                    if ($user['TipoUsuario'] == "SUPERUSUARIO" && count($superusuarios) == 1) {
                        $errores[] = "Error: Debe haber al menos un superusuario en el sistema.";
                    } else {
                        // Cambiar el rol del usuario seleccionado
                        $con->cambiarRolUsuario($currentUserID, $newUserRole);
                        header('Location: gestionpermisos');
                        exit(); // Terminar la ejecución después de redirigir
                    }
                }
            }
        }
    }
}


echo $twig->render('gestionpermisos.twig', ['usuarios' => $usuarios, 'usuariosesion' => $iduseractual,'errores'=>$errores]);
?>
