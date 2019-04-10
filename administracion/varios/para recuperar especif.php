<?php   
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
$estab="select * from n_var_estab1, n_estab where n_estab.id_estab=n_var_estab.id_estab and cod_dpa='0207'";
//print $sql;
$rse = $db->Execute($estab)or die($db->ErrorMsg());
$cant_auxiliare=$rse->RecordCount(); 
for($e=0;$e<=$cant_auxiliare;$e++)
	{$id_esta=$rse->Fields("id_esta");

$sqlp="select max(precios) from conflictos where id_est='$id_esta'";
$rsp = $db->Execute($sqlp)or die($db->ErrorMsg());
$p=$rsp->Fields("max");


$sqlf="select f from conflictos where id_est='$id_esta' and precios='$p'";
$rsf = $db->Execute($sqlf)or die($db->ErrorMsg());



	$ff=$rsf->Fields("f");
	
	$up1="Update n_var_estab set 
	fecha_captar='$ff'
	where id_estab='".$id_esta."'";
	$db->Execute($up1)or die($db->ErrorMsg());
	
	print $up1."<br>";
	
	
	
$rse->MoveNext();
}
?>


