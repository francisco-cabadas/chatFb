<?php

require_once("utilidades.php");


session_start();

// si hay session iniciada, no debo ver esta pagina, redirecciono al usuario.
if(isset($_SESSION["identificador"])){

    redireccionar("ver-muro.php");
}

if(isset($_REQUEST["error"])){
echo ("Error de usuario y/o contraseña, por favor introduzca un usuario y contraseña valido");
}


$pdo=conectarBd();

?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        .contenidoPrincipal{

            text-align: center;
        }
        input{
            margin-top: 3px;
        }


    </style>
</head>
<body>
<div class="contenidoPrincipal">
    <h2>Inicia sesion </h2>
    <form action="ver-muro.php" method="post" >
        <input type="text" name="identificador" placeholder="usuario"> <br>
        <input type="password" name="contrasenna" placeholder="contraseña"><br>
        <input type="submit"><br>
        <label><b>Recuérdame</b><input type="checkbox" name="recuerdame"></label>
    </form>

</div>




</body>

</html>

