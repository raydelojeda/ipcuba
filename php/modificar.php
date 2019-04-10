<?php 
session_start();

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
$mensaje = "";
if ($_GET["var_aux_mod"]!="")
{	
	$query = " where $campo = '".$_GET["var_aux_mod"]."'"; 
}

if ($_POST["var_aux_mod"]!="")
{	
	$query = " where $campo = '".$_POST["var_aux_mod"]."'"; 
}

/*else
{
	header("Location: l_usuario.php");
}*/

$sql = "select * from $tabla".$query;
//print $sql;
$rs = $db->Execute($sql);//print $rs;

if ($_GET["curr_page"]!="")
{	
	$curr_page = $_GET["curr_page"]; 
	$regis_cant = $_GET["regis_cant"]; //print $curr_page." ".$regis_cant;	
}
?>