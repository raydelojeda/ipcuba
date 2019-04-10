<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");
$obj = new medias;
$relativos = array();	


$nombre_archivo = "ejecutado.txt";
$gestor = fopen($nombre_archivo, "r");
$contenido = fread($gestor, filesize($nombre_archivo));
fclose($gestor);

if($contenido=="0")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de variedad en cada municipio usando media geométrica.");

if($contenido=="1")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo en cada municipio usando media geométrica.");

if($contenido=="3")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.");

if($contenido=="4")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo del lndice general nacional usando media aritmética ponderada.");
//print $contenido;
//die();

//---------------------------------------------------
$sql_fecha_base = "select max(fecha) from b_variedad";
$rs_fecha_base = $db->Execute($sql_fecha_base) or die($db->ErrorMsg());
$fecha_base = $rs_fecha_base->Fields('max');
//---------------------------------------------------


//---------------------------------------------------
$sql_fecha_i_var_dpa = "select distinct fecha from i_art_dpa order by fecha desc";
$rs_fecha_i_var_dpa = $db->Execute($sql_fecha_i_var_dpa) or die($db->ErrorMsg());
$fecha_i_var_dpa = $rs_fecha_i_var_dpa->Fields('fecha');
//---------------------------------------------------

$sql_sel_n_art = "select e_articulo.ide_articulo, idg_articulo from e_articulo,g_articulo where e_articulo.ide_articulo=g_articulo.ide_articulo and fecha='$fecha_base' and e_articulo.ide_articulo!='1'"; //print $sql_sel_n_art;die();//where fecha='$fecha_i_var_dpa'
$rs_sel_n_art = $db->Execute($sql_sel_n_art) or die($db->ErrorMsg());

