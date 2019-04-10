<?php 

$sql_moneda = "select id_mercado from n_mercado";		
$rs_moneda = $db->Execute($sql_moneda)or die($db->ErrorMsg()) ;
$cant_moneda=$rs_moneda->RecordCount();

$rs_moneda->MoveFirst();
for($mon=1;$mon<=$cant_moneda;$mon++)
{		
	$id_mercado=$rs_moneda->Fields('id_mercado');
	
	$sql_sel_dpa = "select * from n_dpa where incluido='1' order by cod_dpa";// and cod_dpa='0302'
	$rs_sel_dpa = $db->Execute($sql_sel_dpa) or die($db->ErrorMsg());
	
	$cant_dpa=$rs_sel_dpa->RecordCount();
	$rs_sel_dpa->MoveFirst();
	for($dpa=1;$dpa<=$cant_dpa;$dpa++)
	{
		$cod_dpa=$rs_sel_dpa->Fields('cod_dpa');
			
		$sql_sel_variedad = "select captacion.id_obs,variedad, cap_ant.fecha as f_ant,captacion.fecha as f_act, 
		cap_ant.precio as p_ant, captacion.precio as p_act, cap_ant.id_cap as id_cap_ant, captacion.id_cap as id_cap_act 
		FROM n_dpa, n_estab, n_var_estab, b_variedad, n_variedad, captacion as cap_ant, captacion 
		WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
		and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
		and	captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
		and captacion.fecha<'$fecha_cal_inicio_sem1_next'  
		
		and captacion.id_var_estab=cap_ant.id_var_estab 
		and captacion.id_var_estab=n_var_estab.id_var_estab 
		and captacion.precio=0 and cap_ant.precio!=0 and estacionalidad='1'
		and b_variedad.idb_variedad=n_var_estab.idb_variedad 
		and n_variedad.id_variedad=b_variedad.id_variedad 
		and n_estab.cod_dpa=n_dpa.cod_dpa 
		and n_var_estab.id_estab=n_estab.id_estab 
		and n_dpa.cod_dpa='".$cod_dpa."'
		and n_estab.desuso='0' and n_var_estab.desuso='0' 
		and n_variedad.ide_articulo!='1' 
		and b_variedad.id_mercado='$id_mercado'
		and fecha_captar >='".$fecha_base."' 
		order by n_variedad.id_variedad";//print $sql_sel_variedad;die();
		$rs_sel_variedad = $db->Execute($sql_sel_variedad) or die($db->ErrorMsg());
		
		$cant_variedad=$rs_sel_variedad->RecordCount();
		$rs_sel_variedad->MoveFirst();
		for($var=1;$var<=$cant_variedad;$var++)
		{ 
			$id_cap_act=$rs_sel_variedad->Fields("id_cap_act");
			$p_ant=$rs_sel_variedad->Fields("p_ant");			
	   
			$sql_cap = "UPDATE captacion SET va_a_calculo='1',id_inc='1',id_obs='6', precio ='".$p_ant."', cont_imp='1' 
			WHERE id_cap = '".$id_cap_act."' and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
			and captacion.fecha<'$fecha_cal_inicio_sem1_next' and captacion.precio=0";//print $sql_cap."<br>";die();
			$db->Execute($sql_cap) or die($db->ErrorMsg());
			
		$rs_sel_variedad->MoveNext();   
		}//llave del for de n_variedad	
	$rs_sel_dpa->MoveNext();   
	}//llave del for de n_dpa
$rs_moneda->MoveNext();
}
?>