<?php
/*$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");*/

$sel_mes=$_GET["sel_mes"];
$sel_ano=$_GET["sel_ano"];

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

if($sel_mes && $sel_ano)
{
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$fecha_cierre_sem4_1=substr($fecha_base,0,8)."04";

$mes1=$sel_mes;
$ano1=$sel_ano;

if($mes1=="12")
{$mes_next1="01";$ano_next1=$ano1+1;}
else {$mes_next1=$mes1+1;$ano_next1=$ano1;}

if(strlen($mes_next1)==1)
$mes_next1=0 .$mes_next1; 

$fecha_01_fin1=$ano_next1."/".$mes_next1."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini1=$ano1."/".$mes1."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal1 = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_1."' 
and fecha_cal>='$fecha_01_ini1' and fecha_cal<'$fecha_01_fin1' order by fecha_captar";//print $sql_cal;die();	
$rs_cal1 = $db->Execute($sql_cal1) or die($db->ErrorMsg());
$fecha_cal_inicio_sem1_actual=$rs_cal1->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
$fecha_cierre_sem4_2=substr($fecha_base,0,8)."04";


$mes2=$sel_mes;
$ano2=$sel_ano;

if($mes2=="12")
{$mes_next2="01";$ano_next2=$ano2+1;}
else {$mes_next2=$mes2+1;$ano_next2=$ano2;}

if(strlen($mes_next2)==1)
$mes_next2=0 .$mes_next2;

$fecha_01_fin2=$ano_next2."/".$mes_next2."/"."10";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini2=$ano2."/".$mes2."/"."10";//esta fecha es para quedarme dentro del mes actual

$sql_cal2 = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_2."' 
and fecha_cal>='$fecha_01_ini2' and fecha_cal<'$fecha_01_fin2' order by fecha_captar";		
$rs_cal2 = $db->Execute($sql_cal2) or die($db->ErrorMsg());//print $sql_cal2;die();
$fecha_cal_inicio_sem1_next=$rs_cal2->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------

//--------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL AÑO ANTERIOR--------------------------
$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";


$mes3=$sel_mes;
$ano3=$sel_ano-1;

if($mes3=="12")
{$mes_next3="01";$ano_next3=$ano3+1;}

else {$mes_next3=$mes3+1;$ano_next3=$ano3;}

if(strlen($mes_next3)==1)
$mes_next3=0 .$mes_next3;

$fecha_01_fin3=$ano_next3."/".$mes_next3."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini3=$ano3."/".$mes3."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal3 = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_3."' 
and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";//print $sql_cal3;die();
$rs_cal3 = $db->Execute($sql_cal3) or die($db->ErrorMsg());
$fecha_cal_inicio_sem1_inter=$rs_cal3->fields["fecha_cal"];
//--------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL AÑO ANTERIOR--------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------
$fecha_cierre_sem4_4=substr($fecha_base,0,8)."04";

$mes4=$sel_mes;
$ano4=$sel_ano;
if($mes4=="01")
{$mes_ant4="12";$ano_ant4=$ano4-1;}
else
{$mes_ant4=$mes4-1;$ano_ant4=$ano4;}

if(strlen($mes_ant4)==1)
$mes_ant4=0 .$mes_ant4;

$fecha_01_fin4=$ano4."/".$mes4."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini4=$ano_ant4."/".$mes_ant4."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal4 = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_4."' 
and fecha_cal>='$fecha_01_ini4' and fecha_cal<'$fecha_01_fin4' order by fecha_captar";		
$rs_cal4 = $db->Execute($sql_cal4) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_pasada=$rs_cal4->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------

}
/*
print "FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL: ".$fecha_cal_inicio_sem1_actual."<br>";   
print "FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT: ".$fecha_cal_inicio_sem1_next."<br>";  
print "FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL A&Ntilde;O ANTERIOR: ".$fecha_cal_inicio_sem1_inter."<br>";  
print "FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO: ".$fecha_cal_inicio_sem1_pasada."<br>";  */
?>