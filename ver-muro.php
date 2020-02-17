<?php

require_once("utilidades.php");

session_start();
$pdo = conectarBd();


//comprobamos si hay sesion iniciada, si no la hay comprobará usuario y contraseña.
if (!isset($_SESSION["identificador"]) && !isset($_COOKIE["identificador"])) {

    $identificador = $_REQUEST['identificador'];
    $contrasenna = $_REQUEST['contrasenna'];

    //consulta para la validación de usuario
    $consultaAccesoBdd = 'SELECT id FROM usuario WHERE BINARY identificador= ?   AND BINARY contrasenna= ? ';

    // ejecución de consulta de validación
    $validacion = $pdo->prepare($consultaAccesoBdd);
    $validacion->execute([$identificador, $contrasenna]);

    //contador de filas aceptadas, si devuelve 1 correcto, distinto de 1 acceso denegado.
    $cuenta = $validacion->rowCount();

    if ($cuenta == 1) {

        $_SESSION["identificador"] = $_REQUEST["identificador"];

    } else {
        redireccionar("inicio.php");
    }
    if (isset($_REQUEST["recuerdame"])) {

        $recuerdame = true;
    } else {
        $recuerdame = false;
    }
    //si viene "recuerdame" de inicio.php le asigno una cookie
    if ($recuerdame) {
        $cookieUsuario = $identificador . mt_rand(0, 99999);
        $consultaInsertarCookie = "UPDATE usuario SET codigoCookie = ? WHERE identificador";
        $insertarCookie = $pdo->prepare($consultaInsertarCookie);
        $insertarCookie->execute([$cookieUsuario, $identificador,]);

        setcookie("identificador", $_SESSION["identificador"], time() + 360);
        setcookie("cookieUsuario", $cookieUsuario, time() + 360);
    }


} else if (isset($_COOKIE["identificador"])) {

    if (isset($_COOKIE["identificador"])) {
        setcookie("identificador", $_COOKIE["identificador"], time() + 360);
        setcookie("cookieUsuario", $_COOKIE["cookieUsuario"], time() + 360);
    } else {
        redireccionar("inicio.php");
    }
}


//consulta y proceso para guardar mensaje de la bdd
if (isset($_REQUEST["texto"])) {
    $consultaInsertarTexto = "INSERT INTO mensajes (identificador, texto) values (?,?) ";
    $texto = $_REQUEST["texto"];
    $insertarTexto = $pdo->prepare($consultaInsertarTexto);
    if (isset($_SESSION["identificador"])) {
        $insertarTexto->execute([$_SESSION["identificador"], $texto]);
    } else {
        $insertarTexto->execute([$_COOKIE["identificador"], $texto]);
    }


}


// consulta que muestra mensajes
$consultaMostrarMensajes = "SELECT * FROM mensajes order by fecha ASC";
$mensajes = $pdo->prepare($consultaMostrarMensajes);
$mensajes->execute();
$mensajes = $mensajes->fetchAll()
?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        #columnasNombres {

            font-size: 20px;
            color: mediumblue;
            text-decoration: underline;
        }

        .contenidoMensajes {
            width: 100%;
        }

        table {

            width: 100%;
            border: 2px solid black;
            border-collapse: collapse;
        }

        table tr, td {
            height: auto;
            width: 30%;
        }

    </style>
</head>
<body>
    <div class="contenidoMensajes">

        <?php foreach ($mensajes as $fila) { ?>
            <table>
                <tr id="columnasNombres">
                    <td>Usuario</td>
                    <td>Mensaje</td>
                    <td>Fecha</td>
                </tr>
                <br>
                <tr>
                    <td> <?php echo $fila["identificador"]; ?> </td>
                    <td> <?php echo $fila["texto"]; ?> </td>
                    <td> <?php echo $fila["fecha"]; ?> </td>
                </tr>
            </table>
        <?php } ?>
    </div>
    <div class="fromMensajes" style="margin-top: 5px">
        <form>
            <input type="text" name="texto">
            <input type="submit" value="enviar">
        </form>
    </div>

    <div>
        <a href="cerrar-sesion.php">cerrar sesion actual</a>
    </div>

</body>

</html>