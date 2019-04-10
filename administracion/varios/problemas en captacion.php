<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacion
$var_estab="select * from captacion where fecha>'2010-06-28'";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab;
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_cap=$rs_var_estab->Fields("id_cap");
	 	
	   	$insert="update captacion set fecha='2010-06-28' where id_cap='$id_cap'";
		$db->Execute($insert)or $mensaje=$db->ErrorMsg() ;
		$rs_var_estab->MoveNext(); 
	   
	 }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
