<?php
function salidaCorrecta($opcion, $texto) {
    return '<div class="console-container-resp-valida">
                <h1>'.$opcion.'</h1>
                <p class="status-message">'.$texto.'</p>
                <a href="index.php" style="color: white;">Volver al menú</a>
            </div>';
}

function salidaInvalida($opcion,$texto ) {
    return '<div class="console-container-resp-invalida">
                <h1>'.$opcion.'</h1>
                <p class="error-message">'.$texto.'</p>
                <a href="index.php" style="color: white;">Volver al menú</a>
            </div>';
}

function validarParametro($param) {
    // Expresión regular para permitir solo letras, números, guiones y guiones bajos
    return preg_match('/^[a-zA-Z0-9_\-\/\.,\'"]+$/', $param);


}



?>
