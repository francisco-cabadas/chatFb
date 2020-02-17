<?php

function conectarBd() {
    $servidor = "localhost";
    $identificador = "root";
    $contrasenna = "";
    $bd = "minifb"; // Schema
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // Modo emulación desactivado para prepared statements "reales"
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
    ];

    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit("Error al conectar");
    }

    return $pdo;
}

// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar($url) {
    header("Location: $url");
    exit();
}



