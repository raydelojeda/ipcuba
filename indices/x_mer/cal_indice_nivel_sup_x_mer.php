<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");


$nombre_archivo = "ejecutado.txt";
$gestor = fopen($nombre_archivo, "r");
$contenido = fread($gestor, filesize($nombre_archivo));
fclose($gestor);

if($contenido=="0")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de variedad en cada municipio usando media geométrica.");

if($contenido=="1")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo en cada municipio usando media geométrica.");

if($contenido=="2")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo nacional usando media aritmética simple.");
/*
if($contenido=="4")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo del lndice general nacional usando media aritmética ponderada.");*/

//print $contenido;
//die();


$obj = new medias;

$matriz_art = array();	
$matriz_sub = array();	
$matriz_cla = array();	
$matriz_gru = array();	
$matriz_div = array();

$matriz_g_peso_art = array();	
$matriz_g_peso_sub = array();	
$matriz_g_peso_cla = array();	
$matriz_g_peso_gru = array();	
$matriz_g_peso_div = array();

//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_base = $rs_fecha->Fields('max');
//------------------------------FECHA MAXIMA DE LA BASE---------------------

//---------------------------------------------------
$sql_fecha_d_articulo = "select max(fecha) from d_art_dpa";
$rs_fecha_d_articulo = $db->Execute($sql_fecha_d_articulo) or die($db->ErrorMsg());
$fecha_d_articulo = $rs_fecha_d_articulo->Fields('max');
//---------------------------------------------------

$sql_moneda = "select distinct id_mercado_nuevo from n_mercado";		
$rs_moneda = $db->Execute($sql_moneda)or die($db->ErrorMsg()) ;
$cant_moneda=$rs_moneda->RecordCount();

