<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$con = new BD();

$IDUsuario = null;
$usuario = null;
$boton = false;
$errores = array();

// Obtener los datos del usuario actual
if (isset($_GET['usuario'])) {
    // Comprobamos que lo que se obtiene es un entero
    $IDUsuario = filter_var($_GET['usuario'], FILTER_VALIDATE_INT);

    // Si se obtiene un entero
    if ($IDUsuario !== false) {
        // Obtenemos el científico, sus fotos y sus comentarios
        $usuario = $con->getUsuarioID($IDUsuario);
    }
}

if (isset($_SESSION['nickUsuario'])) {
    $boton = true;
}

$useractual = isset($usuario['Usuario']) ? $usuario['Usuario'] : null;
$emailactual = isset($usuario['Email']) ? $usuario['Email'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores enviados desde el formulario
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasenaNueva = $_POST['contrasena_nueva'];
    $contrasenaActual = $_POST['contrasena_actual'];

    // Comprobar si la contraseña actual no está vacía y es correcta
    if (!empty($contrasenaActual) && !$con->checkLogin($useractual, $contrasenaActual)) {
        $errores[] = "La contraseña actual es incorrecta";
    }

    // Comprobar si se ha cambiado el nick de usuario
    if ($usuario != $useractual && $con->existeUsuario($usuario)) {
        $errores[] = "Elige otro nombre de usuario";
    }

    // Comprobar si se ha cambiado el email
    if ($email != $emailactual && !$con->correoValido($email)) {
        $errores[] = "El email tiene un formato incorrecto";
    }

    if ($email != $emailactual && $con->existeCorreo($email)) {
        $errores[] = "El email ya está registrado";
    }

    if (empty($errores)) {
        if ($contrasenaNueva !== '') {
            // Editar al usuario con los datos actualizados, incluyendo la nueva contraseña
            $con->editarUsuario($usuario, $contrasenaNueva, $email, $IDUsuario);
        } else {
            // Editar al usuario con los datos actualizados, sin incluir una nueva contraseña
            $contrasenaNueva = null;
            $con->editarUsuario($usuario, $contrasenaNueva, $email, $IDUsuario);
        }

        $_SESSION['nickUsuario'] = $usuario;

        // Redirigir al usuario a la página de edición con un mensaje de éxito
        header("Location: editarusuario.php?usuario=" . $IDUsuario . "&success=editado");
        exit();
    }
}

echo $twig->render('editarusuario.twig', ['IDusuario' => $IDUsuario, 'usuario' => $usuario, 'boton' => $boton, 'errores' => $errores]);
?>
