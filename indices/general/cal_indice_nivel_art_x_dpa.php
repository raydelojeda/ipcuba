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

if($contenido=="2")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo nacional usando media aritmética simple.");

if($contenido=="3")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.");

if($contenido=="4")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo del lndice general nacional usando media aritmética ponderada.");

/*if($contenido!="1")
print $contenido;
die();*/

//---------------------------------------------------
$sql_fecha_base = "select max(fecha) from b_variedad";
$rs_fecha_base = $db->Execute($sql_fecha_base) or die($db->ErrorMsg());
$fecha_base = $rs_fecha_base->Fields('max');
//---------------------------------------------------


//---------------------------------------------------
$sql_fecha_i_var_dpa = "select max(fecha) from i_var_dpa";
$rs_fecha_i_var_dpa = $db->Execute($sql_fecha_i_var_dpa) or die($db->ErrorMsg());
$fecha_i_var_dpa = $rs_fecha_i_var_dpa->Fields('max');
//---------------------------------------------------

	
		
$sql_sel_dpa = "select * from n_dpa where incluido='1' order by cod_dpa"; 
$rs_sel_dpa = $db->Execute($sql_sel_dpa) or die($db->ErrorMsg());

$cant_dpa=$rs_sel_dpa->RecordCount();
$rs_sel_dpa->MoveFirst();
for($dpa=1;$dpa<=$cant_dpa;$dpa++)
{
	$cod_dpa=$rs_sel_dpa->Fields('cod_dpa');
		
	$sql_sel_articulo = "select distinct ide_articulo from i_var_dpa, n_variedad 
	where n_variedad.id_variedad=i_var_dpa.id_variedad and cod_dpa='".$cod_dpa."' and fecha='".$fecha_i_var_dpa."' 
	order by ide_articulo"; //print $sql_sel_articulo."<br>";//die();
	$rs_sel_articulo = $db->Execute($sql_sel_articulo) or die($db->ErrorMsg());
	
	$cant_articulo=$rs_sel_articulo->RecordCount();
	$rs_sel_articulo->MoveFirst();
	
	for($e_art=1;$e_art<=$cant_articulo;$e_art++)
	{ //$b=$b+1;
	//print $b."<br>";
		$ide_articulo=$rs_sel_articulo->Fields('ide_articulo');	
		$sql_sel_i_var_dpa = "select i_var_dpa.indice from i_var_dpa, n_variedad 
		where n_variedad.id_variedad=i_var_dpa.id_variedad and cod_dpa='".$cod_dpa."' and fecha='".$fecha_i_var_dpa."' 
		and ide_articulo='$ide_articulo'"; //print $sql_sel_i_var_dpa."<br>";//die();
		$rs_sel_i_var_dpa = $db->Execute($sql_sel_i_var_dpa) or die($db->ErrorMsg());
		
		$cant_i_var_dpa=$rs_sel_i_var_dpa->RecordCount();
		$rs_sel_i_var_dpa->MoveFirst();
		for($i_var_dpa=1;$i_var_dpa<=$cant_i_var_dpa;$i_var_dpa++)
		{ 
			$indice_var=$rs_sel_i_var_dpa->Fields('indice');	
			$count_geo=count($geo_art_dpa);
			$geo_art_dpa[$count_geo]=$indice_var;
			
		$rs_sel_i_var_dpa->MoveNext();   		
		}
		
		$indice_art_geo=$obj->geo($geo_art_dpa);
		
		foreach ($geo_art_dpa as $f => $valorf) {unset($geo_art_dpa[$f]);}
		$count_geo=0;
		
		$sql_sel_iart = "SELECT id_art_dpa FROM i_art_dpa 
		WHERE cod_dpa='".$cod_dpa."' and ide_articulo='".$ide_articulo."' and fecha='$fecha_i_var_dpa'";//print $sql_sel_iart."<br>";//die();								
		$rs_sel_iart = $db->Execute($sql_sel_iart) or die($db->ErrorMsg());
		
		$id_art_dpa=$rs_sel_iart->Fields('id_art_dpa');
	   
		if($id_art_dpa!='')
		{
		$sql_upd_iart = "UPDATE i_art_dpa SET fecha='".$fecha_i_var_dpa."', indice ='".$indice_art_geo."' 
		WHERE id_art_dpa='".$id_art_dpa."'";//print $sql_upd_iart."<br>";
		$rs_upd_iart =$db->Execute($sql_upd_iart) or die($db->ErrorMsg()); 
		}
		else
		{
		$sql_ins_iart = "INSERT INTO i_art_dpa (fecha,indice,ide_articulo,cod_dpa) 
		VALUES('".$fecha_i_var_dpa."','".$indice_art_geo."','".$ide_articulo."','".$cod_dpa."')";//print $sql_ins_iart."<br>";	
		$rs_ins_iart = $db->Execute($sql_ins_iart) or die($db->ErrorMsg());
		}
	$rs_sel_articulo->MoveNext();  
	}
	
$rs_sel_dpa->MoveNext();   
}//llave del for de n_dpa

if($rs_ins_iart || $rs_upd_iart)
{
unlink("ejecutado.txt");
$gestor = @fopen("ejecutado.txt", "a");
	if ($gestor) 
	{
	   
	   if (fwrite($gestor, "2") === FALSE) 
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
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices a nivel de artículo en cada municipio usando media geométrica para la fecha: ".$fecha_i_var_dpa.".");?>
