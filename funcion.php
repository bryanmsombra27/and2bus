<?php
//Recuperación de los mensajes del formulario de registro
function borrarErrores(){
	$borrado=false;

	if(isset($_SESSION['exito'])){
		$_SESSION['exito']=null;
		//$borrado=session_unset($_SESSION['exito']); !Genera un error¡
	}
	return $borrado;
}
//Termina recuperación de mensaje del formulario modificación de datos

//Segunda eliminación de error
function otroUsr(){
	$borrado=false;

	if(isset($_SESSION['otroUsr'])){
		$_SESSION['otroUsr']=null;
	}
	return $borrado;
}
//Termina segunda eliminación de error

//Tercera eliminación de error
function existe(){
	$borrado=false;
	if(isset ($_SESSION['existe'])){
		$_SESSION['existe']=null;
	}
	return $borrado;
}
//Termina tercera elimación de error

//Cuarta eliminación de error
function recuperacion(){
	$borrado=false;
	if(isset($_SESSION['recuperacion'])){
		$_SESSION['recuperacion']=null;
	}
	return $borrado;
}
//Termina cuarta eliminación de error

//Quinta eliminación de error
function null(){
	$borrado=false;
	if(isset($_SESSION['null'])){
		$_SESSION['null']=null;
	}
	return $borrado;
}
//Termina quinta eliminación de errores

//Sexta eliminación de error
function verificacion(){
	$borrado=false;
	if(isset($_SESSION['verificacion'])){
		$_SESSION['verificacion']=null;
	}
	return $borrado;
}
//Termina sexta eliminación de errores

//Septima eliminación de errores
function delate(){
	$borrado=false;
	if(isset($_SESSION['delate']) && ($_SESSION['delatee'])){
		$_SESSION['delate'] && $_SESSION['delatee']=null;
	}
	return $borrado;
}
//Termina septima eliminación de errores

//Octava eliminación de errores
function Dupp(){
	$borrado=false;
	if(isset($_SESSION['Dupp'])){
		$_SESSION['Dupp']=null;
	}
	return $borrado;
}
//Termina octava eliminación de errores

//Novena eliminación de errores
function registro(){
	$borrado=false;
	if(isset($_SESSION['registro'])){
		$_SESSION['registro']=null;
	}
	return $borrado;
}
//Termina novena eliminación de errores
?>