$cant_n_art=$rs_sel_n_art->RecordCount();
$rs_sel_n_art->MoveFirst();
for($n_art=1;$n_art<=$cant_n_art;$n_art++)
{ 
	$idg_articulo=$rs_sel_n_art->Fields('idg_articulo');
	$ide_articulo=$rs_sel_n_art->Fields('ide_articulo');
	
	//-------porcentajes en CUP y CUC-------	
	$sql_sel_bart = "SELECT sum(g_peso) FROM b_articulo 
	WHERE ide_articulo='".$ide_articulo."'";//print $sql_sel_iart."<br>";//die();								
	$rs_sel_bart = $db->Execute($sql_sel_bart) or die($db->ErrorMsg());
	
	$sum=$rs_sel_bart->Fields('sum');	
		
	$sql_sel_bart1 = "SELECT g_peso FROM b_articulo 
	WHERE ide_articulo='".$ide_articulo."' and id_mercado_nuevo='1'";//print $sql_sel_iart."<br>";//die();								
	$rs_sel_bart1 = $db->Execute($sql_sel_bart1) or die($db->ErrorMsg());
	
	$g_peso1=$rs_sel_bart1->Fields('g_peso');
	$porc1=$g_peso1/$sum;
		
	$sql_sel_bart2 = "SELECT g_peso FROM b_articulo 
	WHERE ide_articulo='".$ide_articulo."' and id_mercado_nuevo='2'";//print $sql_sel_iart."<br>";//die();								
	$rs_sel_bart2 = $db->Execute($sql_sel_bart2) or die($db->ErrorMsg());
	
	$g_peso2=$rs_sel_bart2->Fields('g_peso');
	$porc2=$g_peso2/$sum;		
	//-------porcentajes en CUP y CUC-------
	
	
	//-------índices en CUP y CUC-------
	$sql_d_articulo1 = "select indice from d_articulo, b_articulo 
	where d_articulo.idb_articulo=b_articulo.idb_articulo and ide_articulo='".$ide_articulo."' and d_articulo.fecha='$fecha_i_var_dpa' and id_mercado_nuevo='1'";// print $sql_d_articulo1;
	$rs_d_articulo1 = $db->Execute($sql_d_articulo1)or die($db->ErrorMsg());
	
	$indice_art1=$rs_d_articulo1->Fields('indice');	
	
	$sql_d_articulo2 = "select indice from d_articulo, b_articulo 
	where d_articulo.idb_articulo=b_articulo.idb_articulo and ide_articulo='".$ide_articulo."' and d_articulo.fecha='$fecha_i_var_dpa' and id_mercado_nuevo='2'"; 
	$rs_d_articulo2 = $db->Execute($sql_d_articulo2)or die($db->ErrorMsg());
	
	$indice_art2=$rs_d_articulo2->Fields('indice');	
	//-------índices en CUP y CUC-------
	
	$indice_art_ari_pond=$indice_art1*$porc1+$indice_art2*$porc2;//print $indice_art_ari_pond."=".$indice_art1."*".$porc1."+".$indice_art2."*".$porc2."<br>";


		$sql_sel_iart = "SELECT idi_articulo FROM i_articulo 
		WHERE idg_articulo='".$idg_articulo."' and fecha='$fecha_i_var_dpa'";//print $sql_sel_iart."<br>";//die();								
		$rs_sel_iart = $db->Execute($sql_sel_iart) or die($db->ErrorMsg());
		
		$idi_articulo=$rs_sel_iart->Fields('idi_articulo');
		
		if($idi_articulo!='')
		{
			$sql_upd_iart = "UPDATE i_articulo SET fecha='".$fecha_i_var_dpa."', indice ='".$indice_art_ari_pond."' 
			WHERE idi_articulo='".$idi_articulo."'";//print $sql_upd_iart."<br>";
			$rs_upd_iart = $db->Execute($sql_upd_iart) or die($db->ErrorMsg()); 
		}
		else
		{
			$sql_ins_iart = "INSERT INTO i_articulo (fecha,indice,idg_articulo) 
			VALUES('".$fecha_i_var_dpa."','".$indice_art_ari_pond."','".$idg_articulo."')";//print $sql_ins_iart."<br>";	
			$rs_ins_iart = $db->Execute($sql_ins_iart) or die($db->ErrorMsg());
		} 

$rs_sel_n_art->MoveNext();   
}//llave del for 

