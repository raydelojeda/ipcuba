<?php

include("../adodb/adodb.inc.php");
include("../coneccion/conn.php");
//para detectar repetidos en n_var_estab
//una variedad en un estab en una misma fecha a captar
$var_estab="select * from n_var_estab";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab;
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$idb_variedad=$rs_var_estab->Fields("idb_variedad");
	 	$id_estab=$rs_var_estab->Fields("id_estab");
		$fecha_captar=$rs_var_estab->Fields("fecha_captar");
		
	   
	    $var_estab1="select * from n_var_estab
		where idb_variedad='$idb_variedad' and 
		id_estab='$id_estab' and
		fecha_captar='$fecha_captar'";
		$rs_var_estab1= $db->Execute($var_estab1)or $mensaje=$db->ErrorMsg() ;
		$cant_var_estab1=$rs_var_estab1->RecordCount(); 
		if($cant_var_estab1>1)
		{
	   	$id_var_estab=$rs_var_estab1->Fields("id_var_estab");
	   	$insert="insert into var_estab (id_var_estab) values ('".$id_var_estab."')";
		$rs_i = $db->Execute($insert)or die($db->ErrorMsg());
		}
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
