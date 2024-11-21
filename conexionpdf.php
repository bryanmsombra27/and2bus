<?php

	$mysqli = new mysqli ('localhost' , 'root' , '' , 'an2bus');

if ($mysqli ->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
?>