/*
///----------------------------------------------------------------------------------------------------------------------
///------------------Cálculo de índices a nivel de artículo a nivel nacional usando media geométrica---------------------
///----------------------------------------------------------------------------------------------------------------------

//---------------------------------------------------
$sql_fecha_base = "select max(fecha) from b_variedad";
$rs_fecha_base = $db->Execute($sql_fecha_base) or die($db->ErrorMsg());
$fecha_base = $rs_fecha_base->Fields('max');
//---------------------------------------------------


//---------------------------------------------------
$sql_fecha_i_var_dpa = "select distinct fecha from i_art_dpa order by fecha desc";
$rs_fecha_i_var_dpa = $db->Execute($sql_fecha_i_var_dpa) or die($db->ErrorMsg());
$fecha_i_var_dpa = $rs_fecha_i_var_dpa->Fields('fecha');
$rs_fecha_i_var_dpa->MoveNext();
$fecha_i_var_dpa_ant = $rs_fecha_i_var_dpa->Fields('fecha');//print $fecha_i_var_dpa."  ".$fecha_i_var_dpa_ant;die();
//---------------------------------------------------


$sql_sel_n_art = "select e_articulo.ide_articulo, idg_articulo from e_articulo,g_articulo where e_articulo.ide_articulo=g_articulo.ide_articulo and fecha='$fecha_base' and e_articulo.ide_articulo!='1'"; //print $sql_sel_n_art;die();//where fecha='$fecha_i_var_dpa'
$rs_sel_n_art = $db->Execute($sql_sel_n_art) or die($db->ErrorMsg());

$cant_n_art=$rs_sel_n_art->RecordCount();
$rs_sel_n_art->MoveFirst();
for($n_art=1;$n_art<=$cant_n_art;$n_art++)
{ 
	$idg_articulo=$rs_sel_n_art->Fields('idg_articulo');
	$ide_articulo=$rs_sel_n_art->Fields('ide_articulo');	

	$sql_sel_art = "select indice, fecha, ide_articulo from i_art_dpa 
	where ide_articulo='$ide_articulo' and fecha='$fecha_i_var_dpa'";//print $sql_sel_art;die();//where fecha='$fecha_i_var_dpa'
	$rs_sel_art = $db->Execute($sql_sel_art) or die($db->ErrorMsg());
	
	$cant_art=$rs_sel_art->RecordCount();
	$rs_sel_art->MoveFirst();
	for($art=1;$art<=$cant_art;$art++)
	{	
		$indice_art=$rs_sel_art->Fields('indice');
				
		$count_i_a=count($matriz_art);//print "count".$count."<br>";
		$matriz_art[$count_i_a]=$indice_art;
		
	$rs_sel_art->MoveNext();   
	}//llave del for
	
	
			if($matriz_art[0]!="")
			{
				$indice_art_geo=$obj->geo($matriz_art);						
				foreach ($matriz_art as $f => $valorf) {unset($matriz_art[$f]);}				
				$count_i_a=0;
			}
				
			if($fecha_i_var_dpa_ant!="")
			{	
				$sql_sel_iart_ant = "SELECT indice FROM i_articulo 
				WHERE idg_articulo='".$idg_articulo."' and fecha='$fecha_i_var_dpa_ant'";//print $sql_sel_dart_ant."<br>";die();								
				$rs_sel_iart_ant = $db->Execute($sql_sel_iart_ant) or die($db->ErrorMsg());
				
				$indice_ant=$rs_sel_iart_ant->Fields('indice');//print $indice_ant;
			}
			
			if($indice_ant!="")
			{//$indice_art=1;
			$indice_art_geo=$indice_art_geo*$indice_ant;}
			
			
				
		$sql_sel_iart = "SELECT idi_articulo FROM i_articulo 
		WHERE idg_articulo='".$idg_articulo."' and fecha='$fecha_i_var_dpa'";//print $sql_sel_iart."<br>";//die();								
		$rs_sel_iart = $db->Execute($sql_sel_iart) or die($db->ErrorMsg());
		
		$idi_articulo=$rs_sel_iart->Fields('idi_articulo');
		
		if($idi_articulo!='')
		{
			$sql_upd_iart = "UPDATE i_articulo SET fecha='".$fecha_i_var_dpa."', indice ='".$indice_art_geo."' 
			WHERE idi_articulo='".$idi_articulo."'";//print $sql_upd_iart."<br>";
			$rs_upd_iart = $db->Execute($sql_upd_iart) or die($db->ErrorMsg()); 
		}
		else
		{
			$sql_ins_iart = "INSERT INTO i_articulo (fecha,indice,idg_articulo) 
			VALUES('".$fecha_i_var_dpa."','".$indice_art_geo."','".$idg_articulo."')";//print $sql_ins_iart."<br>";	
			$rs_ins_iart = $db->Execute($sql_ins_iart) or die($db->ErrorMsg());
		} 
	
$rs_sel_n_art->MoveNext();   
}//llave del for 


///----------------------------------------------------------------------------------------------------------------------
///------------------Cálculo de índices a nivel de artículo a nivel nacional usando media geométrica---------------------
///----------------------------------------------------------------------------------------------------------------------
*/

if($rs_ins_iart || $rs_upd_iart)
{
unlink("ejecutado.txt");
$gestor = @fopen("ejecutado.txt", "a");
	if ($gestor) 
	{
	   
	   if (fwrite($gestor, "3") === FALSE) 
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
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices a nivel de artículo a nivel nacional usando media aritmética para la fecha: ".$fecha_i_var_dpa.".");
?>
