<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$fecha_inicio="2012-12-05";
$fecha_fin="2013-01-02";
$var_estab="select * from captacion where (fecha>='$fecha_inicio' and fecha<'$fecha_fin') order by id_var_estab";//print $var_estab;;
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
print $cant_var_estab." cant -";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_cap=$rs_var_estab->Fields("id_cap");
	 	$id_var_estab=$rs_var_estab->Fields("id_var_estab");
		//print $id_var_estab."<br>";
		$fecha=$rs_var_estab->Fields("fecha");
		$precio=$rs_var_estab->Fields("precio");
		
	   	$insert="select * from captacion where id_var_estab='$id_var_estab' and (fecha>='$fecha_inicio' and fecha<'$fecha_fin') order by precio asc";
		$rsq=$db->Execute($insert)or die($db->ErrorMsg()) ;//print $insert;die();
		if($rsq->RecordCount()>1)
		{$f=$f+1;		
			$precio1=$rsq->Fields("precio");
			$cont_imp=$rsq->Fields("cont_imp");
			if($precio==$precio1 || $precio1=='0' || $cont_imp!="")
			{	
				$id_cap=$rsq->Fields("id_cap");
				print "Ha sido borrado ".$id_var_estab."  -  ".$id_cap."  -  ".$f."<br>";
				$sql_division = "delete from captacion where id_cap='$id_cap'";	//print $sql_division."   ";	
				$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
				$d=$d+1;
			}
				else
				print "NO ha sido borrado ".$id_var_estab."  -  ".$id_cap."  -  ".$f."  -  ".$precio1."<br>";
		}
		$rs_var_estab->MoveNext(); 
	   
	 }
print " ya ".$i;
print "<br>borrados: ".$d;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
   termino
</body>
</html>
