<?php 
include("adodb/adodb.inc.php");
include("coneccion/conn.php");
include("adodb/adodb-navigator.php");

$sql = "select * from n_articulo";
//print $sql;
$rs = $db->Execute($sql);
$cant=$rs->RecordCount();
$carac1="Cantidad";
for($i=0;$i<$cant;$i++)
{
$sql2 = "UPDATE n_articulo SET  carac1=$carac1";
	//print $sql;
	$rs2 = $db->Execute($sql2) or $mensaje=$db->ErrorMsg() ;
	print $rs2;
}




?>
