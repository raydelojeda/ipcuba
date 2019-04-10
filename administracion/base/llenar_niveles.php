<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");
include("delete_all.php");

//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_max = $rs_fecha->Fields('max');//print $x;
//------------------------------FECHA MAXIMA DE LA BASE---------------------


//-------------------FOR DE LOS MERCADOS------------------------------------------------------------
$sql_moneda = "select distinct id_mercado_nuevo from n_mercado";		
$rs_moneda = $db->Execute($sql_moneda)or die($db->ErrorMsg()) ;
$cant_moneda=$rs_moneda->RecordCount();

$rs_moneda->MoveFirst();
for($mon=1;$mon<=$cant_moneda;$mon++)
{
	$id_mercado_nuevo=$rs_moneda->Fields('id_mercado_nuevo');
	$sql_division = "select id_division from n_division";		
	$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
	$cant_division=$rs_division->RecordCount();
	
	$rs_division->MoveFirst();
	for($div=1;$div<=$cant_division;$div++)
	{
		$id_division=$rs_division->Fields('id_division');					 
		$sql_grupo = "select id_grupo, grupo from n_grupo where id_division=$id_division";		
		$rs_grupo = $db->Execute($sql_grupo)or die($db->ErrorMsg()) ;//print $sql_grupo;
		$cant_grupo=$rs_grupo->RecordCount();
			
		$rs_grupo->MoveFirst();			
		for($gru=1;$gru<=$cant_grupo;$gru++)
		{   
			$id_grupo=$rs_grupo->Fields('id_grupo');			
			if($id_grupo)
			{
				$sql_clase = "select distinct n_clase.id_clase, clase 
				from n_clase, e_subclase, e_articulo, n_variedad
				where id_grupo=$id_grupo and n_clase.id_clase=e_subclase.id_clase and e_subclase.ide_subclase!='1' 
				and e_subclase.ide_subclase=e_articulo.ide_subclase and e_articulo.ide_articulo=n_variedad.ide_articulo 
				and n_variedad.ide_articulo!='1'";		
				$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg());//print $sql_clase;die();
				$cant_clase=$rs_clase->RecordCount();
				
				$rs_clase->MoveFirst();
				for($cla=1;$cla<=$cant_clase;$cla++)
				{
					$id_clase=$rs_clase->Fields('id_clase');
					if($id_clase)
					{
						$sql_subclase = "select distinct e_articulo.ide_subclase, subclase from e_subclase, e_articulo, n_variedad 
						where e_subclase.id_clase='$id_clase' and e_subclase.ide_subclase!='1' 
						and e_subclase.ide_subclase=e_articulo.ide_subclase
						and e_articulo.ide_articulo=n_variedad.ide_articulo and e_articulo.ide_articulo!='1'";		
						$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg());//print $sql_subclase;die();
						$cant_subclase=$rs_subclase->RecordCount();
						
						$rs_subclase->MoveFirst();
						for($sub=1;$sub<=$cant_subclase;$sub++)
						{							
							$ide_subclase=$rs_subclase->Fields('ide_subclase');
							if($ide_subclase)
							{
								$sql_articulo = "select distinct e_articulo.ide_articulo from e_articulo, n_variedad 
								where e_articulo.ide_articulo=n_variedad.ide_articulo 
								and ide_subclase='$ide_subclase' and e_articulo.ide_articulo!='1'";	//print $sql_articulo."<br>";	
								$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg()) ;
								$cant_articulo=$rs_articulo->RecordCount();
					
								$rs_articulo->MoveFirst();
								for($art=0;$art<$cant_articulo;$art++)
								{
									$ide_articulo=$rs_articulo->Fields('ide_articulo');//
									$sql_variedad = "select id_variedad from n_variedad where ide_articulo='$ide_articulo'";		
									$rs_variedad = $db->Execute($sql_variedad)or die($db->ErrorMsg());//print $sql_variedad;
									$cant_variedad=$rs_variedad->RecordCount();
					
									$rs_variedad->MoveFirst();
									for($pro=1;$pro<=$cant_variedad;$pro++)
									{//$x=$x+1;print $x."<br>";
										$id_variedad=$rs_variedad->Fields('id_variedad');
										$sql_mercado = "select n_mercado.id_mercado, n_variedad.id_variedad 
										from n_mercado, b_variedad, n_variedad 
										where b_variedad.id_mercado=n_mercado.id_mercado 
										and n_variedad.id_variedad=b_variedad.id_variedad 
										and indice='1' and ide_articulo!='1' and id_mercado_nuevo='$id_mercado_nuevo' 
										and n_variedad.id_variedad='$id_variedad'";//print $sql_mercado.$ide_articulo;
										$rs_mercado = $db->Execute($sql_mercado)or die($db->ErrorMsg()) ;
										$cant_mercado=$rs_mercado->RecordCount();										
										if($cant_mercado!="")
										{$aux_var=1;}																			 
									
									$rs_variedad->MoveNext();							
									} 
																	
									$sql_b_art = "SELECT idb_articulo FROM b_articulo 
									WHERE b_articulo.ide_articulo='".$ide_articulo."' 
									AND b_articulo.id_mercado_nuevo=$id_mercado_nuevo 
									AND b_articulo.fecha='".$fecha_max."'";		
									$rs_b_art = $db->Execute($sql_b_art) or die($db->ErrorMsg());//print $sql_b_art;die();
									$id_art=$rs_b_art->Fields('idb_articulo');
									
									if($id_art=='' && $aux_var!=0)								 				
									{								
										$sql_ins_art="INSERT INTO b_articulo (fecha,ide_articulo,id_mercado_nuevo) 
										VALUES ('".$fecha_max."','".$ide_articulo."','".$id_mercado_nuevo."')";
										$db->Execute($sql_ins_art) or die($db->ErrorMsg());//print $sql;
									}
									$aux_var=0;
									
									//---------articulos-----------
									$sql_b_articulo = "SELECT idb_articulo FROM b_articulo WHERE ide_articulo=$ide_articulo AND id_mercado_nuevo=$id_mercado_nuevo AND fecha='".$fecha_max."'";		
									$rs_b_articulo = $db->Execute($sql_b_articulo)or die($db->ErrorMsg()); 
									$cant_b_articulo=$rs_b_articulo->RecordCount();
									if($cant_b_articulo!="")
									{$aux_art=1;}
									//---------articulos-----------									
										
								$rs_articulo->MoveNext();
								}
									
								$sql_b_sub = "SELECT idb_subclase FROM b_subclase 
								WHERE b_subclase.ide_subclase='".$ide_subclase."' 
								AND b_subclase.id_mercado_nuevo=$id_mercado_nuevo 
								AND b_subclase.fecha='".$fecha_max."'";		
								$rs_b_sub = $db->Execute($sql_b_sub) or die($db->ErrorMsg());//print $rs_b_art;
								$id_sub=$rs_b_sub->Fields('idb_subclase');
								if($id_sub=='' && $aux_art!=0)								 				
								{								
									$sql_ins_sub="INSERT INTO b_subclase (fecha,ide_subclase,id_mercado_nuevo) 
									VALUES ('".$fecha_max."','".$ide_subclase."','".$id_mercado_nuevo."')";
									$db->Execute($sql_ins_sub) or die($db->ErrorMsg());//print $sql_ins_sub."<br>";
								}
								$aux_art=0;
								
								//---------subclase-----------
								$sql_b_subclase = "SELECT idb_subclase FROM b_subclase 
								WHERE ide_subclase=$ide_subclase AND id_mercado_nuevo=$id_mercado_nuevo 
								AND fecha='".$fecha_max."'";		
								$rs_b_subclase = $db->Execute($sql_b_subclase)or die($db->ErrorMsg());// print $sql_b_clase;
								$cant_b_subclase=$rs_b_subclase->RecordCount();
								if($cant_b_subclase!="")
								{$aux_sub=1;}
								//---------subclase-----------	
								
							}//del if										
						$rs_subclase->MoveNext();
						}
						$sql_b_cla = "SELECT idb_clase FROM b_clase 
						WHERE b_clase.id_clase='".$id_clase."' 
						AND b_clase.id_mercado_nuevo=$id_mercado_nuevo AND b_clase.fecha='".$fecha_max."'";		
						$rs_b_cla = $db->Execute($sql_b_cla) or die($db->ErrorMsg());//print $rs_b_gru;
						$id_cla=$rs_b_cla->Fields('idb_clase');
						if($id_cla=='' && $aux_sub!=0)								 				
						{							
							$sql_ins_cla="INSERT INTO b_clase (fecha,id_clase,id_mercado_nuevo) 
							VALUES ('".$fecha_max."','".$id_clase."','".$id_mercado_nuevo."')";
							$db->Execute($sql_ins_cla) or die($db->ErrorMsg());//print $sql;
						}
						$aux_sub=0;
						
						//---------clase-----------
						$sql_b_clase = "SELECT idb_clase FROM b_clase 
						WHERE id_clase=$id_clase AND id_mercado_nuevo=$id_mercado_nuevo AND fecha='".$fecha_max."'";		
						$rs_b_clase = $db->Execute($sql_b_clase)or die($db->ErrorMsg());// print $sql_b_clase;
						$cant_b_clase=$rs_b_clase->RecordCount();
						if($cant_b_clase!="")
						{$aux_cla=1;}
						//---------clase-----------						
						
					}//del if
				$rs_clase->MoveNext();
				}					
				$sql_b_gru = "SELECT idb_grupo FROM b_grupo 
				WHERE b_grupo.id_grupo='".$id_grupo."' 
				AND b_grupo.id_mercado_nuevo=$id_mercado_nuevo AND b_grupo.fecha='".$fecha_max."'";		
				$rs_b_gru = $db->Execute($sql_b_gru) or die($db->ErrorMsg());//print $rs_b_gru;
				$id_gru=$rs_b_gru->Fields('idb_grupo');
				if($id_gru=='' && $aux_cla!=0)								 				
				{							
					$sql_ins_gru="INSERT INTO b_grupo (fecha,id_grupo,id_mercado_nuevo) 
					VALUES ('".$fecha_max."','".$id_grupo."','".$id_mercado_nuevo."')";
					$db->Execute($sql_ins_gru) or die($db->ErrorMsg());//print $sql;
				}
				$aux_cla=0;
				
				//---------grupo-----------
				$sql_b_grupo = "SELECT idb_grupo FROM b_grupo 
				WHERE id_grupo=$id_grupo AND id_mercado_nuevo=$id_mercado_nuevo AND fecha='".$fecha_max."'";		
				$rs_b_grupo = $db->Execute($sql_b_grupo)or die($db->ErrorMsg());// print $sql_b_clase;
				$cant_b_grupo=$rs_b_grupo->RecordCount();
				if($cant_b_grupo!="")
				{$aux_gru=1;}
				//---------grupo-----------				
				
			}//del if
		$rs_grupo->MoveNext();
		}
		$sql_b_div = "SELECT idb_division FROM b_division 
		WHERE b_division.id_division='".$id_division."' 
		AND b_division.id_mercado_nuevo=$id_mercado_nuevo AND b_division.fecha='".$fecha_max."'";		
		$rs_b_div = $db->Execute($sql_b_div) or die($db->ErrorMsg());//print $rs_b_gru;
		$id_div=$rs_b_div->Fields('idb_division');
		
		if($id_div=='' && $aux_gru!=0)								 				
		{							
			$sql_ins_div="INSERT INTO b_division (fecha,id_division,id_mercado_nuevo) 
			VALUES ('".$fecha_max."','".$id_division."','".$id_mercado_nuevo."')";
			$db->Execute($sql_ins_div) or die($db->ErrorMsg());//print $sql;				
		}
		$aux_gru=0;		
		
	$rs_division->MoveNext();
	}
	//--------------------------------------------------------------------------------------------------
	//----------------FIN DEL FOR DE LOS NOMENCLADORES DESDE division HASTA variedad-------------------
	
	
	
	
	//-------------------FIN DEL FOR DE LOS MERCADOS----------------------------------------------------

$rs_moneda->MoveNext();
}

//------------------------------COMPROBACION DE VALORES---------------------					 
/*$sql_pvalor = "select sum(valor) from b_variedad where fecha='".$fecha_max."'";		
$rs_pvalor = $db->Execute($sql_pvalor)or die($db->ErrorMsg()) ;
$pvalor = $rs_pvalor->Fields('sum');//print $pvalor;

$sql_cvalor = "select sum(valor) from b_division where fecha='".$fecha_max."'";		
$rs_cvalor = $db->Execute($sql_cvalor)or die($db->ErrorMsg()) ;
$cvalor = $rs_cvalor->Fields('sum');//print $cvalor;
if($pvalor!=$cvalor)
{include("delete_all.php");}*/
//------------------------------COMPROBACION DE VALORES---------------------

header("Location:../config/admin.php?msg=Se insertaron los rubros correctamente en cada mercado, se puede proceder a insertar sus ponderaciones.");

?>