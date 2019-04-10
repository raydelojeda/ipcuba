<?php 
session_start();
$query_simple = "select * from $tabla where $campo = '".$valor."'";
$rs_simple=$db->Execute($query_simple) or $mensaje=$db->ErrorMsg();//print $rs_simple;
?>