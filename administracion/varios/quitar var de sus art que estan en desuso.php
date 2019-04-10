<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$var_estab="select  earticulo, variedad,id_variedad from e_articulo,n_variedad where ide_subclase='1' 
and n_variedad.ide_articulo=e_articulo.ide_articulo 
and e_articulo.ide_articulo!='1'";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab." cant";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_variedad=$rs_var_estab->Fields("id_variedad");
	 	
		
		
		
	
		
	   	$insert="update n_variedad set ide_articulo='1' where id_variedad='$id_variedad'";print 	$insert."<br>";
		$rsq=$db->Execute($insert)or die($db->ErrorMsg()) ;
		
	   $rs_var_estab->MoveNext(); 
	 }
print "ya ".$i;
?>

