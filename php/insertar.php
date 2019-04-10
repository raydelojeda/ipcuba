<?php 
session_start();


	$query = " where $campo = $valor"; 

$sql = "select * from $tabla".$query;
//print $sql;
$rs = $db->Execute($sql)or $mensaje=$db->ErrorMsg() ;
?>