<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'

$mer="select captacion.id_obs,variedad, cap_ant.fecha as f_ant,captacion.fecha as f_act, cap_ant.precio as p_ant, captacion.precio as p_act, cap_ant.id_cap as id_cap_ant, captacion.id_cap as id_cap_act ,n_var_estab.id_var_estab 



from captacion as cap_ant, captacion, n_var_estab, b_variedad, n_variedad
where cap_ant.fecha>='2010-12-01' and captacion.id_var_estab=cap_ant.id_var_estab
and cap_ant.fecha<'2011-01-05' 
and captacion.fecha>='2011-01-05' 
and captacion.fecha<'2011-02-02' 
and captacion.precio!='0' and cap_ant.precio='0'

and b_variedad.id_variedad=n_variedad.id_variedad and b_variedad.idb_variedad=n_var_estab.idb_variedad
and b_variedad.idb_variedad=n_var_estab.idb_variedad and n_var_estab.id_var_estab=captacion.id_var_estab
and ide_articulo!='1' and desuso='0'

order by ecod_var";
$rs_mer= $db->Execute($mer)or $mensaje=$db->ErrorMsg() ;
$cant_mer=$rs_mer->RecordCount(); 


	$rs_mer->MoveFirst();
	for($m=0;$m<$cant_mer;$m++)
	 {	//$me=substr($rs_mer->Fields("mercado"),0,1);
	 	$id_var_estab=$rs_mer->Fields("id_var_estab");
		$p_act=$rs_mer->Fields("p_act");
		$p_ant=$rs_mer->Fields("p_ant");
		//print $m;
	   
	 
	
			
			$sql = "UPDATE captacion SET id_obs='6', precio ='".$p_act."', cont_imp='1' WHERE id_var_estab = '".$id_var_estab."' and captacion.fecha>='2010-12-01' 
and captacion.fecha<'2011-01-05' ";
	print $sql."<br>";
	$db->Execute($sql) or die($db->ErrorMsg()) ;
			
	
$rs_mer->MoveNext(); 
	}	
		
print " ya ".$m;
?>

