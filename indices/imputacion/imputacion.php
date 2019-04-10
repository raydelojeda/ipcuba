<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 
include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");
include($x."administracion/config/fechas.php");

//cont_imp=1 para los estacionales
//cont_imp=2 para el caso 1 donde la representatividad es mayor de un 35% a nivel de variedad
//cont_imp=3 para el caso 2 donde la representatividad es menor de un 35% a nivel de variedad y mayor de un 35% dentro del artículo
//cont_imp=9 para hacer un arrastre simple. No ha dado tiempo de hacer el resto.
 
//include("imp_1.php");
//include("imp_2.php");
//include("imp_3.php"); tienen problemas los métodos de imputación
include("imp_arrastre.php");

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
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de imputaciones para el mes de ".$fecha_text.".");
?>
