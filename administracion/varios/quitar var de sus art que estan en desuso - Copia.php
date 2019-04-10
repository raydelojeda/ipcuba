<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$var_estab="select  ide_articulo from e_articulo where e_articulo.ide_articulo!='1' and ide_subclase!='1'";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab." cant";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$ide_articulo=$rs_var_estab->Fields("ide_articulo");
	 	
		
		$v="select * from n_variedad where ide_articulo='$ide_articulo'";print 	$v."<br>";
$rv= $db->Execute($v)or $mensaje=$db->ErrorMsg() ;
$cant_v=$rv->RecordCount(); 
if($cant_v==0)
{
		$insert="update e_articulo set ide_subclase='1' where ide_articulo='$ide_articulo'";print 	$insert."<br>";
		$rsq=$db->Execute($insert)or die($db->ErrorMsg()) ;
		$x=$x+1;
}
		
	
		
	   
		
	   $rs_var_estab->MoveNext(); 
	 }
print "ya ".$i."  -  ".$x;
?>

