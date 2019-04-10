<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$var_estab="select id_estab from n_estab where cod_dpa='1005'";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab." cant";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_estab=$rs_var_estab->Fields("id_estab");
	 	
		
	   	$insert="update n_var_estab set cantidad='', id_unidad='22', valor1='',valor2='',valor3='',valor4='',valor5='',valor6='' where id_estab='$id_estab'";print 	$insert."<br>";
		$rsq=$db->Execute($insert)or die($db->ErrorMsg()) ;
		
	   $rs_var_estab->MoveNext(); 
	 }
print "ya ".$i;
?>

