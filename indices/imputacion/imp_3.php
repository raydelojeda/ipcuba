<?php 
$relativos = array();

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
				
		$sql_sel_articulo = "select distinct e_articulo.ide_articulo
		from captacion, n_var_estab, b_variedad, n_variedad, n_estab, e_articulo
		where captacion.id_var_estab=n_var_estab.id_var_estab
		and n_var_estab.idb_variedad=b_variedad.idb_variedad 
		and n_variedad.id_variedad= b_variedad.id_variedad 
		and n_var_estab.id_estab = n_estab.id_estab and captacion.precio=0
		and n_estab.cod_dpa ='".$cod_dpa."' and estacionalidad!='1' and n_variedad.ide_articulo!='1' 
		and b_variedad.id_mercado='$id_mercado'	 
		and fecha_captar >='".$fecha_base."'
		
		and	captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
		and captacion.fecha<'$fecha_cal_inicio_sem1_next'
		
		and n_variedad.ide_articulo!='1'
		and n_variedad.ide_articulo=e_articulo.ide_articulo";//print $sql_sel_articulo."<br>";die();
		$rs_sel_articulo = $db->Execute($sql_sel_articulo) or die($db->ErrorMsg());
		
		$cant_articulo=$rs_sel_articulo->RecordCount();
		$rs_sel_articulo->MoveFirst();
		for($art=1;$art<=$cant_articulo;$art++)
		{ 	
			$ide_articulo=$rs_sel_articulo->Fields('ide_articulo');
			
			$sql_sel_variedad = "select distinct n_var_estab.idb_variedad, n_variedad.id_variedad, variedad
			from captacion, n_var_estab, b_variedad, n_variedad, n_estab
			where captacion.id_var_estab=n_var_estab.id_var_estab
			and n_var_estab.idb_variedad=b_variedad.idb_variedad 
			and n_variedad.id_variedad= b_variedad.id_variedad 
			and n_var_estab.id_estab = n_estab.id_estab and captacion.precio=0
			and n_estab.cod_dpa ='".$cod_dpa."' and estacionalidad!='1' and n_variedad.ide_articulo!='1' 
			and b_variedad.id_mercado='$id_mercado'	 
			and fecha_captar >='".$fecha_base."'
		
			and	captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
			and captacion.fecha<'$fecha_cal_inicio_sem1_next'
			and n_variedad.ide_articulo= '".$ide_articulo."'";//print $sql_sel_variedad."<br>";//die();
			$rs_sel_variedad = $db->Execute($sql_sel_variedad) or die($db->ErrorMsg());
			
			$cant_variedad=$rs_sel_variedad->RecordCount();
			$rs_sel_variedad->MoveFirst();
			for($var=1;$var<=$cant_variedad;$var++)
			{ 
				$idb_variedad=$rs_sel_variedad->Fields('idb_variedad');
				
				$sql_sel_cap = "select captacion.id_obs,variedad, cap_ant.fecha as f_ant,captacion.fecha as f_act, 
				cap_ant.precio as p_ant, captacion.precio as p_act, cap_ant.id_cap as id_cap_ant, 
				captacion.id_cap as id_cap_act ,captacion.precio/cap_ant.precio as relat
				FROM n_dpa, n_estab, n_var_estab, b_variedad, n_variedad, captacion as cap_ant, captacion 
				WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
				and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
				and	captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
				and captacion.fecha<'$fecha_cal_inicio_sem1_next' 
				 
				and captacion.id_var_estab=cap_ant.id_var_estab 
				and captacion.id_var_estab=n_var_estab.id_var_estab 
				and cap_ant.precio!=0 
				and b_variedad.idb_variedad=n_var_estab.idb_variedad 
				and n_variedad.id_variedad=b_variedad.id_variedad 
				and n_estab.cod_dpa=n_dpa.cod_dpa 
				and n_var_estab.id_estab=n_estab.id_estab 
				and n_dpa.cod_dpa='".$cod_dpa."'
				and n_estab.desuso='0' and n_var_estab.desuso='0' 
				and n_variedad.ide_articulo!='1' 
				and b_variedad.idb_variedad='$idb_variedad'  
				and fecha_captar>='".$fecha_base."' order by n_variedad.id_variedad";//print $sql_sel_cap."<br>";//die();
				$rs_sel_cap = $db->Execute($sql_sel_cap) or die($db->ErrorMsg());
				
				$cant_cap=$rs_sel_cap->RecordCount();
				if($cant_cap>0)
				{
					$v=$v+1;
					$rs_sel_cap->MoveFirst();
					for($cap=1;$cap<=$cant_cap;$cap++)
					{ 
						
						//print $cant_cap;
						$cont=$cont+1;
						
				
                    	$relat=$rs_sel_cap->Fields("relat");
						$p_ant=$rs_sel_cap->Fields("p_ant");
						$id_cap_act=$rs_sel_cap->Fields("id_cap_act");
						
						if($relat!=0 && $relat!='')
						{//print "df".$relat."  ";
							$count=count($relativos);
							$relativos[$count]=$relat;						
							
						} 
						else
						{
							$count_p=count($precios_ant);
							$precios_ant[$count_p]=$p_ant;//print $p_ant."<br>";
							
							$count_i=count($id_captaciones);
							$id_captaciones[$count_i]=$id_cap_act;
						}
					
					$rs_sel_cap->MoveNext();   
					}					
				}//del if de las cantidades
						
			$rs_sel_variedad->MoveNext();
			}//llave del for de n_variedad
			
			if($relativos[0] && $id_captaciones[0])
					{
						$representatividad=($v)/$cant_variedad;//print $representatividad."=";print $v."/";print $cant_variedad."<br>";//die();
						if($representatividad>0.35)	
						{	
							$obj=new medias;//print $relativos[1];
							$geo=$obj->geo($relativos);
								
							$count_i=count($id_captaciones);	
							//print $geo." geo"."<br>";
							for($h=0;$h<$count_i;$h++)
							{ 
							$id_cap_act=$id_captaciones[$h];
							$p_ant=$precios_ant[$h];//print $precios_ant[$h];							
							$p_act= bcmul($geo,$p_ant,14); 
							$p_act=round($p_act, 2);  		
						   
							$sql_cap="UPDATE captacion SET va_a_calculo='1',id_inc='1',id_obs='6',precio ='".$p_act."', cont_imp='2' 
							WHERE id_cap = '".$id_cap_act."' and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
							and captacion.fecha<'$fecha_cal_inicio_sem1_next' and captacion.precio=0";//$k=$k+1;print $sql_cap."<br>".$k;die();
							$db->Execute($sql_cap) or die($db->ErrorMsg());							
							}//for de la matriz de los id de captaciones con precio 0						
						}//del if de la representatividad
					}//del if de la matriz de los relativos
					if($relativos)foreach ($relativos as $c => $valor) {unset($relativos[$c]);}
					if($precios_ant)foreach ($precios_ant as $k => $valor) {unset($precios_ant[$k]);}
					if($id_captaciones)foreach ($id_captaciones as $g => $valor) {unset($id_captaciones[$g]);}
				
		$rs_sel_articulo->MoveNext();
		}//llave del for de e_articulo	
	$rs_sel_dpa->MoveNext();   
	}//llave del for de n_dpa
$rs_moneda->MoveNext();
}
?>