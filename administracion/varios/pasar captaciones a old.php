<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$fecha_inicio="2008-01-01";
$fecha_fin="2010-12-01";
$var_estab="select * from captacion where (fecha>='$fecha_inicio' and fecha<'$fecha_fin') order by id_cap";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
print $cant_var_estab." cant -";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_cap=$rs_var_estab->Fields("id_cap");
	 	$precio=$rs_var_estab->Fields("precio");	
		$fecha=$rs_var_estab->Fields("fecha");
		$id_obs=$rs_var_estab->Fields("id_obs");
		$id_usuario=$rs_var_estab->Fields("id_usuario");		
		$id_var_estab=$rs_var_estab->Fields("id_var_estab");
		$id_inc=$rs_var_estab->Fields("id_inc");
		$cont_imp=$rs_var_estab->Fields("cont_imp");
		if($cont_imp=="")
		$cont_imp="0";
		$va_a_calculo=$rs_var_estab->Fields("va_a_calculo");
		$id_usuario_aprueba=$rs_var_estab->Fields("id_usuario_aprueba");
		if($id_usuario_aprueba=="")
		$id_usuario_aprueba="0";
		
		
	   	$insert="INSERT INTO captacion_old(id_cap_old,precio_old,fecha_old,id_obs_old,id_usuario_old,
		id_var_estab_old,id_inc_old,cont_imp_old,va_a_calculo_old,id_usuario_aprueba_old)  
		VALUES ('".$id_cap."','".$precio."','".$fecha."','".$id_obs."','".$id_usuario."',
		'".$id_var_estab."','".$id_inc."','".$cont_imp."','".$va_a_calculo."','".$id_usuario_aprueba."')";
		$rsq=$db->Execute($insert)or $mensaje=$db->ErrorMsg() ;//print $insert.$mensaje."<br><br>";
		if($rsq)
		{
		$sql_division = "delete from captacion where id_cap='$id_cap'";	//print $sql_division."   ";	or die($db->ErrorMsg())
		$rs_division = $db->Execute($sql_division) ;
		}

	
		$rs_var_estab->MoveNext(); 
	   
	 }
	 

print " ya ".$i;//die();
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
