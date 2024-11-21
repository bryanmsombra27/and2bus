<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<title>Perfil</title>-->
    <link rel="icon" href="img/logo.ico"/>
    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="css/estilos.css"/>
    <link rel="stylesheet" href="css/sideberMenu.css"/>
</head>
<body>
    <header class="soplas">
        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <?php
                $archivo = basename($_SERVER['PHP_SELF']); //con la funcion basename tomamos el nombre base de la pagina web  en la que nos encontramos, le pasamos una constante llamada SERVER para acceder a otra llama PHP_SELF para que nos regrese el nombre del archivo actual donde nos encontramos
                $pagina = str_replace(".php","",$archivo); // str_replace toma 3 parametros, el primero que es lo que vas a reemplazar, el segundo parametro por lo nuevo  que le vas a colocar, y el tercero  la fuente de los datos (lugar de procedencia de donde vienen los datos)
                if ($pagina == 'login' || $pagina == 'registro') {
                    echo "";
                }
                else{
                    echo '<div class="barra">
                            <nav class="navegacion">
                            <a href="./modificar.php">Modificar Datos</a>
                            <a href="./formRecuperarTar.php">Recuperar Tarjeta</a>
                            <a href="./logout.php">Cerrar Sesión</a>
                            </nav>
                        </div>';
                }
            ?>
        
    </header>