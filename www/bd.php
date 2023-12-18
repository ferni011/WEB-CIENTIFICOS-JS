<?php
class BD
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli("database", "fer", "practicasSIBW", "SIBW");
        if ($this->mysqli->connect_errno) {
            echo ("Error en la conexión " . $this->mysqli->connect_error);
        }
    }



    public function getCientificos()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM CIENTIFICOS");
        $stmt->execute();
        $resultado = $stmt->get_result();

        $arraycientificos = array();
        while ($cientifico = $resultado->fetch_assoc()) {
            $arraycientificos[] = $cientifico;
        }
        return $arraycientificos;
    }

    public function getInfoCientifico($idCient)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM CIENTIFICOS WHERE IDCientifico=?");
        $stmt->bind_param("i", $idCient);
        $stmt->execute();

        $informacion = array();

        $cientifico = $stmt->get_result();
        if ($cientifico->num_rows > 0) {
            $categoria = $cientifico->fetch_assoc();
            $informacion = array(
                'nombre' => $categoria['Nombre'],
                'fechanac' => $categoria['FechaNacimiento'],
                'lugar' => $categoria['Lugar'],
                'biografia' => $categoria['Biografia'],
                'web' => $categoria['Web'],
                'facebook' => $categoria['Facebook'],
                'twitter' => $categoria['Twitter'],
                'fechamuerte' => $categoria['FechaMuerte'],
                'publicado' => $categoria['Publicado']
            );
        }

        return $informacion;
    }

    public function getFotosCientifico($idCient)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM IMAGENES WHERE IDCientifico=?");
        $stmt->bind_param("i", $idCient);
        $stmt->execute();

        $fotos = array();

        $cientifico = $stmt->get_result();
        if ($cientifico->num_rows > 0) {
            while ($categoria = $cientifico->fetch_assoc()) {
                $fotos[] = array(
                    'ruta' => $categoria['Ruta'],
                    'descripcion' => $categoria['Descripcion']
                );
            }
        }

        return $fotos;
    }


    public function getComentariosCientifico($idCient)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM COMENTARIOS WHERE IDCientifico=?");
        $stmt->bind_param("i", $idCient);
        $stmt->execute();

        $comentarios = array();

        $cientifico = $stmt->get_result();
        if ($cientifico->num_rows > 0) {
            while ($categoria = $cientifico->fetch_assoc()) {
                $comentarios[] = array(
                    'nombre' => $categoria['Nombre'],
                    'email' => $categoria['Email'],
                    'texto' => $categoria['Texto'],
                    'fecha' => $categoria['Fecha'],
                    'IDComentario' => $categoria['IDComentario'],
                    'Editado' => $categoria['Editado']

                );
            }
        }

        return $comentarios;
    }



    public function getProhibidas()
    {
        // realiza una consulta SQL para obtener la lista de palabras censuradas
        $resultado = $this->mysqli->query('SELECT PALABRA FROM PROHIBIDAS');
        // crea un array con la lista de palabras censuradas
        $palabrasCensuradas = array();
        while ($row = $resultado->fetch_assoc()) {
            $palabrasCensuradas[] = $row['PALABRA'];
        }
        return $palabrasCensuradas;
    }

    function getUsuario($user)
    {
        $stmt = $this->mysqli->prepare("SELECT * from USUARIOS where Usuario=?");
        $stmt->bind_param("s", $user);
        $stmt->execute();

        $resultado = $stmt->get_result();

        $usuario = null;

        while ($res = $resultado->fetch_assoc()) {
            $usuario = $res;
        }
        return $usuario;
    }

    function getUsuarioID($IDUsuario)
    {
        $stmt = $this->mysqli->prepare("SELECT * from USUARIOS where ID=?");
        $stmt->bind_param("i", $IDUsuario);
        $stmt->execute();

        $resultado = $stmt->get_result();

        $usuario = null;

        while ($res = $resultado->fetch_assoc()) {
            $usuario = $res;
        }
        return $usuario;

    }

    // Devuelve true si existe un usuario con esa contraseña
    public function checkLogin($nick, $pass)
    {
        $usuario = $this->getUsuario($nick);
        if ($usuario != null && password_verify($pass, $usuario['Contraseña'])) {
            return true;
        }

        return false;
    }

    public function añadirUsuario($nick, $pass, $email)
    {
        // Genera un hash de la contraseña
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        // Prepara la consulta SQL con una sentencia preparada
        $stmt = $this->mysqli->prepare("INSERT INTO USUARIOS (Usuario, Contraseña, TipoUsuario, Email) VALUES (?, ?, 'REGISTRADO', ?)");

        // Vincula los parámetros a la sentencia preparada
        $stmt->bind_param("sss", $nick, $hashedPass, $email);

        // Ejecuta la sentencia preparada
        $stmt->execute();

        // Cierra la sentencia preparada
        $stmt->close();
    }

    public function correoValido($correo)
    {
        if (preg_match("/^([0-9a-z\.\_]+)+@{1}([0-9a-z]+\.)+[0-9a-z]+$/i", $correo) == 1)
            return true;
        else
            return false;
    }

    public function editarUsuario($nick, $pass, $email, $id)
    {
        // Prepara la consulta SQL con una sentencia preparada
        $stmt = $this->mysqli->prepare("UPDATE USUARIOS SET Usuario = ?, Email = ? WHERE ID = ?");

        if ($pass !== null) {
            // Genera un hash de la contraseña
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            // Si $pass no es nulo, vincula los parámetros adicionales para la contraseña
            $stmt = $this->mysqli->prepare("UPDATE USUARIOS SET Usuario = ?, Contraseña = ?, Email = ? WHERE ID = ?");
            $stmt->bind_param("sssi", $nick, $hashedPass, $email, $id);
        } else {
            // Si $pass es nulo, vincula los parámetros sin la contraseña
            $stmt->bind_param("ssi", $nick, $email, $id);
        }

        // Ejecuta la sentencia preparada
        $stmt->execute();

        // Cierra la sentencia preparada
        $stmt->close();
    }



    public function existeCorreo($correo)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) as count FROM USUARIOS WHERE email = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $stmt->close();

        return $count > 0 ? true : false;
    }

    public function existeUsuario($usuario)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) as count FROM USUARIOS WHERE Usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $stmt->close();

        return $count > 0;
    }

    public function añadeComentario($cientifico, $comentario, $usuario)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO COMENTARIOS (Nombre, Email, Texto, Fecha, IDCientifico) VALUES (?, ?, ?, ?, ?)");
        $nombre = $usuario['Usuario'];
        $email = $usuario['Email'];
        $fecha = date('Y-m-d H:i:s');
        $stmt->bind_param("sssss", $nombre, $email, $comentario, $fecha, $cientifico);
        $stmt->execute();
    }


    public function existeComentario($idComentario)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) FROM COMENTARIOS WHERE IDComentario = ?");
        $stmt->bind_param("i", $idComentario);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            return true;
        }
        return false;
    }

    public function borraComentario($idComentario)
    {
        if ($this->existeComentario($idComentario)) {
            // Borrar el comentario de la base de datos
            $stmt = $this->mysqli->prepare("DELETE FROM COMENTARIOS WHERE IDComentario = ?");
            $stmt->bind_param("i", $idComentario);
            $stmt->execute();
        }

    }

    public function editaComentario($idComentario, $textoEditado)
    {
        if ($this->existeComentario($idComentario)) {
            $stmt = $this->mysqli->prepare("UPDATE COMENTARIOS SET Texto = ?, Editado = 1 WHERE IDComentario = ?");
            $stmt->bind_param("si", $textoEditado, $idComentario);
            $stmt->execute();
            // Verificar si se realizó la actualización correctamente
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function obtenerTodosComentarios()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM COMENTARIOS");
        $stmt->execute();
        $result = $stmt->get_result();

        $comentarios = array();

        while ($row = $result->fetch_assoc()) {
            $comentarios[] = $row;
        }

        return $comentarios;
    }


    public function buscarComentarios($keyword)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM COMENTARIOS WHERE Texto LIKE ?");
        $keyword = "%{$keyword}%";
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
        $result = $stmt->get_result();

        $comentarios = array();

        while ($row = $result->fetch_assoc()) {
            $comentarios[] = $row;
        }

        return $comentarios;
    }

    public function buscarCientificosPorHashtag($hashtag)
    {
        $keyword = '%' . $hashtag . '%'; // Agrega caracteres comodín para buscar coincidencias parciales

        $stmt = $this->mysqli->prepare("
            SELECT DISTINCT C.*
            FROM CIENTIFICOS C
            LEFT JOIN HASHTAGS H ON C.IDCientifico = H.IDCientifico
            WHERE C.Nombre LIKE ? OR C.Biografia LIKE ? OR H.Hashtag LIKE ?
        ");
        $stmt->bind_param("sss", $keyword, $keyword, $keyword);
        $stmt->execute();

        $result = $stmt->get_result();

        $cientificos = array();

        while ($row = $result->fetch_assoc()) {
            $cientificos[] = $row;
        }

        $stmt->close();

        return $cientificos;
    }




    public function insertarFoto($idCientifico, $ruta, $descripcion)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO IMAGENES (IDCientifico, Ruta, Descripcion) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $idCientifico, $ruta, $descripcion);
        $stmt->execute();
    }


    private function eliminarImagenesCientifico($IDCientifico)
    {
        // Obtener las rutas de las imágenes asociadas al científico
        $fotos = $this->getFotosCientifico($IDCientifico);

        // Eliminar las filas de la base de datos
        $stmt = $this->mysqli->prepare("DELETE FROM IMAGENES WHERE IDCientifico = ?");
        $stmt->bind_param("i", $IDCientifico);
        $stmt->execute();

        // Eliminar las imágenes del sistema de archivos
        foreach ($fotos as $foto) {
            $rutaImagen = $foto['ruta'];
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }
    }

    public function eliminarHashtagsCientifico($IDCientifico)
    {
        // Eliminar los hashtags del científico en la base de datos
        $stmt = $this->mysqli->prepare("DELETE FROM HASHTAGS WHERE IDCientifico = ?");
        $stmt->bind_param("i", $IDCientifico);
        $stmt->execute();
    }


    public function borrarCientifico($idCientifico)
    {
        $this->eliminarImagenesCientifico($idCientifico);
        $this->eliminarHashtagsCientifico($idCientifico);
        // Eliminar la fila del científico en la tabla "CIENTIFICOS"
        $stmt = $this->mysqli->prepare("DELETE FROM CIENTIFICOS WHERE IDCientifico = ?");
        $stmt->bind_param("i", $idCientifico);
        $stmt->execute();
    }


    public function getMaxIDCientifico()
    {
        // Obtener el próximo ID de científico disponible
        $result = $this->mysqli->query("SELECT MAX(IDCientifico) AS max_id FROM CIENTIFICOS");
        $row = $result->fetch_assoc();
        $idcient = $row['max_id'] + 1;
        return $idcient;
    }

    public function insertarCientifico($nombre, $fechaNacimiento, $lugar, $biografia, $web, $facebook, $twitter, $fechaMuerte, $fotoPortada, $descripcionPortada, $fotoExtra1, $descripcionExtra1, $fotoExtra2, $descripcionExtra2, $idcient, $publicado)
    {
        // Preparar la consulta SQL
        $stmt = $this->mysqli->prepare("INSERT INTO CIENTIFICOS (IDCientifico, Nombre, FechaNacimiento, Lugar, Biografia, Web, Facebook, Twitter, FechaMuerte, FotoPortada, Publicado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Vincular los parámetros con los valores
        $stmt->bind_param("isssssssssi", $idcient, $nombre, $fechaNacimiento, $lugar, $biografia, $web, $facebook, $twitter, $fechaMuerte, $fotoPortada, $publicado);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si la consulta se ejecutó correctamente
        if ($stmt->affected_rows > 0) {
            $this->insertarFoto($idcient, $fotoPortada, $descripcionPortada);

            // Insertar la foto extra 1 (si existe)
            if (!empty($fotoExtra1) && !empty($descripcionExtra1)) {
                $this->insertarFoto($idcient, $fotoExtra1, $descripcionExtra1);
            }

            // Insertar la foto extra 2 (si existe)
            if (!empty($fotoExtra2) && !empty($descripcionExtra2)) {
                $this->insertarFoto($idcient, $fotoExtra2, $descripcionExtra2);
            }

            return true; // El científico se insertó correctamente
        } else {
            return false; // Ocurrió un error al insertar el científico
        }
    }




    public function editarCientificoTexto($nombre, $fechaNacimiento, $lugar, $biografia, $web, $facebook, $twitter, $fechaMuerte, $fotoPortada, $descripcionPortada, $fotoExtra1, $descripcionExtra1, $fotoExtra2, $descripcionExtra2, $IDCientifico, $publicado)
    {
        // Preparar la consulta SQL
        if (!empty($fotoPortada)) {
            $stmt = $this->mysqli->prepare("UPDATE CIENTIFICOS SET Nombre = ?, FechaNacimiento = ?, Lugar = ?, Biografia = ?, Web = ?, Facebook = ?, Twitter = ?, FechaMuerte = ?, FotoPortada = ?, Publicado = ? WHERE IDCientifico = ?");
            $stmt->bind_param("sssssssssii", $nombre, $fechaNacimiento, $lugar, $biografia, $web, $facebook, $twitter, $fechaMuerte, $fotoPortada, $publicado, $IDCientifico);
        } else {
            $stmt = $this->mysqli->prepare("UPDATE CIENTIFICOS SET Nombre = ?, FechaNacimiento = ?, Lugar = ?, Biografia = ?, Web = ?, Facebook = ?, Twitter = ?, FechaMuerte = ?, Publicado = ? WHERE IDCientifico = ?");
            $stmt->bind_param("ssssssssii", $nombre, $fechaNacimiento, $lugar, $biografia, $web, $facebook, $twitter, $fechaMuerte, $publicado, $IDCientifico);
        }
        $stmt->execute();

        // Verificar si la consulta se ejecutó correctamente
        if ($stmt->affected_rows > 0) {
            // Insertar la foto de portada (si se proporcionó una nueva foto)
            if (!empty($fotoPortada)) {
                $this->eliminarImagenesCientifico($IDCientifico);
                // Insertar la nueva foto de portada
                $this->insertarFoto($IDCientifico, $fotoPortada, $descripcionPortada);
            }

            // Insertar la foto extra 1 (si se proporcionó una nueva foto)
            if (!empty($fotoExtra1) && !empty($descripcionExtra1)) {
                // Insertar la nueva foto extra 1
                $this->insertarFoto($IDCientifico, $fotoExtra1, $descripcionExtra1);
            }

            // Insertar la foto extra 2 (si se proporcionó una nueva foto)
            if (!empty($fotoExtra2) && !empty($descripcionExtra2)) {
                // Insertar la nueva foto extra 2
                $this->insertarFoto($IDCientifico, $fotoExtra2, $descripcionExtra2);
            }

            return true; // El científico se actualizó correctamente
        } else {
            return false; // Ocurrió un error al actualizar el científico
        }
    }



    public function añadeHashtag($idCientifico, $hashtag)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO HASHTAGS (IDCientifico, Hashtag) VALUES (?, ?)");
        $stmt->bind_param("is", $idCientifico, $hashtag);
        $stmt->execute();
        $stmt->close();
    }


    public function getUsuarios()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM USUARIOS");
        $stmt->execute();
        $result = $stmt->get_result();

        $usuarios = array();

        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    public function getRolUsuario($IDUsuario)
    {
        $stmt = $this->mysqli->prepare("SELECT TipoUsuario FROM USUARIOS WHERE ID = ?");
        $stmt->bind_param("i", $IDUsuario);
        $stmt->execute();
        $stmt->bind_result($rolUsuario); // Enlazar el resultado a una variable
        $stmt->fetch(); // Recuperar el resultado
        $stmt->close();

        return $rolUsuario; // Devolver el rol del usuario
    }


    public function cambiarRolUsuario($IDUsuario, $nuevoRol)
    {
        $stmt = $this->mysqli->prepare("UPDATE USUARIOS SET TipoUsuario = ? WHERE ID = ?");
        $stmt->bind_param("si", $nuevoRol, $IDUsuario);
        $stmt->execute();
        $stmt->close();
    }

    public function getSuperUsuarios()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM USUARIOS WHERE TipoUsuario = 'SUPERUSUARIO'");
        $stmt->execute();
        $result = $stmt->get_result();
        $superUsuarios = array();
        while ($row = $result->fetch_assoc()) {
            $superUsuarios[] = $row;
        }
        return $superUsuarios;
    }

    //Buscamos todos los cientificos
    public function buscarCientificos($keyword)
    {
        $keyword = '%' . $keyword . '%';

        $stmt = $this->mysqli->prepare("
        SELECT DISTINCT C.*
        FROM CIENTIFICOS C
        LEFT JOIN HASHTAGS H ON C.IDCientifico = H.IDCientifico
        WHERE C.Nombre LIKE ? OR C.Biografia LIKE ? OR H.Hashtag LIKE ?
    ");
        $stmt->bind_param("sss", $keyword, $keyword, $keyword);
        $stmt->execute();

        $result = $stmt->get_result();

        $cientificos = array();

        while ($row = $result->fetch_assoc()) {
            $cientificos[] = $row;
        }

        $stmt->close();

        return $cientificos;
    }

    //Buscamos los cientificos publicados
    public function buscarCientificosPublicados($keyword)
    {
        $keyword = '%' . $keyword . '%';

        $stmt = $this->mysqli->prepare("
        SELECT DISTINCT C.*
        FROM CIENTIFICOS C
        LEFT JOIN HASHTAGS H ON C.IDCientifico = H.IDCientifico
        WHERE (C.Nombre LIKE ? OR C.Biografia LIKE ? OR H.Hashtag LIKE ?) AND C.Publicado = 1
    ");
        $stmt->bind_param("sss", $keyword, $keyword, $keyword);
        $stmt->execute();

        $result = $stmt->get_result();

        $cientificos = array();

        while ($row = $result->fetch_assoc()) {
            $cientificos[] = $row;
        }

        $stmt->close();

        return $cientificos;
    }

    //Devuelve los cientificos publicados
    public function getCientificosPublicados()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM CIENTIFICOS WHERE Publicado = 1");
        $stmt->execute();
        $resultado = $stmt->get_result();

        $arrayCientificos = array();
        while ($cientifico = $resultado->fetch_assoc()) {
            $arrayCientificos[] = $cientifico;
        }

        return $arrayCientificos;
    }



}




?>