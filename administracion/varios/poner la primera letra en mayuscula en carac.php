<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");


$sql = "select * from n_var_estab";
$rs = $db->Execute($sql);
$cant_var_estab=$rs->RecordCount(); 
	 	$rs->MoveFirst();
for($i=1;$i<$cant_var_estab;$i++)
		{

$id_var_estab=$rs->fields["id_var_estab"];	
$valor1=$rs->fields["valor1"];	
$valor1=ucfirst(strtolower($valor1)); 

$valor2=$rs->fields["valor2"];	
$valor2=ucfirst(strtolower($valor2)); 

$valor3=$rs->fields["valor3"];	
$valor3=ucfirst(strtolower($valor3)); 

$valor4=$rs->fields["valor4"];	
$valor4=ucfirst(strtolower($valor4)); 

$valor5=$rs->fields["valor5"];	
$valor5=ucfirst(strtolower($valor5)); 

$valor6=$rs->fields["valor6"];	
$valor6=ucfirst(strtolower($valor6)); 

$sql1 = "UPDATE n_var_estab SET  valor1='$valor1',valor2='$valor2',valor3='$valor3',valor4='$valor4',valor5='$valor5',valor6='$valor6' where id_var_estab='$id_var_estab'";
	print $sql1."<br>";
	$rs1 = $db->Execute($sql1) or $mensaje=$db->ErrorMsg() ;
	$rs->MoveNext();
	  	}
?> 
 