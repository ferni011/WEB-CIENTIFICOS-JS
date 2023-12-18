<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$con = new BD();

$varsParaTwig = [];


if(isset($_SESSION['nickUsuario'])){
    $usuario = $con->getUsuario($_SESSION['nickUsuario']);
    $varsParaTwig['usuario']=$usuario;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = array();

    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $fechaNacimiento = date('Y-m-d', strtotime($_POST['fecha_nacimiento']));
    $lugar = $_POST['lugar'];
    $biografia = $_POST['biografia'];
    $web = $_POST['web'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $fechaMuerte = date('Y-m-d', strtotime($_POST['fecha_muerte']));
    $descripcionPortada = $_POST['descripcionPortada'];
    $idcient = $con->getMaxIDCientifico();
    $publicado = isset($_POST['publicado']) ? 1 : 0; 
          

    // Validar y procesar la foto de portada
    if (isset($_FILES['foto_portada'])) {
        $file_name = $_FILES['foto_portada']['name'];
        $file_size = $_FILES['foto_portada']['size'];
        $file_tmp = $_FILES['foto_portada']['tmp_name'];
        $file_type = $_FILES['foto_portada']['type'];
        $file_parts = explode('.', $_FILES['foto_portada']['name']);
        $file_ext = strtolower(end($file_parts));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG para la foto de portada.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Tamaño del fichero demasiado grande para la foto de portada.';
        }

        if (empty($errors)) {
            $upload_path = "logos/$nombre" . $file_name;
            move_uploaded_file($file_tmp, $upload_path);
            $varsParaTwig['imagen'] = $upload_path;
        }
    }

    // Validar y procesar las fotos extras (solo si se han seleccionado)
    if (isset($_FILES['fotoextra1']) && $_FILES['fotoextra1']['name'] !== '') {
        $file_name = $_FILES['fotoextra1']['name'];
        $file_size = $_FILES['fotoextra1']['size'];
        $file_tmp = $_FILES['fotoextra1']['tmp_name'];
        $file_type = $_FILES['fotoextra1']['type'];
        $file_parts = explode('.', $_FILES['fotoextra1']['name']);
        $file_ext = strtolower(end($file_parts));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG para la Foto Extra 1.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Tamaño del fichero demasiado grande para la Foto Extra 1.';
        }

        if (empty($errors)) {
            $upload_path = "logos/$nombre" . $file_name;
            move_uploaded_file($file_tmp, $upload_path);
            $varsParaTwig['fotoextra1'] = $upload_path;
            $varsParaTwig['descripcion_foto_extra_1'] = $_POST['descripcion_foto_extra_1'];
        }
    } else {
        $varsParaTwig['fotoextra1'] = null;
        $varsParaTwig['descripcion_foto_extra_1'] = null;
    }

    if (isset($_FILES['fotoextra2']) && $_FILES['fotoextra2']['name'] !== '') {
        $file_name = $_FILES['fotoextra2']['name'];
        $file_size = $_FILES['fotoextra2']['size'];
        $file_tmp = $_FILES['fotoextra2']['tmp_name'];
        $file_type = $_FILES['fotoextra2']['type'];
        $file_parts = explode('.', $_FILES['fotoextra2']['name']);
        $file_ext = strtolower(end($file_parts));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG para la Foto Extra 2.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Tamaño del fichero demasiado grande para la Foto Extra 2.';
        }

        if (empty($errors)) {
            $upload_path = "logos/$nombre" . $file_name;
            move_uploaded_file($file_tmp, $upload_path);
            $varsParaTwig['fotoextra2'] = $upload_path;
            $varsParaTwig['descripcion_foto_extra_2'] = $_POST['descripcion_foto_extra_2'];
        }
    } else {
        $varsParaTwig['fotoextra2'] = null;
        $varsParaTwig['descripcion_foto_extra_2'] = null;
    }

    if (empty($errors)) {
        //Insertar el científico en la base de datos
        $con->insertarCientifico($nombre, $fechaNacimiento, $lugar, $biografia, $web, $facebook, $twitter, $fechaMuerte, $varsParaTwig['imagen'], $descripcionPortada, $varsParaTwig['fotoextra1'], $varsParaTwig['descripcion_foto_extra_1'], $varsParaTwig['fotoextra2'], $varsParaTwig['descripcion_foto_extra_2'], $idcient,$publicado);
        // Obtener el texto de los hashtags del formulario
        $hashtagsInput = $_POST['hashtags'];

        // Separar los hashtags en un array utilizando la coma como delimitador
        $hashtagsArray = explode(',', $hashtagsInput);

        // Eliminar los espacios en blanco alrededor de cada hashtag
        $hashtagsCleaned = array_map('trim', $hashtagsArray);

        // Recorrer el array de hashtags limpios
        foreach ($hashtagsCleaned as $hashtag) {
            // Llamar al método añadeHashtag de la clase BD
            $con->añadeHashtag($idcient, $hashtag);
        }

        header("Location: portada");
        exit();
    }

    $varsParaTwig['errores'] = $errors;
}


echo $twig->render('anadircientifico.twig', $varsParaTwig);
?>