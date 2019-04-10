<?php 
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");
$obj = new medias;
$relativos = array();	

include($x."administracion/config/fechas.php");

$mes=$mes1;
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
if($mes=="12")$fecha_text= "Diciembre";

//---------------------------------------------------
$sql_fecha_d_var_dpa = "select max(fecha) from d_var_dpa";
$rs_fecha_d_var_dpa = $db->Execute($sql_fecha_d_var_dpa) or die($db->ErrorMsg());
$fecha_d_var_dpa = $rs_fecha_d_var_dpa->Fields('max');
//---------------------------------------------------


			
$sql_barticulo = "select distinct idb_articulo, ecod_articulo, earticulo, b_articulo.id_mercado_nuevo, mercado_nuevo 
from b_articulo,e_articulo, n_mercado
where n_mercado.id_mercado_nuevo=b_articulo.id_mercado_nuevo and e_articulo.ide_articulo=b_articulo.ide_articulo and fecha='$fecha_base' and r_peso!='0' order by idb_articulo";//print "<br>".$sql_barticulo;		die();				
$rs_barticulo = $db->Execute($sql_barticulo) or die($db->ErrorMsg());

$cant_art=$rs_barticulo->RecordCount();


for($art=1;$art<=$cant_art;$art++)
{
	$idb_articulo=$rs_barticulo->Fields('idb_articulo');//print $idb_articulo."<br>";
	$ecod_articulo=$rs_barticulo->Fields('ecod_articulo');
	$earticulo=$rs_barticulo->Fields('earticulo');
	$id_mercado_nuevo=$rs_barticulo->Fields('id_mercado_nuevo');
	
	
		
		$mercado_nuevo=$rs_barticulo->Fields('mercado_nuevo');
		
		$sql_sel_variedad = "select distinct ecod_var, variedad
		from e_articulo, b_articulo, b_variedad, n_variedad, n_var_estab, captacion, captacion as cap_ant
		WHERE e_articulo.ide_articulo=b_articulo.ide_articulo				
		and e_articulo.ide_articulo=n_variedad.ide_articulo 
		and n_variedad.id_variedad=b_variedad.id_variedad		
		and b_variedad.idb_variedad=n_var_estab.idb_variedad 
		and b_articulo.id_mercado_nuevo='$id_mercado_nuevo'
		and n_var_estab.id_var_estab=captacion.id_var_estab 
		and n_var_estab.id_var_estab=cap_ant.id_var_estab
		
		and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
		and captacion.fecha<'$fecha_cal_inicio_sem1_next' 
		and cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
		and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual'
		
		and captacion.precio!=0 and captacion.va_a_calculo='1'
		and cap_ant.precio!=0 and n_var_estab.desuso='0' 
		and n_variedad.ide_articulo!='1' and b_articulo.idb_articulo='$idb_articulo'
		and fecha_captar >='".$fecha_base."'";//if($idb_articulo=='17828'){print $id_mercado_nuevo."<br><br><br>";
		//print $sql_sel_variedad."<br><br><br>";die();}
		$rs_sel_variedad = $db->Execute($sql_sel_variedad) or die($db->ErrorMsg());
		
		$cant_variedad=$rs_sel_variedad->RecordCount();
		
		//$aux=$aux+1;
		//print $cant_variedad."<br>";
		if($cant_variedad==0)
		{//print $sql_sel_variedad."<br>";
			//$existen=0;//print $aux."<br>";
			//print $sql_sel_variedad."<br><br><br>";
			$cadena=$cadena."<br>".$ecod_articulo." ".$earticulo." en ".$mercado_nuevo." - ".$idb_articulo;//print $cadena;die();
	
			//header("Location:../administracion/config/admin.php?msg=Existen artículos sin precio para el mes de ".$fecha_text." o el anterior.  Uno de ellos es: ".$ecod_articulo." ".$earticulo." en ".$mercado_nuevo);
		}
		
	
$rs_barticulo->MoveNext();//if($existen==0)
	//$cadena=$cadena.$ecod_articulo." ".$earticulo." en ".$mercado_nuevo.$idb_articulo;
	////die();
	//$existen=1; 
}
//print $cadena;die();
if($cadena)
header("Location:../administracion/config/admin.php?msg=Existen artículos sin precio para el mes de ".$fecha_text." o el anterior.  Ellos son: ".$cadena);
else
header("Location:../administracion/config/admin.php?msg=Todos los artículos tienen precio para el mes de ".$fecha_text." y el anterior. Puede realizar el cálculo.");
?>

