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
$sql_fecha_i_articulo = "select max(fecha) from i_art_dpa";
$rs_fecha_i_articulo = $db->Execute($sql_fecha_i_articulo) or die($db->ErrorMsg());
$fecha_i_articulo = $rs_fecha_i_articulo->Fields('max');
//---------------------------------------------------



//-------------------FOR DE LOS NOMENCLADORES DESDE LA DIVISION HASTA VARIEDAD------------------------
//--------------------------------------------------------------------------------------------------					 
$sql_division = "select id_division from n_division";	//where cod_division like '02'	
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
$cant_division=$rs_division->RecordCount();

$rs_division->MoveFirst();
for($div=1;$div<=$cant_division;$div++)
{
    
	$id_division=$rs_division->Fields('id_division');
	$sql_gdivision = "select idg_division,r_peso from g_division where id_division=$id_division and fecha='$fecha_base'";//print $sql_gdivision;
	$rs_gdivision = $db->Execute($sql_gdivision)or die($db->ErrorMsg());
	
	$idg_division=$rs_gdivision->Fields('idg_division');
	$r_peso_div=$rs_gdivision->Fields('r_peso');
		
	if($idg_division!="" and $r_peso_div!="")
	{
    					 
		$sql_grupo = "select id_grupo, grupo from n_grupo where id_division=$id_division";		
		$rs_grupo = $db->Execute($sql_grupo)or die($db->ErrorMsg()) ;//print $sql_grupo;
		$cant_grupo=$rs_grupo->RecordCount();
		$rs_grupo->MoveFirst();
		
		for($gru=1;$gru<=$cant_grupo;$gru++)
		{   
		  
			$id_grupo=$rs_grupo->Fields('id_grupo');
			
			$sql_ggrupo = "select idg_grupo,r_peso from g_grupo where  id_grupo=$id_grupo and fecha='$fecha_base'";	
			$rs_ggrupo = $db->Execute($sql_ggrupo)or die($db->ErrorMsg());
			
			$idg_grupo=$rs_ggrupo->Fields('idg_grupo');
			$r_peso_gru=$rs_ggrupo->Fields('r_peso');
			
			if($idg_grupo!="" and $r_peso_gru!="")
			{
				$sql_clase = "select id_clase, clase from n_clase where id_grupo=$id_grupo";	//	
				$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg());//print $sql_clase;
				$cant_clase=$rs_clase->RecordCount();
			 
				$rs_clase->MoveFirst();
				for($cla=1;$cla<=$cant_clase;$cla++)
				{
					$id_clase=$rs_clase->Fields('id_clase');
					
					$sql_gclase = "select idg_clase,r_peso from g_clase where  id_clase=$id_clase and fecha='$fecha_base'";		
					$rs_gclase = $db->Execute($sql_gclase)or die($db->ErrorMsg());
					
					$idg_clase=$rs_gclase->Fields('idg_clase');
					$r_peso_cla=$rs_gclase->Fields('r_peso');
					
					if($idg_clase!="" and $r_peso_cla!="")
					{ 
						$sql_subclase = "select ide_subclase, subclase from e_subclase where id_clase='$id_clase' and ide_subclase!='1'";		
						$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg());//print $sql_subclase;// 
						$cant_subclase=$rs_subclase->RecordCount();
				
						$rs_subclase->MoveFirst();
						for($sub=1;$sub<=$cant_subclase;$sub++)
						{	
							$ide_subclase=$rs_subclase->Fields('ide_subclase');
							
							$sql_gsubclase = "select idg_subclase,r_peso from g_subclase 
							where ide_subclase=$ide_subclase and fecha='$fecha_base'";//print $sql_gsubclase;die();
							$rs_gsubclase = $db->Execute($sql_gsubclase)or die($db->ErrorMsg());
							
							$idg_subclase=$rs_gsubclase->Fields('idg_subclase');
							$r_peso_sub=$rs_gsubclase->Fields('r_peso');
							
							if($idg_subclase!="" and $r_peso_sub!="")
							{				
								$sql_articulo = "select ide_articulo from e_articulo 
								where ide_subclase=$ide_subclase and ide_articulo!='1'";		
								$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg());
								$cant_articulo=$rs_articulo->RecordCount();
					
								$rs_articulo->MoveFirst();
								for($art=1;$art<=$cant_articulo;$art++)
								{
									$ide_articulo=$rs_articulo->Fields('ide_articulo');
									
									$sql_garticulo = "select idg_articulo,r_peso from g_articulo 
									where ide_articulo=$ide_articulo and fecha='$fecha_base'";//print "<br>".$sql_garticulo;						
									$rs_garticulo = $db->Execute($sql_garticulo)or die($db->ErrorMsg());
									
									$idg_articulo=$rs_garticulo->Fields('idg_articulo');
									$r_peso_art=$rs_garticulo->Fields('r_peso');
									
									if($idg_articulo!="" and $r_peso_art!="")
									{//print "dfrs";
										$sql_i_articulo = "select idi_articulo, indice from i_articulo 
										where idg_articulo='".$idg_articulo."' and fecha='$fecha_i_articulo'";//print "$sql_i_articulo";	 
										$rs_i_articulo = $db->Execute($sql_i_articulo)or die($db->ErrorMsg());
										
										$indice_art=$rs_i_articulo->Fields('indice');
																				
										$count=count($matriz_art);
										$matriz_art[$count]=$indice_art;
										
										$count=count($matriz_r_peso_art);
										$matriz_r_peso_art[$count]=$r_peso_art;//print $matriz_art[0];				
									}						
								$rs_articulo->MoveNext();
								}
								
								if($matriz_art[0]!="" && $matriz_r_peso_art[0]!="")
								{
									$indice_sub_ari_pond=$obj->ari_pond($matriz_art,$matriz_r_peso_art);						
									foreach ($matriz_art as $f => $valorf) {unset($matriz_art[$f]);}
									foreach ($matriz_r_peso_art as $i => $valor) {unset($matriz_r_peso_art[$i]);}	
									$count=0;	
									
									$sql_sel_i_subclase = "SELECT idi_subclase FROM i_subclase 
									WHERE idg_subclase='".$idg_subclase."' and fecha='".$fecha_i_articulo."'";//print 	$sql_sel_i_subclase;
									$rs_sel_i_subclase = $db->Execute($sql_sel_i_subclase) or die($db->ErrorMsg());//print $sql_sel_art;				
									$idi_subclase=$rs_sel_i_subclase->Fields('idi_subclase');
										
									if($idi_subclase!="")
									{
										$sql_upd_sub = "UPDATE i_subclase SET  fecha='".$fecha_i_articulo."',indice ='".$indice_sub_ari_pond."' 
										WHERE idi_subclase='".$idi_subclase."'";
										$db->Execute($sql_upd_sub) or die($db->ErrorMsg());//print $sql_upd_art;
									}
									else
									{													
										$sql_ins_sub="INSERT INTO i_subclase (idg_subclase,indice,fecha) 
										VALUES($idg_subclase ,$indice_sub_ari_pond,'".$fecha_i_articulo."')";//print $sql_d_articulo;
										$rs_ins_sub=$db->Execute($sql_ins_sub) or die($db->ErrorMsg());							
									}
								}//del if	
														
								$sql_i_subclase = "select idi_subclase, indice from i_subclase 
								where idg_subclase='".$idg_subclase."' and fecha='$fecha_i_articulo'";//print "$sql_variedad";	 
								$rs_i_subclase = $db->Execute($sql_i_subclase)or die($db->ErrorMsg()) ;
															
								$indice_sub=$rs_i_subclase->Fields('indice');
																	
								$count=count($matriz_sub);
								$matriz_sub[$count]=$indice_sub;
								
								$count=count($matriz_r_peso_sub);
								$matriz_r_peso_sub[$count]=$r_peso_sub;							
											
							}//del if
						$rs_subclase->MoveNext();
						}
						
						if($matriz_sub[0]!="" && $matriz_r_peso_sub[0]!="")
						{
							$indice_sub_ari_pond=$obj->ari_pond($matriz_sub,$matriz_r_peso_sub);						
							foreach ($matriz_sub as $f => $valorf) {unset($matriz_sub[$f]);}
							foreach ($matriz_r_peso_sub as $i => $valor) {unset($matriz_r_peso_sub[$i]);}	
							$count=0;	
							
							$sql_sel_i_clase = "SELECT idi_clase FROM i_clase 
							WHERE idg_clase='".$idg_clase."' and fecha='".$fecha_i_articulo."'";	//print 	$sql_sel_sub;
							$rs_sel_i_clase = $db->Execute($sql_sel_i_clase) or die($db->ErrorMsg());//print $sql_sel_sub;				
							$idi_clase=$rs_sel_i_clase->Fields('idi_clase');
								
							if($idi_clase!="")
							{
								$sql_upd_sub = "UPDATE i_clase SET  fecha='".$fecha_i_articulo."',indice ='".$indice_sub_ari_pond."' 
								WHERE idi_clase='".$idi_clase."'";
								$db->Execute($sql_upd_sub) or die($db->ErrorMsg());//print $sql_upd_sub;
							}
							else
							{													
								$sql_ins_sub="INSERT INTO i_clase (idg_clase,indice,fecha) 
								VALUES($idg_clase ,$indice_sub_ari_pond,'".$fecha_i_articulo."')";//print $sql_d_subclase;
								$rs_ins_sub=$db->Execute($sql_ins_sub) or die($db->ErrorMsg());							
							}
						}//del if	
						
						$sql_i_clase = "select idi_clase, indice from i_clase 
						where idg_clase='".$idg_clase."' and fecha='$fecha_i_articulo'";//print "$sql_variedad";	 
						$rs_i_clase = $db->Execute($sql_i_clase)or die($db->ErrorMsg()) ;
													
						$indice_cla=$rs_i_clase->Fields('indice');
															
						$count=count($matriz_cla);
						$matriz_cla[$count]=$indice_cla;
						
						$count=count($matriz_r_peso_cla);
						$matriz_r_peso_cla[$count]=$r_peso_cla;
										
					}//del if
				$rs_clase->MoveNext();
				}
			
				if($matriz_cla[0]!="" && $matriz_r_peso_cla[0]!="")
				{
					$indice_cla_ari_pond=$obj->ari_pond($matriz_cla,$matriz_r_peso_cla);						
					foreach ($matriz_cla as $f => $valorf) {unset($matriz_cla[$f]);}
					foreach ($matriz_r_peso_cla as $i => $valor) {unset($matriz_r_peso_cla[$i]);}	
					$count=0;	
					
					$sql_sel_i_grupo = "SELECT idi_grupo FROM i_grupo 
					WHERE idg_grupo='".$idg_grupo."' and fecha='".$fecha_i_articulo."'";	//print 	$sql_sel_cla;
					$rs_sel_i_grupo = $db->Execute($sql_sel_i_grupo) or die($db->ErrorMsg());//print $sql_sel_cla;				
					$idi_grupo=$rs_sel_i_grupo->Fields('idi_grupo');
						
					if($idi_grupo!="")
					{
						$sql_upd_gru = "UPDATE i_grupo SET  fecha='".$fecha_i_articulo."',indice ='".$indice_cla_ari_pond."' 
						WHERE idi_grupo='".$idi_grupo."'";
						$db->Execute($sql_upd_gru) or die($db->ErrorMsg());//print $sql_upd_cla;
					}
					else
					{													
						$sql_ins_gru="INSERT INTO i_grupo (idg_grupo,indice,fecha) 
						VALUES($idg_grupo ,$indice_cla_ari_pond,'".$fecha_i_articulo."')";//print $sql_d_clase;
						$db->Execute($sql_ins_gru) or die($db->ErrorMsg());							
					}
				}//del if	
				
				$sql_i_grupo = "select idi_grupo, indice from i_grupo 
				where idg_grupo='".$idg_grupo."' and fecha='$fecha_i_articulo'";//print "$sql_variedad";	 
				$rs_i_grupo = $db->Execute($sql_i_grupo)or die($db->ErrorMsg()) ;
											
				$indice_gru=$rs_i_grupo->Fields('indice');
													
				$count=count($matriz_gru);
				$matriz_gru[$count]=$indice_gru;
				
				$count=count($matriz_r_peso_gru);
				$matriz_r_peso_gru[$count]=$r_peso_gru;
			
			}//del if
		$rs_grupo->MoveNext();
		}
		
		if($matriz_gru[0]!="" && $matriz_r_peso_gru[0]!="")
		{
			$indice_gru_ari_pond=$obj->ari_pond($matriz_gru,$matriz_r_peso_gru);						
			foreach ($matriz_gru as $f => $valorf) {unset($matriz_gru[$f]);}
			foreach ($matriz_r_peso_gru as $i => $valor) {unset($matriz_r_peso_gru[$i]);}	
			$count=0;	
			
			$sql_sel_i_division = "SELECT idi_division FROM i_division 
			WHERE idg_division='".$idg_division."' and fecha='".$fecha_i_articulo."'";	//print 	$sql_sel_gru;
			$rs_sel_i_division = $db->Execute($sql_sel_i_division) or die($db->ErrorMsg());//print $sql_sel_gru;				
			$idi_division=$rs_sel_i_division->Fields('idi_division');
				
			if($idi_division!="")
			{
				$sql_upd_div = "UPDATE i_division SET  fecha='".$fecha_i_articulo."',indice ='".$indice_gru_ari_pond."' 
				WHERE idi_division='".$idi_division."'";
				$db->Execute($sql_upd_div) or die($db->ErrorMsg());//print $sql_upd_gru;
			}
			else
			{													
				$sql_ins_div="INSERT INTO i_division (idg_division,indice,fecha) 
				VALUES($idg_division ,$indice_gru_ari_pond,'".$fecha_i_articulo."')";//print $sql_d_grupo;
				$db->Execute($sql_ins_div) or die($db->ErrorMsg());					
			}
		}//del if	
		
		$sql_i_division = "select idi_division, indice from i_division 
		where idg_division='".$idg_division."' and fecha='$fecha_i_articulo'";//print "$sql_variedad";	 
		$rs_i_division = $db->Execute($sql_i_division)or die($db->ErrorMsg()) ;
									
		$indice_div=$rs_i_division->Fields('indice');
											
		$count=count($matriz_div);
		$matriz_div[$count]=$indice_div;
		
		$count=count($matriz_r_peso_div);
		$matriz_r_peso_div[$count]=$r_peso_div;
	
	}//del if
