<?php
session_start();
$_SESSION['user_id'];
$id= $_SESSION['user_id'];
echo $id;
echo "Tu id de usuario es: ". $_SESSION['user_id'];
require 'conexion.php';
$modnombre=$_POST['modnombre'];
$modaP=$_POST['modaP'];
$modaM=$_POST['modaM'];
$modtel=$_POST['modtel'];
$modcorreo=$_POST['modcorreo'];

$records = $conn->prepare("UPDATE usuario SET nombre = '$modnombre', apellidoPaterno = '$modaP',apellidoMaterno = '$modaM', telefono = '$modtel', correoElectronico = '$modcorreo' WHERE idUsuario=$id ");
$records->execute();

	if($records){
	    echo $_SESSION['exito']="Datos modificados con exito";
	}else{
	    echo $_SESSION['error']="Error al modificar los datos";
	}
?>
<br><br>

<a href="index.php">Volver al perfil principal</a>

<?php header('Location: modificar.php');?>

