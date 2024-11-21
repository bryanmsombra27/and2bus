<?php include"layouts/header.php";
session_start();
$_SESSION['user_id'];
?>
<head>
    <title>Recuperacion de tarjeta</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<center>
		<header><h1>Recuperación de tarjeta</h1></header>
		<form action="recuperarTar.php" method="POST" id="recuperar">
            
            <input type="text" name="noSerie" placeholder="000" required>
            <div class="container">
            <input type="submit" value="Recuperar" class="btn2">
           <!-- <button>  --> <a href="index.php" class="cancelar restaurar">Volver</a> <!--</button> -->
            </div>
        </form>
        <?php
        require"funcion.php";
        //Recuperación de mensaje "Error, esta tarjeta le pertenece a otro usuario"
        if(isset($_SESSION['otroUsr'])){
        	echo $_SESSION['otroUsr'];
        }
        otroUsr();
        //Termina primer recuperacion de mensaje

        //Recuperación de mensje "Error, esta tarjeta ya se encuentra disponible en sus registros"
        if(isset($_SESSION['existe'])){
        	echo $_SESSION['existe'];
        }
        existe();
        //Termina segunda recuperación de mensaje

        //Recuperación de mensaje "Su tarjeta a sido recuperada con exito"
        if(isset($_SESSION['recuperacion'])){
        	echo $_SESSION['recuperacion'];
        }
        recuperacion();
        //Termina tercera recuperación de mensaje

        //Recuperación de mensaje "Esta tarjeta no existe"
        if(isset($_SESSION['null'])){
        	echo $_SESSION['null'];
        }
        null();
        //Termina cuarta recuperación de mensaje

        ?>
    </center>
   
<?php include 'layouts/footer.php'; ?>