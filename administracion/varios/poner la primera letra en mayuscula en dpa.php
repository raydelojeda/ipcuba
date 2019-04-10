<?php 
$x="";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");


$sql = "select * from n_dpa";
$rs = $db->Execute($sql);
	 	$rs->MoveFirst();
for($i=1;$i<250;$i++)
		{

$w=$rs->fields["cod_dpa"];	
$x=$rs->fields["prov_mun"];	
$x=ucwords(strtolower($x)); 

$sql1 = "UPDATE n_dpa SET  prov_mun='$x' where cod_dpa='$w'";
	//print $sql;
	$rs1 = $db->Execute($sql1) or $mensaje=$db->ErrorMsg() ;
	$rs->MoveNext();
	  	}
?> 
 