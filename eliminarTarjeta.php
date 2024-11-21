<?php
include"conexion.php";
session_start();
$id=$_SESSION['user_id'];

//$id_tarjeta= $_SESSION['contador'];
//$_SESSION['id_tar'] = $_GET['id'];

$tarjeta=intval($_GET['id']);//Recuperacion del no de serie de la tarjeta

$sql="DELETE FROM tarjeta WHERE idUsuario=$id AND noSerie=$tarjeta";
$stmt=$conn->prepare($sql);
$stmt->execute();

/*$sql1="DELETE FROM basecentral WHERE noSerie=$tarjeta";
$stmt1=$conn->prepare($sql1);
$stmt1->execute();*/

if($stmt){
	header("location: /An2Bus/index.php");
}

?>