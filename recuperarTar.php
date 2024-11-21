<?php
require"conexion.php";

session_start();
$id=$_SESSION['user_id'];

$noSerie=$_POST['noSerie'];

$mods=$conn->prepare("SELECT * FROM `basecentral` WHERE `noSerie`='$noSerie' ");
$mods->bindparam(':id',$_SESSION['user_id']);
$mods->execute();
$res=$mods->fetch(PDO::FETCH_ASSOC);

//Recepción de datos
$noSerieRec=$res['noSerie'];
$idRec=$res['idUsuario'];
$saldoRec=$res['saldo'];
$ultimaFechaRec=$res['ultimaFecha'];
//Termina recepción de datos

$mods1=$conn->prepare("SELECT `noSerie`,`idUsuario` FROM `tarjeta` WHERE `noSerie`='$noSerie'");
$mods1->bindparam(':id',$_SESSION['user_id']);
$mods1->execute();
$res1=$mods1->fetch(PDO::FETCH_ASSOC);

$noSerieDup=$res1['noSerie'];
$idUsuarioDup=$res1['idUsuario'];

if($noSerie==$noSerieRec && $id!=$idRec){
	$otroUsr=1;
	if($otroUsr==1){
		$_SESSION['otroUsr']="Error, esta tarjeta le pertenece a otro usuario";
	}
	header('location: /An2Bus/formRecuperarTar.php');
	//echo "Error al recuperar tarjeta, le pertenece a otro usuario.";
}else
	if($noSerie==$noSerieRec && $noSerie==$noSerieDup && $id==$idUsuarioDup){
		$Dup=1;
		if($Dup==1){
			$_SESSION['existe']="Error, esta tarjeta ya se encuentra disponible en sus registros";
		}
		header('location: /An2Bus/formRecuperarTar.php');
		//echo "Esta tarjeta ya existe en sus registros";
	}
	else
		if($noSerie==$noSerieRec && $id==$idRec){
			$exito=1;
			if($exito==1){
				$_SESSION['recuperacion']="Su tarjeta a sido recuperada con exito";
			}
			//echo "Recuperación exitosa";

			$sql="INSERT INTO `tarjeta`(`noSerie`,`idUsuario`,`saldo`,`ultimaFecha`) VALUES('$noSerieRec','$id','$saldoRec','$ultimaFechaRec')";
			$stmt=$conn->prepare($sql);
			$stmt->execute();

			if($stmt){
				header('location: /An2Bus/formRecuperarTar.php');
			}
		}
		else
			if($noSerieRec==null && $idRec==null){
				$null=1;
				if($null==1){
					$_SESSION['null']="Esta tarjeta no existe";
				}
				header('location: /An2Bus/formRecuperarTar.php');
				//echo "Esta tarjeta no existe";
			}
?>