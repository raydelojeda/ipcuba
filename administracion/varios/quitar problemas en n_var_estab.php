<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$var_estab="select id_var_estab,idb_variedad,id_estab from n_var_estab";//and incluido ='1'print $var_estab;
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab." cant";and n_estab.cod_dpa='0111'
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_var_estab=$rs_var_estab->Fields("id_var_estab");
	 	$idb_variedad=$rs_var_estab->Fields("idb_variedad");
		
		$id_estab=$rs_var_estab->Fields("id_estab");
		
	   	$insert="select idb_variedad from b_variedad where idb_variedad='$idb_variedad'";//print $insert."<br>";
		$rsq=$db->Execute($insert)or $mensaje=$db->ErrorMsg() ;
		if($rsq->RecordCount()==0)
		{$f=$f+1;
		print $id_var_estab."  -  ".$f."<br>";
		$sql_division1 = "delete from n_var_estab where id_var_estab='$id_var_estab'";	print $sql_division."<br>";  
		//$r=$db->Execute($sql_division1) ;
		

		}
		$rs_var_estab->MoveNext(); 
	   
	 }
print "ya ".$i;
print "<br> borrados:".$f;
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
