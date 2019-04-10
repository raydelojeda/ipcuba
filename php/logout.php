<?php 
session_start();
$_SESSION["rol"] = '';
$_SESSION["user"] = '';
$_SESSION[] = array();
session_destroy(); 
header("Location:../seguridad/autenticacion.php");
?>