<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'
$fecha_inicio="2012-07-27";
$fecha_fin="2012-08-31";
$var_estab="select * from captacion where (fecha>='$fecha_inicio' and fecha<='$fecha_fin') and id_obs='1' and id_inc='1'order by id_var_estab";//print $var_estab;;
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
print $cant_var_estab." cant -";
    for($i=0;$i<$cant_var_estab;$i++)
	 {	$id_cap=$rs_var_estab->Fields("id_cap");
	 	$id_var_estab=$rs_var_estab->Fields("id_var_estab");
		//print $id_var_estab."<br>";
		$fecha=$rs_var_estab->Fields("fecha");
		$precio=$rs_var_estab->Fields("precio");
		
	  $sql1 = "UPDATE captacion SET  id_obs='6' where id_var_estab='$id_var_estab' and precio!='0' and id_obs='1' and id_inc='1'";print $sql1."<br>";
	  $db->Execute($sql1) or die($db->ErrorMsg());
	  $sql2 = "UPDATE captacion SET  id_obs='5' where id_var_estab='$id_var_estab' and precio='0' and id_obs='1' and id_inc='1'";print $sql2."<br>";
	  $db->Execute($sql2) or die($db->ErrorMsg());
		$rs_var_estab->MoveNext(); 
	   
	 }
print " ya ".$i;
print "<br>modificados: ".$d;
?>


<body>
   termino
</body>
</html>
