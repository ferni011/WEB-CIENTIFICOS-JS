<?php

session_start();

require_once "/usr/local/lib/php/vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
include("bd.php");

$con = new BD();

$mensaje = null;




$errores = array();

if (isset($_GET['opc'])) {
  $opcion = $_GET['opc'];
  if ($opcion == "login") {
    $nick = $_POST['nick'];
    $pass = $_POST['contraseña'];

    if ($con->checkLogin($nick, $pass)) {
      $_SESSION['nickUsuario'] = $nick;
      header('Location: ../portada');
      exit();
    } else {
      $errores[] = "INTRODUCE UNOS DATOS CORRECTOS";
    }
  } else if ($opcion == "registro") {
    $nick = $_POST['nick'];
    $pass = $_POST['contraseña'];
    $email = $_POST['email'];

    if (!empty($nick) && !empty($pass) && !empty($email)) {
      if ($con->correoValido($email)) {
        if ($con->existeCorreo($email)) {
          $errores[] = "ESE EMAIL YA ESTA REGISTRADO";
        } else {
          if ($con->existeUsuario($nick)) {
            $errores[] = "YA EXISTE ESE USUARIO";
          } else {
            $con->añadirUsuario($nick, $pass, $email);
            header('Location: ../login.php?registro=ok');
            exit();
          }
        }
      } else {
        $errores[] = "INTRODUZCA UN CORREO VÁLIDO";
      }
    } else {
      $errores[] = "INTRODUZCA TODOS LOS CAMPOS";
    }
  }
}

if (isset($_GET['registro']) && $_GET['registro'] == 'ok') {
  $mensaje = "¡Registro completado con éxito!, ahora inicia sesión";
}



echo $twig->render('login.twig', ['mensaje' => $mensaje,'errores'=>$errores]);
?>