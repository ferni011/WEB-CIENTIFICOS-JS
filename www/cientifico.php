<?php
session_start();

#Cargamos las dependencias
require_once "/usr/local/lib/php/vendor/autoload.php";
#Incluimos el fichero de la base de datos
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
$usuario = null;
#Realizamos una conexión a la base de datos
$con = new BD();

$IDcientifico = null;

#Miramos si se obtiene un valor en cientifico
if (isset($_GET['cientifico'])) {
    #Comprobamos que lo que se obtiene es un entero
    $IDcientifico = filter_var($_GET['cientifico'], FILTER_VALIDATE_INT);
    #Si se obtiene un entero
    if ($IDcientifico !== false) {

        #Obtenemos el cientifico,sus fotos y sus comentarios
        $cientifico = $con->getInfoCientifico($IDcientifico);
        $fotos = $con->getFotosCientifico($IDcientifico);
        $comentarios = $con->getComentariosCientifico($IDcientifico);
        #Cargamos el estilo de cientifico por defecto
        $estilo = "css/estilo-cientifico.css";
        #Usamos un bool para ver si enseñamos comentarios
        $ensenacomentarios = true;

        #SI en la url aparece imprimir, usamos el estilo de imprimir y no mostramos comentarios
        if (isset($_GET['imprimir'])) {
            $estilo = "css/cientifico_imprimir.css";
            $ensenacomentarios = false;
        }
    }

}

if (isset($_SESSION['nickUsuario'])) {
    $usuario = $con->getUsuario($_SESSION['nickUsuario']);
    $boton=true;
    if (isset($_POST['comentario'])) {
        $comentario = $_POST['comentario'];
        $con->añadeComentario($IDcientifico, $comentario, $usuario);
        header("Location: ./$IDcientifico");
        exit();
    } else if (isset($_POST['borrarCientifico'])) {

        $con->borrarCientifico($IDcientifico);
        header("Location: ../portada");
        exit();
    }
}else{
    $boton=false;
}



#Pasamos lo que vamos a utilizar
echo $twig->render("cientifico.twig", ['cientifico' => $cientifico, 'fotos' => $fotos, 'comentarios' => $comentarios, 'estilo' => $estilo, 'idcient' => $IDcientifico, 'muestracomentarios' => $ensenacomentarios, 'session' => $usuario,'boton'=>$boton]);

?>