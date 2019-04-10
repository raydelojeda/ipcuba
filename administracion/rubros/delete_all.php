<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");

//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_max = $rs_fecha->Fields('max');
//------------------------------FECHA MAXIMA DE LA BASE---------------------



$sql_division = "delete from i_division where fecha>='".$fecha_max."'";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_division = "delete from i_grupo where fecha>='".$fecha_max."'";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_clase = "delete from i_clase where fecha>='".$fecha_max."'";		
$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_subclase = "delete from i_subclase where fecha>='".$fecha_max."'";		
$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg()) ;

$sql_articulo = "delete from i_articulo where fecha>='".$fecha_max."'";	
$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg()) ;





$sql_division = "delete from g_division where fecha='".$fecha_max."'";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_grupo = "delete from g_grupo where fecha='".$fecha_max."'";		
$rs_grupo = $db->Execute($sql_grupo)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_clase = "delete from g_clase where fecha='".$fecha_max."'";		
$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_subclase = "delete from g_subclase where fecha='".$fecha_max."'";		
$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_articulo = "delete from g_articulo where fecha='".$fecha_max."'";	//where id_mercado='2'	
$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg()) ;
//----------------------------------------------------------


//include("../Copy of base/calculo_valor.php");
?>