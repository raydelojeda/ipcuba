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

if($contenido=="3")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.");


$relativos = array();	
//--------------------------------------------------------------------------------------------------
$sql_fecha_base = "select max(fecha) from b_variedad";
$rs_fecha_base = $db->Execute($sql_fecha_base) or die($db->ErrorMsg());
$fecha_base = $rs_fecha_base->Fields('max');
//---------------------------------------------------
//---------------------------------------------------
$sql_fecha_i_articulo = "select max(fecha) from i_articulo";
$rs_fecha_i_articulo = $db->Execute($sql_fecha_i_articulo) or die($db->ErrorMsg());
$fecha_i_articulo = $rs_fecha_i_articulo->Fields('max');
//---------------------------------------------------

	$sql_sel_articulo = "select indice, g_peso,r_peso, indice*g_peso as producto 
from i_articulo, g_articulo, e_articulo
where g_articulo.idg_articulo=i_articulo.idg_articulo and g_articulo.ide_articulo=e_articulo.ide_articulo and i_articulo.fecha='$fecha_i_articulo' and ecod_articulo like '02%'"; //print $sql_sel_articulo."<br>";die();
	$rs_sel_articulo = $db->Execute($sql_sel_articulo) or die($db->ErrorMsg());
	
	$cant_articulo=$rs_sel_articulo->RecordCount();
	$rs_sel_articulo->MoveFirst();
	
	for($e_art=1;$e_art<=$cant_articulo;$e_art++)
	{ //$b=$b+1;
	//print $b."<br>";
		$producto=$rs_sel_articulo->Fields('producto');	//print $producto."<br>";
		$suma=bcadd($suma, $producto,20);
			
	$rs_sel_articulo->MoveNext();  
	}
	
	$sql_sel_i_general = "SELECT idi_general FROM i_general 
	WHERE fecha='".$fecha_i_articulo."'";	//print 	$sql_sel_div;
	$rs_sel_i_general = $db->Execute($sql_sel_i_general) or die($db->ErrorMsg());//print $sql_sel_div;				
	$idi_general=$rs_sel_i_general->Fields('idi_general');
		
	if($idi_general!="")
	{
		$sql_upd_gen = "UPDATE i_general SET  fecha='".$fecha_i_articulo."',indice ='".$suma."' 
		WHERE idi_general='".$idi_general."'";
		$rs_upd_gen=$db->Execute($sql_upd_gen) or die($db->ErrorMsg());
		//print $sql_upd_gen;die();
	}
	else
	{													
		$sql_ins_gen="INSERT INTO i_general (indice,fecha) 
		VALUES($suma,'".$fecha_i_articulo."')";//print $sql_ins_gen;die();
		$rs_ins_gen=$db->Execute($sql_ins_gen) or die($db->ErrorMsg());					
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
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices general usando media aritmética ponderada a partir del nivel de artículo para la fecha: ".$fecha_i_articulo.".");
?>