$rs_moneda->MoveFirst();
for($mon=1;$mon<=$cant_moneda;$mon++)
{
	$id_mercado_nuevo=$rs_moneda->Fields('id_mercado_nuevo');

	//-------------------FOR DE LOS NOMENCLADORES DESDE LA DIVISION HASTA VARIEDAD------------------------
	//--------------------------------------------------------------------------------------------------					 
	$sql_division = "select id_division, division from n_division";	//where cod_division like '02'	
	$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
	$cant_division=$rs_division->RecordCount();
	
	$rs_division->MoveFirst();
	for($div=1;$div<=$cant_division;$div++)
	{
		
		$id_division=$rs_division->Fields('id_division');
		$sql_bdivision = "select idb_division,r_peso from b_division 
		where id_division=$id_division and fecha='$fecha_base' and id_mercado_nuevo='$id_mercado_nuevo'";//print $sql_gdivision;
		$rs_bdivision = $db->Execute($sql_bdivision)or die($db->ErrorMsg());
		
		$idb_division=$rs_bdivision->Fields('idb_division');
		$r_peso_div=$rs_bdivision->Fields('r_peso');
			
		if($idb_division!="" and $r_peso_div!="")
		{
							 
			$sql_grupo = "select id_grupo, grupo from n_grupo where id_division=$id_division";		
			$rs_grupo = $db->Execute($sql_grupo)or die($db->ErrorMsg()) ;//print $sql_grupo;
			$cant_grupo=$rs_grupo->RecordCount();
			$rs_grupo->MoveFirst();
			
			for($gru=1;$gru<=$cant_grupo;$gru++)
			{   
			  
				$id_grupo=$rs_grupo->Fields('id_grupo');
				
				$sql_bgrupo = "select idb_grupo,r_peso from b_grupo 
				where  id_grupo=$id_grupo and fecha='$fecha_base' and id_mercado_nuevo='$id_mercado_nuevo'";	
				$rs_bgrupo = $db->Execute($sql_bgrupo)or die($db->ErrorMsg());
				
				$idb_grupo=$rs_bgrupo->Fields('idb_grupo');
				$r_peso_gru=$rs_bgrupo->Fields('r_peso');
				
				if($idb_grupo!="" and $r_peso_gru!="")
				{
					$sql_clase = "select id_clase, clase from n_clase where id_grupo=$id_grupo";	//	
					$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg());//print $sql_clase;
					$cant_clase=$rs_clase->RecordCount();
				 
					$rs_clase->MoveFirst();
					for($cla=1;$cla<=$cant_clase;$cla++)
					{
						$id_clase=$rs_clase->Fields('id_clase');
						
						$sql_bclase = "select idb_clase,r_peso from b_clase 
						where  id_clase=$id_clase and fecha='$fecha_base' and id_mercado_nuevo='$id_mercado_nuevo'";		
						$rs_bclase = $db->Execute($sql_bclase)or die($db->ErrorMsg());
						
						$idb_clase=$rs_bclase->Fields('idb_clase');
						$r_peso_cla=$rs_bclase->Fields('r_peso');
						
						if($idb_clase!="" and $r_peso_cla!="")
						{ 
							$sql_subclase = "select ide_subclase, subclase from e_subclase where id_clase='$id_clase' and ide_subclase!='1'";		
							$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg());//print $sql_subclase;// 
							$cant_subclase=$rs_subclase->RecordCount();
					
							$rs_subclase->MoveFirst();
							for($sub=1;$sub<=$cant_subclase;$sub++)
							{	
								$ide_subclase=$rs_subclase->Fields('ide_subclase');
								
								$sql_bsubclase = "select idb_subclase,r_peso from b_subclase 
								where ide_subclase=$ide_subclase and fecha='$fecha_base' and id_mercado_nuevo='$id_mercado_nuevo'";//print $sql_gsubclase;die();
								$rs_bsubclase = $db->Execute($sql_bsubclase)or die($db->ErrorMsg());
								
								$idb_subclase=$rs_bsubclase->Fields('idb_subclase');
								$r_peso_sub=$rs_bsubclase->Fields('r_peso');
								
								if($idb_subclase!="" and $r_peso_sub!="")
								{				
									$sql_articulo = "select ide_articulo, earticulo from e_articulo 
									where ide_subclase=$ide_subclase and ide_articulo!='1'";		
									$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg());
									$cant_articulo=$rs_articulo->RecordCount();
						
									$rs_articulo->MoveFirst();
									for($art=1;$art<=$cant_articulo;$art++)
									{
										$ide_articulo=$rs_articulo->Fields('ide_articulo');
										
										$sql_barticulo = "select idb_articulo,r_peso from b_articulo 
										where ide_articulo='$ide_articulo' and fecha='$fecha_base' 
										and id_mercado_nuevo='$id_mercado_nuevo'";//print "<br>".$sql_barticulo;						
										$rs_barticulo = $db->Execute($sql_barticulo)or die($db->ErrorMsg());
										
										$idb_articulo=$rs_barticulo->Fields('idb_articulo');
										$r_peso_art=$rs_barticulo->Fields('r_peso');
										
										if($idb_articulo!="" and $r_peso_art!="")
										{//print "dfrs";
											$sql_d_articulo = "select idd_articulo, indice from d_articulo 
											where idb_articulo='".$idb_articulo."' and fecha='$fecha_d_articulo'"; 
											$rs_d_articulo = $db->Execute($sql_d_articulo)or die($db->ErrorMsg());
											
											$indice_art=$rs_d_articulo->Fields('indice');//print "ind".$indice_art."<br>";
											
											if($indice_art!="")
											{										
												$count_i_a=count($matriz_art);//print "count".$count."<br>";
												$matriz_art[$count_i_a]=$indice_art;
												//print "matriz_art:".$matriz_art[$count_i_a]." count:".$count_i_a." ind:".$indice_art."<br><br>";			
																						
												$count_p_a=count($matriz_r_peso_art);
												$matriz_r_peso_art[$count_p_a]=$r_peso_art;
												//print "matriz_peso:".$matriz_r_peso_art[$count_p_a]." count:".$count_p_a." ind:".$r_peso_art."<br><br>";
												
												$p=$indice_art*$r_peso_art;
												//print "prod:".$p."<br><br>";
												$articulo=$rs_articulo->Fields('earticulo');
											//print "$articulo"."<br><br>".$artr=$artr+1;	
											}
											/*else
											{
												$articulo=$rs_articulo->Fields('earticulo');
											print "$articulo"."<br>".$artr=$artr+1;	
											}*/
										}						
									$rs_articulo->MoveNext();
									}
									//print $matriz_art[0]."       ".$matriz_r_peso_art[0]."<br>";
									if($matriz_art[0]!="" && $matriz_r_peso_art[0]!="")
									{//print "entra";//print $matriz_art[0]."       ".$matriz_r_peso_art[0]."<br>";
										$indice_sub_ari_pond=$obj->ari_pond($matriz_art,$matriz_r_peso_art);						
										foreach ($matriz_art as $f => $valorf) {unset($matriz_art[$f]);}
										foreach ($matriz_r_peso_art as $i => $valor) {unset($matriz_r_peso_art[$i]);}	
										$count_i_a=0;	$count_p_a=0;	
										
										$sql_sel_d_subclase = "SELECT idd_subclase FROM d_subclase 
										WHERE idb_subclase='".$idb_subclase."' and fecha='".$fecha_d_articulo."'";//print 	$sql_sel_i_subclase;
										$rs_sel_d_subclase = $db->Execute($sql_sel_d_subclase) or die($db->ErrorMsg());//print $sql_sel_art;				
										$idd_subclase=$rs_sel_d_subclase->Fields('idd_subclase');
											
										if($idd_subclase!="")
										{
											$sql_upd_sub = "UPDATE d_subclase SET  fecha='".$fecha_d_articulo."',indice ='".$indice_sub_ari_pond."' 
											WHERE idd_subclase='".$idd_subclase."'";
											$db->Execute($sql_upd_sub) or die($db->ErrorMsg());//print $sql_upd_sub."<br>";			
										}
										else
										{													
											$sql_ins_sub="INSERT INTO d_subclase (idb_subclase,indice,fecha) 
											VALUES($idb_subclase ,$indice_sub_ari_pond,'".$fecha_d_articulo."')";//print $sql_ins_sub."<br>";
											$rs_ins_sub=$db->Execute($sql_ins_sub) or die($db->ErrorMsg());							
										}
									}//del if	
									//else
									//print $matriz_art[0]."       ".$matriz_r_peso_art[0];die("   ya");
															
									$sql_d_subclase = "select idd_subclase, indice from d_subclase 
									where idb_subclase='".$idb_subclase."' and fecha='$fecha_d_articulo'";//print "$sql_d_subclase";	 
									$rs_d_subclase = $db->Execute($sql_d_subclase)or die($db->ErrorMsg()) ;
																
									$indice_sub=$rs_d_subclase->Fields('indice');
										
									if($indice_sub!="")
									{								
										$count_i_s=count($matriz_sub);
										$matriz_sub[$count_i_s]=$indice_sub;//print "ind".$indice_sub."<br>";
										
										$count_p_s=count($matriz_r_peso_sub);
										$matriz_r_peso_sub[$count_p_s]=$r_peso_sub;//print $r_peso_sub."<br>";				
									}			
								}//del if
							$rs_subclase->MoveNext();
							}
							
							if($matriz_sub[0]!="" && $matriz_r_peso_sub[0]!="")
							{
								$indice_sub_ari_pond=$obj->ari_pond($matriz_sub,$matriz_r_peso_sub);						
								foreach ($matriz_sub as $f => $valorf) {unset($matriz_sub[$f]);}
								foreach ($matriz_r_peso_sub as $i => $valor) {unset($matriz_r_peso_sub[$i]);}	
								$count_i_s=0;$count_p_s=0;	
								
								$sql_sel_d_clase = "SELECT idd_clase FROM d_clase 
								WHERE idb_clase='".$idb_clase."' and fecha='".$fecha_d_articulo."'";	//print 	$sql_sel_sub;
								$rs_sel_d_clase = $db->Execute($sql_sel_d_clase) or die($db->ErrorMsg());//print $sql_sel_sub;				
								$idd_clase=$rs_sel_d_clase->Fields('idd_clase');
									
								if($idd_clase!="")
								{
									$sql_upd_sub = "UPDATE d_clase SET  fecha='".$fecha_d_articulo."',indice ='".$indice_sub_ari_pond."' 
									WHERE idd_clase='".$idd_clase."'";
									$db->Execute($sql_upd_sub) or die($db->ErrorMsg());//print $sql_upd_sub;
								}
								else
								{													
									$sql_ins_sub="INSERT INTO d_clase (idb_clase,indice,fecha) 
									VALUES($idb_clase ,$indice_sub_ari_pond,'".$fecha_d_articulo."')";//print $sql_d_subclase;
									$rs_ins_sub=$db->Execute($sql_ins_sub) or die($db->ErrorMsg());							
								}
							}//del if	
							
							$sql_d_clase = "select idd_clase, indice from d_clase 
							where idb_clase='".$idb_clase."' and fecha='$fecha_d_articulo'";//print "$sql_variedad";	 
							$rs_d_clase = $db->Execute($sql_d_clase)or die($db->ErrorMsg()) ;
														
							$indice_cla=$rs_d_clase->Fields('indice');
							
							if($indice_cla!="")
							{									
								$count_i_c=count($matriz_cla);
								$matriz_cla[$count_i_c]=$indice_cla;
								
								$count_p_c=count($matriz_r_peso_cla);
								$matriz_r_peso_cla[$count_p_c]=$r_peso_cla;
							}				
						}//del if
					$rs_clase->MoveNext();
					}
				
					if($matriz_cla[0]!="" && $matriz_r_peso_cla[0]!="")
					{
						$indice_cla_ari_pond=$obj->ari_pond($matriz_cla,$matriz_r_peso_cla);						
						foreach ($matriz_cla as $f => $valorf) {unset($matriz_cla[$f]);}
						foreach ($matriz_r_peso_cla as $i => $valor) {unset($matriz_r_peso_cla[$i]);}	
						$count_i_c=0;	$count_p_c=0;	
						
						$sql_sel_d_grupo = "SELECT idd_grupo FROM d_grupo 
						WHERE idb_grupo='".$idb_grupo."' and fecha='".$fecha_d_articulo."'";	//print 	$sql_sel_cla;
						$rs_sel_d_grupo = $db->Execute($sql_sel_d_grupo) or die($db->ErrorMsg());//print $sql_sel_cla;				
						$idd_grupo=$rs_sel_d_grupo->Fields('idd_grupo');
							
						if($idd_grupo!="")
						{
							$sql_upd_gru = "UPDATE d_grupo SET  fecha='".$fecha_d_articulo."',indice ='".$indice_cla_ari_pond."' 
							WHERE idd_grupo='".$idd_grupo."'";
							$db->Execute($sql_upd_gru) or die($db->ErrorMsg());//print $sql_upd_cla;
						}
						else
						{													
							$sql_ins_gru="INSERT INTO d_grupo (idb_grupo,indice,fecha) 
							VALUES($idb_grupo ,$indice_cla_ari_pond,'".$fecha_d_articulo."')";//print $sql_d_clase;
							$db->Execute($sql_ins_gru) or die($db->ErrorMsg());							
						}
					}//del if	
					
					$sql_d_grupo = "select idd_grupo, indice from d_grupo 
					where idb_grupo='".$idb_grupo."' and fecha='$fecha_d_articulo'";//print "$sql_variedad";	 
					$rs_d_grupo = $db->Execute($sql_d_grupo)or die($db->ErrorMsg()) ;
												
					$indice_gru=$rs_d_grupo->Fields('indice');
					
					if($indice_gru=="")
					{$indice_gru=0;}
					
														
					if($indice_gru!="")
					{
						$count_i_g=count($matriz_gru);
						$matriz_gru[$count_i_g]=$indice_gru;//print "matriz_gru:".$matriz_gru[$count_i_g]." count:".$count_i_g." ind:".$indice_gru."<br><br>";
						
						$count_p_g=count($matriz_r_peso_gru);
						$matriz_r_peso_gru[$count_p_g]=$r_peso_gru;//print "matriz_peso:".$matriz_r_peso_gru[$count_p_g]." count:".$count_p_g." ind:".$r_peso_gru."<br><br>";
						//$p=$indice_gru*$r_peso_gru;
						//print "prod:".$p."<br><br>";
					}
				}//del if
			$rs_grupo->MoveNext();
			}
			
			if($matriz_gru[0]!="" && $matriz_r_peso_gru[0]!="")
			{
				$indice_gru_ari_pond=$obj->ari_pond($matriz_gru,$matriz_r_peso_gru);print $indice_gru_ari_pond;						
				foreach ($matriz_gru as $f => $valorf) {unset($matriz_gru[$f]);}
				foreach ($matriz_r_peso_gru as $i => $valor) {unset($matriz_r_peso_gru[$i]);}	
				$count_i_g=0;$count_p_g=0;	
				
				$sql_sel_d_division = "SELECT idd_division FROM d_division 
				WHERE idb_division='".$idb_division."' and fecha='".$fecha_d_articulo."'";	//print 	$sql_sel_gru;
				$rs_sel_d_division = $db->Execute($sql_sel_d_division) or die($db->ErrorMsg());//print $sql_sel_gru;				
				$idd_division=$rs_sel_d_division->Fields('idd_division');
					
				if($idd_division!="")
				{
					$sql_upd_div = "UPDATE d_division SET  fecha='".$fecha_d_articulo."',indice ='".$indice_gru_ari_pond."' 
					WHERE idd_division='".$idd_division."'";
					$db->Execute($sql_upd_div) or die($db->ErrorMsg());//print $sql_upd_div."<br><br>";
				}
				else
				{													
					$sql_ins_div="INSERT INTO d_division (idb_division,indice,fecha) 
					VALUES($idb_division ,$indice_gru_ari_pond,'".$fecha_d_articulo."')";//print $sql_ins_div."<br><br>";
					$db->Execute($sql_ins_div) or die($db->ErrorMsg());					
				}
				//$division=$rs_division->Fields('division');print $division."<br><br>";
				
			}//del if	
			
			$sql_d_division = "select idd_division, indice from d_division 
			where idb_division='".$idb_division."' and fecha='$fecha_d_articulo'";//print "$sql_variedad";	 
			$rs_d_division = $db->Execute($sql_d_division)or die($db->ErrorMsg()) ;
										
			$indice_div=$rs_d_division->Fields('indice');
												
			if($indice_div!="")
			{
				$count_i_d=count($matriz_div);
				$matriz_div[$count_i_d]=$indice_div;
				
				$count_p_d=count($matriz_r_peso_div);
				$matriz_r_peso_div[$count_p_d]=$r_peso_div;
			}
		}//del if
	$rs_division->MoveNext();
	}
	
	if($matriz_div[0]!="" && $matriz_r_peso_div[0]!="")
	{
		$indice_div_ari_pond=$obj->ari_pond($matriz_div,$matriz_r_peso_div);						
		foreach ($matriz_div as $f => $valorf) {unset($matriz_div[$f]);}
		foreach ($matriz_r_peso_div as $i => $valor) {unset($matriz_r_peso_div[$i]);}	
		$count_i_d=0;$count_p_d=0;	
		
		$sql_sel_d_general = "SELECT id_general FROM d_general 
		WHERE fecha='".$fecha_d_articulo."' and id_mercado_nuevo='$id_mercado_nuevo'";	//print 	$sql_sel_div;
		$rs_sel_d_general = $db->Execute($sql_sel_d_general) or die($db->ErrorMsg());//print $sql_sel_div;				
		$id_general=$rs_sel_d_general->Fields('id_general');
			
		if($id_general!="")
		{
			$sql_upd_gen = "UPDATE d_general SET  id_mercado_nuevo='$id_mercado_nuevo', fecha='".$fecha_d_articulo."',indice ='".$indice_div_ari_pond."' 
			WHERE id_general='".$id_general."'";
			$rs_upd_gen=$db->Execute($sql_upd_gen) or die($db->ErrorMsg());//print $sql_upd_div;
		}
		else
		{													
			$sql_ins_gen="INSERT INTO d_general (indice,fecha,id_mercado_nuevo) 
			VALUES($indice_div_ari_pond,'".$fecha_d_articulo."','".$id_mercado_nuevo."')";//print $sql_d_general;
			$rs_ins_gen=$db->Execute($sql_ins_gen) or die($db->ErrorMsg());					
		}
	}//del if		
