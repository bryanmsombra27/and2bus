<?php
include'conexion.php';

session_start(); //Inicio de sesión

$id=$_SESSION['user_id']; //Asignación a la varible $id el id de la sesión activa
$noSerie=$_POST['noSerie']; //Asignación a la varible $noSerie el numero de serie de la tarjeta a registrar 


//Inicia consulta de verificación. 
$mods=$conn->prepare("SELECT `noSerie`,`idUsuario` FROM `basecentral` WHERE `noSerie`='$noSerie' ");//Consulta en BD para determinar  si existe algun registro de tarjeta con el no de serie que intentamos realizar
$mods->bindParam(':id', $_SESSION['user_id']);
$mods->execute(); //Ejecución de la consulta
$res = $mods->fetch(PDO::FETCH_ASSOC);


$noSerieVer=$res['noSerie']; //Asignamos a la varible $noSerieVer el no de serie recuperado de la consulta anterior
$idVer=$res['idUsuario']; //Asignamos a la varible $idVer el id recuperado de la consulta anterior
//Termina consulta de verificación.

$mods1=$conn->prepare("SELECT `noSerie`,`idUsuario` FROM `tarjeta` WHERE `noSerie`='$noSerie'");
$mods1->bindParam(':id',$_SESSION['user_id']);
$mods1->execute();
$res1=$mods1->fetch(PDO::FETCH_ASSOC);

$noSerieDup=$res1['noSerie'];
$idUsuarioDup=$res1['idUsuario'];

if($noSerie==$noSerieVer && $id!=$idVer){ //Comparamos los valores de los datos compartidos por POST con los recuperados mediante la consulta antes descrita
	$ver=1;
	if($ver==1){
		$_SESSION['verificacion']="Error, la tarjeta que intenta registrar le pertenece a otro usuario";
	}
	header('location: /An2Bus/index.php');
	//echo "Error al registrar, esta tarjeta le pertenece a otro usuario";
}	else
		if($noSerie==$noSerieVer && $noSerieDup==null){ 
			$delate=1;
			if($delate==1){
				$_SESSION['delate']="Esta tarjeta ya a sido eliminada de su registro";
				$_SESSION['delatee']="Vaya al apartado recuperar tarjeta para tratar de recuperarla";
			}
			header('location: /An2Bus/index.php');
	//echo "Esta tarjeta ya a sido eliminada de su registro.";
	//echo "Vaya al apartado recuperar tarjeta para tratar de recuperarla";
	}else
		if($noSerie==$noSerieVer && $noSerie==$noSerieDup && $id==$idUsuarioDup){
			$Dupp=1;
			if($Dupp==1){
				$_SESSION['Dupp']="Error al registrar, tarjeta duplicada";
			}
			header('location: /An2Bus/index.php');
			//echo "No se puede registrar dos veces la misma tarjeta";

		}else{//Si no se cumple las condiciónes anterior se realizan las siguientes instrucciones sql e insertamos en BD  
		$registro=1;
		if($registro==1){
			$_SESSION['registro']="Tarjeta registrada con exito";
		}
		//Inserción de datos en la tabla tarjeta
		  $sql = "INSERT INTO `tarjeta`(`noSerie`, `idUsuario`, `saldo`, `ultimaFecha`) VALUES ('$noSerie','$id','','')";
	    $stmt = $conn->prepare($sql);
	    $stmt ->execute(); 
	    //Termina inserción de datos en la tabla tarjeta 

	    //Inserción de datos en la tabla basecentral
		$sql1 = "INSERT INTO `basecentral`(`noSerie`,`idUsuario`,`saldo`,`ultimaFecha`) VALUES ('$noSerie','$id','','')";
		$stmt1 = $conn->prepare($sql1);
		$stmt1->execute();
		//Termina inserción de datos en la tabla basecentral

		//Inicia verificación de consultas
		if ($stmt && $stmt1){//Verificamos que las dos consultas anteriores se hayan echo con exito
	    header('location: /An2Bus/index.php'); //Si las consultas se realizan con exito nos redirijiremos hacia el perfil de usuario
		}
		//Termina verficación de consultas
}
?>