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


$sql_division = "delete from d_division";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_division = "delete from d_grupo";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_clase = "delete from d_clase";		
$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_subclase = "delete from d_subclase";		
$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg()) ;

$sql_articulo = "delete from d_articulo";	
$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg()) ;

$sql_art_dpa = "delete from d_art_dpa";	
$rs_art_dpa = $db->Execute($sql_art_dpa)or die($db->ErrorMsg()) ;

//$sql_var_dpa = "delete from d_var_dpa";	
//$rs_var_dpa = $db->Execute($sql_var_dpa)or die($db->ErrorMsg()) ;



$sql_division = "delete from b_division where fecha='".$fecha_max."'";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_division = "delete from b_grupo where fecha='".$fecha_max."'";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_clase = "delete from b_clase where fecha='".$fecha_max."'";		
$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_subclase = "delete from b_subclase where fecha='".$fecha_max."'";		
$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg()) ;
//----------------------------------------------------------
$sql_articulo = "delete from b_articulo where fecha='".$fecha_max."'";	//where id_mercado='2'	
$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg()) ;
//----------------------------------------------------------


//include("calculo_valor.php");
?>