# Web de Científicos

Esta es una aplicación web sobre científicos con las siguientes funcionalidades:

- Panel de comentarios oculto que se muestra al pulsar en un botón.
- Al desplegarse, se muestra un formulario para añadir comentarios.
- Se comprueban palabras prohibidas y se censuran con asteriscos (*) en los comentarios.
- Uso de Twig como motor de plantillas con una correcta separación MVC.
- Validación de datos que se guardan en el servidor PHP para evitar inyección de código, etc.
- Existen distintos roles de usuarios: anónimo, registrado, moderador, gestor, superusuario.
- Los usuarios pueden editar su información personal.
- Se hace uso de AJAX para las búsquedas (o una tecnología basada en JavaScript similar). El paso de información entre el servidor y JavaScript se hará en formato XML o JSON.

## Requisitos

- PHP 7.0 o superior
- Twig 2.0 o superior
- Servidor web (por ejemplo, Apache)

## Instalación

1. Clona este repositorio en tu máquina local.
2. Configura tu servidor web para que apunte al directorio raíz de la aplicación.
3. Configura la base de datos y actualiza la configuración en el archivo `config.php`.
4. Ejecuta el script de creación de la base de datos (`database.sql`).
5. Abre la aplicación en tu navegador y comienza a utilizarla.

## Contribución

Si deseas contribuir a este proyecto, por favor sigue los siguientes pasos:

1. Haz un fork de este repositorio.
2. Crea una rama con tu nueva funcionalidad (`git checkout -b nueva-funcionalidad`).
3. Realiza los cambios necesarios y realiza commits (`git commit -am 'Añade nueva funcionalidad'`).
4. Sube los cambios a tu repositorio remoto (`git push origin nueva-funcionalidad`).
5. Abre un pull request para que revisemos tus cambios.

## Licencia

Este proyecto está bajo la Licencia MIT. Para más información, consulta el archivo [LICENSE](LICENSE).
