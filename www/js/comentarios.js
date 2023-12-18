$(document).ready(function () {
    var botonNuevoComentario = $("#enviar");
    var zonaDesplegable = $("#panel-lateral");
    var comentarioIntroducido = $("#comentario");
    var titulo = $(".nombrepredefinido");
    var botonPanel = $("#boton-panel");
    var abierto = false;
    var palabrasProhibidas = [];
    // Obtener referencia al campo de entrada y al formulario
    const keywordInput = $('#keywordInput');
    var resultadosDiv = $("#resultadosContainer");



    // Función para desplegar o cerrar la sección de comentarios
    function desplegar() {
        console.log("Botón presionado");
        if (!abierto) {
            zonaDesplegable.css("width", "45%");
            botonPanel.css("right", "45vw");
            abierto = true;
        } else {
            zonaDesplegable.css("width", "0%");
            botonPanel.css("right", "2vw");
            abierto = false;
        }
    }

    // Realiza una petición AJAX para obtener la lista de palabras censuradas
    $.ajax({
        url: 'obtenerpalabrascensuradas.php',
        type: 'GET',
        success: function (data) {
            palabrasProhibidas = JSON.parse(data);
            console.log('Lista de palabras censuradas:', palabrasProhibidas);
        },
        error: function () {
            console.log('Error al obtener la lista de palabras censuradas');
        }
    });

    // Función para comprobar las palabras prohibidas en tiempo real
    comentarioIntroducido.on("input", function () {
        var contenido = $(this).val();
        for (var i = 0; i < palabrasProhibidas.length; i++) {
            var palabraProhibida = palabrasProhibidas[i];
            var expresionRegular = new RegExp(palabraProhibida, "gi");
            contenido = contenido.replace(expresionRegular, "*".repeat(palabraProhibida.length));
        }
        $(this).val(contenido);
    });


    // Función para enviar la solicitud de búsqueda
    function buscarCientificos() {
        const keyword = keywordInput.val();

        // Verificar si el campo de entrada está vacío
        if (keyword.trim() === '') {
            resultadosDiv.empty();
            resultadosDiv.hide(); // Ocultar el contenedor
            return;
        } else {
            // Realizar la solicitud al servidor utilizando AJAX
            $.ajax({
                url: '../buscar.php',
                method: 'GET',
                data: { keyword: keyword },
                dataType: 'json',
                success: function (data) {
                    // Limpiar resultados anteriores
                    resultadosDiv.empty();

                    // Mostrar los resultados debajo de la barra de búsqueda
                    for (var i = 0; i < data.length; i++) {
                        var resultado = data[i];
                        var resultadoHTML = '<a href="' + "../cientifico/" + resultado.IDCientifico + '">' + resultado.Nombre + '</a>' + "<br>";
                        resultadosDiv.append(resultadoHTML);
                    }
                    resultadosDiv.show(); // Mostrar el contenedor
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    // Agregar evento de cambio al campo de entrada
    keywordInput.on('input', buscarCientificos);

    // Agregar evento de clic al botón de panel
    botonPanel.on("click", desplegar);

    // Agregar evento de clic al botón de nuevo comentario
    //botonNuevoComentario.on("click", nuevoComentario);
});
