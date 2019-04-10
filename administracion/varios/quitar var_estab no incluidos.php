<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$var_estab="select id_estab, n_dpa.cod_dpa 
from n_estab, n_dpa 
where n_dpa.cod_dpa=n_estab.cod_dpa and incluido='0' order by n_dpa.cod_dpa";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab." cant";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_estab=$rs_var_estab->Fields("id_estab");
	 	$cap="select id_cap 
from captacion, n_var_estab 
where n_var_estab.id_var_estab=captacion.id_var_estab and id_estab='$id_estab'";
		print 	$cap."<br>";
		$rs_cap= $db->Execute($cap)or $mensaje=$db->ErrorMsg() ;
		$cant_cap=$rs_cap->RecordCount(); 
		for($c=0;$c<$cant_cap;$c++)
	 {
		$id_cap=$rs_cap->Fields("id_cap");
		
		$del="delete from captacion where id_cap='$id_cap'";print 	$del."<br>";
		$db->Execute($del)or die($db->ErrorMsg()) ;
		$rs_cap->MoveNext(); 
	}
		
	   	$insert="delete from n_var_estab where id_estab='$id_estab'";print 	$insert."<br>";
		$rsq=$db->Execute($insert)or die($db->ErrorMsg()) ;
		
	   $rs_var_estab->MoveNext(); 
	 }
print "ya ".$i;
?>