$rs_moneda->MoveNext();
}
					
		
if($rs_ins_gen || $rs_upd_gen)
{
unlink("ejecutado.txt");
$gestor = @fopen("ejecutado.txt", "a");
	if ($gestor) 
	{
	   
	   if (fwrite($gestor, "0") === FALSE) 
		{
			echo "No se puede escribir al archivo.";
			exit;
		}
		fclose($gestor);
	}
}
	
/*
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------
$fecha_cierre_sem4_1=substr($fecha_base,0,8)."04";

$mes1=date("m");
$ano1=date("Y");
if($mes1=="01")
{$mes_ant1="12";$ano_ant1=$ano1-1;}
else
{$mes_ant1=$mes1-1;$ano_ant1=$ano1;}

if(strlen($mes_ant1)==1)
$mes_ant1=0 .$mes_ant1;

$fecha_01_fin1=$ano1."/".$mes1."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini1=$ano_ant1."/".$mes_ant1."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_1."' 
and fecha_cal>='$fecha_01_ini1' and fecha_cal<'$fecha_01_fin1' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_pasada=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------

$mes=substr($fecha_cal_inicio_sem1_pasada,5,2);
if($mes=="01")$fecha_text= "Enero";
if($mes=="02")$fecha_text= "Febrero";
if($mes=="03")$fecha_text= "Marzo";
if($mes=="04")$fecha_text= "Abril";
if($mes=="05")$fecha_text= "Mayo";
if($mes=="06")$fecha_text= "Junio";
if($mes=="07")$fecha_text= "Julio";
if($mes=="08")$fecha_text= "Agosto";
if($mes=="09")$fecha_text= "Septiembre";
if($mes=="10")$fecha_text= "Octubre";
if($mes=="11")$fecha_text= "Noviembre";
if($mes=="12")$fecha_text= "Diciembre";*/
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices de los niveles superiores a nivel nacional por mercado usando media aritmética ponderada para la fecha: ".$fecha_d_articulo.".");
?>