$rs_division->MoveNext();
}

if($matriz_div[0]!="" && $matriz_r_peso_div[0]!="")
{
	$indice_div_ari_pond=$obj->ari_pond($matriz_div,$matriz_r_peso_div);						
	foreach ($matriz_div as $f => $valorf) {unset($matriz_div[$f]);}
	foreach ($matriz_r_peso_div as $i => $valor) {unset($matriz_r_peso_div[$i]);}	
	$count=0;	
	
	$sql_sel_i_general = "SELECT idi_general FROM i_general 
	WHERE fecha='".$fecha_i_articulo."'";	//print 	$sql_sel_div;
	$rs_sel_i_general = $db->Execute($sql_sel_i_general) or die($db->ErrorMsg());//print $sql_sel_div;				
	$idi_general=$rs_sel_i_general->Fields('idi_general');
		
	if($idi_general!="")
	{
		$sql_upd_gen = "UPDATE i_general SET  fecha='".$fecha_i_articulo."',indice ='".$indice_div_ari_pond."' 
		WHERE idi_general='".$idi_general."'";
		$rs_upd_gen=$db->Execute($sql_upd_gen) or die($db->ErrorMsg());//print $sql_upd_div;
	}
	else
	{													
		$sql_ins_gen="INSERT INTO i_general (indice,fecha) 
		VALUES($indice_div_ari_pond,'".$fecha_i_articulo."')";//print $sql_d_general;
		$rs_ins_gen=$db->Execute($sql_ins_gen) or die($db->ErrorMsg());					
	}
}//del if	
					
		
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
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices de los niveles superiores a nivel nacional usando media aritmética ponderada para la fecha: ".$fecha_i_articulo.".");
?>
