<?php 
$locat="l_cap_serie.php";
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 
include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");




if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}
       
         
                  
                  


if (isset($_GET["order"])) $order = $_GET["order"]; else $order="cont_imp";//n_variedad.id_variedad
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];
if ($_GET["sel_mes"]!="") $sel_mes = $_GET['sel_mes'];
if (isset($_POST["sel_mes"])) $sel_mes = $_POST['sel_mes'];
if($sel_mes=="")$sel_mes =date("m");
if ($_GET["sel_ano"]!="") $sel_ano = $_GET['sel_ano'];
if (isset($_POST["sel_ano"])) $sel_ano = $_POST['sel_ano']; 
if($sel_ano=="")$sel_ano =date("Y");



if($_POST['txt_ir'])
{//print "sds";
header("Location:l_cap_serie.php?curr_page=".$_POST['txt_ir']."&order=".$order."&type=".$ordtype."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa."&sel_mes=".$sel_mes."&sel_ano=".$sel_ano."&porc=".$porc);
}

$array=array("Domingo de la 1ra semana","Lunes de la 1ra semana","Martes de la 1ra semana","Miércoles de la 1ra semana","Juéves de la 1ra semana","Viérnes de la 1ra semana","Sábado de la 1ra semana","Domingo de la 2da semana","Lunes de la 2da semana","Martes de la 2da semana","Miércoles de la 2da semana","Juéves de la 2da semana","Viérnes de la 2da semana","Sábado de la 2da semana","Domingo de la 3ra semana","Lunes de la 3ra semana","Martes de la 3ra semana","Miércoles de la 3ra semana","Juéves de la 3ra semana","Viérnes de la 3ra semana","Sábado de la 3ra semana","Domingo de la 4ta semana","Lunes de la 4ta semana ","Martes de la 4ta semana","Miercoles de la 4ta semana","Jueves de la 4ta semana","Viérnes de la 4ta semana","Sábado de la 4ta semana",);


$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-1","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------
//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
//print 	$sql_usuario;
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;

$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");
//print $cod_dpa;
//---------------------------------------------------

$mes=$sel_mes;
$ano=$sel_ano;
//--------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL AÑO ANTERIOR--------------------------
$fecha_cierre_sem4_6=substr($fecha_base,0,8)."04";


$mes6=$sel_mes;
$ano6=$sel_ano-1;

if($mes6=="12")
{$mes_next6="02";$ano_next6=$ano6+1;$mes6="01";$ano6=$ano6+1;}
elseif($mes6=="11")
{$mes_next6="01";$ano_next6=$ano6+1;$mes6=$mes6+1;}
else {$mes_next6=$mes6+2;$ano_next6=$ano6;$mes6=$mes6+1;}

if(strlen($mes_ant6)==1)
$mes_ant6=0 .$mes_ant6;

$fecha_01_fin6=$ano_next6."/".$mes_next6."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini6=$ano6."/".$mes6."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_6."' 
and fecha_cal>='$fecha_01_ini6' and fecha_cal<'$fecha_01_fin6' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal);// or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_inter=$rs_cal->fields["fecha_cal"];
//--------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL AÑO ANTERIOR--------------------------


//------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ANTERIOR A IGUAL MES DEL AÑO ANTERIOR------------------
$fecha_cierre_sem4_7=substr($fecha_base,0,8)."04";


$mes7=$sel_mes-1;
$ano7=$sel_ano-1;

if($mes7=="12")
{$mes_next7="02";$ano_next7=$ano7+1;$mes7="01";$ano7=$ano7+1;}
elseif($mes7=="11")
{$mes_next7="01";$ano_next7=$ano7+1;$mes7=$mes7+1;}
else {$mes_next7=$mes7+2;$ano_next7=$ano7;$mes7=$mes7+1;}

if(strlen($mes_ant7)==1)
$mes_ant7=0 .$mes_ant7;

$fecha_01_fin7=$ano_next7."/".$mes_next7."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini7=$ano7."/".$mes7."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_7."' 
and fecha_cal>='$fecha_01_ini7' and fecha_cal<'$fecha_01_fin7' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal);// or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_inter_ant=$rs_cal->fields["fecha_cal"];
//------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ANTERIOR A IGUAL MES DEL AÑO ANTERIOR------------------



//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------
$fecha_cierre_sem4_1=substr($fecha_base,0,8)."04";

$mes1=$sel_mes;
$ano1=$sel_ano;
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
$rs_cal = $db->Execute($sql_cal);// or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_pasada=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ANTEPASADO--------------------------------
$fecha_cierre_sem4_2=substr($fecha_base,0,8)."04";

$mes2=$sel_mes;
$ano2=$sel_ano;
if($mes2=="02")
{$mes_ant2="12";$ano_ant2=$ano2-1;$mes2=$mes2-1;}
elseif($mes2=="01")
{$mes_ant2="11";$ano_ant2=$ano2-1;$mes2="12";$ano2=$ano2-1;}
else
{$mes_ant2=$mes2-2;$mes2=$mes2-1;$ano_ant2=$ano2;}

if(strlen($mes_ant2)==1)
$mes_ant2=0 .$mes_ant2;

if(strlen($mes2)==1)
$mes2=0 .$mes2;

$fecha_01_fin2=$ano2."/".$mes2."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini2=$ano_ant2."/".$mes_ant2."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_2."' 
and fecha_cal>='$fecha_01_ini2' and fecha_cal<'$fecha_01_fin2' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal);// or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_antepasada=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ANTEPASADO--------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";

$mes3=$sel_mes;
$ano3=$sel_ano;

if($mes3=="12")
{$mes_next3="01";$ano_next3=$ano3+1;}
else {$mes_next3=$mes3+1;$ano_next3=$ano3;}

if(strlen($mes_ant3)==1)
$mes_ant3=0 .$mes_ant3;

$fecha_01_fin3=$ano_next3."/".$mes_next3."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini3=$ano3."/".$mes3."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_3."' 
and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal);// or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
$fecha_cierre_sem4_4=substr($fecha_base,0,8)."04";


$mes4=$sel_mes;
$ano4=$sel_ano;

if($mes4=="12")
{$mes_next4="02";$ano_next4=$ano4+1;$mes4="01";$ano4=$ano4+1;}
elseif($mes4=="11")
{$mes_next4="01";$ano_next4=$ano4+1;$mes4=$mes4+1;}
else {$mes_next4=$mes4+2;$ano_next4=$ano4;$mes4=$mes4+1;}

if(strlen($mes_ant4)==1)
$mes_ant4=0 .$mes_ant4;

$fecha_01_fin4=$ano_next4."/".$mes_next4."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini4=$ano4."/".$mes4."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_4."' 
and fecha_cal>='$fecha_01_ini4' and fecha_cal<'$fecha_01_fin4' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_next=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------

//print $fecha_cal_inicio_sem1_inter_ant."<br>".$fecha_cal_inicio_sem1_inter."<br>".$fecha_cal_inicio_sem1_antepasada."<br>".$fecha_cal_inicio_sem1_pasada."<br>".$fecha_cal_inicio_sem1_actual."<br>".$fecha_cal_inicio_sem1_next;

//print $mes_actual;
$query = "select va_a_calculo, id_cap, id_estab_sustituido, fecha_sus, fecha_creacion, fecha_desuso,  n_var_estab.fecha_captar,captacion.id_var_estab, variedad, cod_var,ecod_var, n_variedad.id_variedad, id_estab_sustituido,fecha_sus, unidad, tipologia, cod_estab,dir,n_estab.cod_dpa,cod_dpa_nueva,prov_mun_nuevo, estab, prov_mun, captacion.id_inc,cantidad, mercado, n_mercado.id_mercado, captacion.precio, captacion.fecha, captacion.id_usuario, captacion.valor1,captacion.valor2,captacion.valor3,captacion.valor4,captacion.valor5,captacion.valor6,cap_uni,cant,

n_var_estab.valor1 as val1,n_var_estab.valor2 as val2,n_var_estab.valor3 as val3,n_var_estab.valor4 as val4,n_var_estab.valor5 as val5,n_var_estab.valor6 as val6,

carac1,carac2,carac3,carac4,carac5,carac6, captacion.cont_imp, n_inc.id_inc, inc, obs, nombre, apellidos, rol, telef, email

FROM n_mercado, n_tipologia, n_unidad,n_dpa, n_estab, n_var_estab, b_variedad, n_variedad, 
captacion, usuario, n_inc, n_obs

WHERE captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
and captacion.fecha<'$fecha_cal_inicio_sem1_next'  

and captacion.id_var_estab=n_var_estab.id_var_estab 
and b_variedad.idb_variedad=n_var_estab.idb_variedad 
and n_variedad.id_variedad=b_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa 
and n_var_estab.id_estab=n_estab.id_estab 

and usuario.id_usuario=captacion.id_usuario 
and captacion.id_obs=n_obs.id_obs 
and captacion.id_inc=n_inc.id_inc 

and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_actual') 
and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_actual') 

and central='0'
and n_variedad.ide_articulo!='1'
and n_unidad.id_unidad=n_var_estab.id_unidad
and n_tipologia.id_tipologia=n_estab.id_tipologia
and n_mercado.id_mercado=b_variedad.id_mercado";
//and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')
//and captacion.precio!='0'and n_var_estab.fecha_captar>='2008-12-04' and n_var_estab.fecha_captar<='2008-12-07'
 
   if($rol=='aut_p') 
   {$query=$query."  and n_estab.cod_dpa like '".$cod_dpa2."'";}
   elseif($rol=='autor')
   {$query=$query."  and n_estab.cod_dpa='".$cod_dpa."'";}
   elseif($rol=='admin' || $rol=='super' || $rol=='edito')
   {if($sel_cod_dpa!=0)
    $query .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
   }



if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=20;
//print $query;//die();
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;


//print $rs;
$id_estab_sustituido=$rs->fields["id_estab_sustituido"];
$fecha_creacion=$rs->fields["fecha_creacion"];
$id_cap=$rs->fields["id_cap"];


$dia_captar=substr($rs->fields["fecha_captar"],8,9);
$dia_cal=substr($rs->fields["fecha_cal"],8,9);

if($dia_captar>="04" && $dia_captar<="07")
{$miercoles_cierre="11";}

 if($dia_captar>="08" && $dia_captar<="14")
{$miercoles_cierre="18";}

 if($dia_captar>="15" && $dia_captar<="21")
{$miercoles_cierre="25";}

 if($dia_captar>="22" && $dia_captar<="27")
{$fecha_cierre_sem=$fecha_cal_inicio_sem1_next;$bandera=1;}
//print $bandera;
if($bandera!=1)
{
	if($dia_captar>$dia_cal)
	{$dif=$dia_captar-$dia_cal;$dia_cal_cierre=$miercoles_cierre-$dif;}
	else
	{$dif=$dia_cal-$dia_captar;$dia_cal_cierre=$miercoles_cierre+$dif;}
	//
	//print $dif."=".$dia_cal."-".$dia_captar;
	if(strlen($dia_cal_cierre)==1)
	$dia_cal_cierre=0 .$dia_cal_cierre;
	$fecha_cierre_sem=substr($fecha_cal_inicio_sem1_actual,0,8).$dia_cal_cierre;
}
$bandera=0;
$fecha_dig=$rs->fields["fecha"];


//print $mes;
$mes=$sel_mes;
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


$m1=substr($fecha_cal_inicio_sem1_actual,5,2);                   
$m2=substr($fecha_cal_inicio_sem1_pasada,5,2);
$m3=substr($fecha_cal_inicio_sem1_antepasada,5,2);
$m4=substr($fecha_cal_inicio_sem1_inter_ant,5,2);

$a1=substr($fecha_cal_inicio_sem1_actual,0,4);                   
$a2=substr($fecha_cal_inicio_sem1_pasada,0,4);
$a3=substr($fecha_cal_inicio_sem1_antepasada,0,4);
$a4=substr($fecha_cal_inicio_sem1_inter_ant,0,4);

if($m1=="01")$f1= "Ene/".$a1;
if($m1=="02")$f1= "Feb/".$a1;
if($m1=="03")$f1= "Mar/".$a1;
if($m1=="04")$f1= "Abr/".$a1;
if($m1=="05")$f1= "May/".$a1;
if($m1=="06")$f1= "Jun/".$a1;
if($m1=="07")$f1= "Jul/".$a1;
if($m1=="08")$f1= "Ago/".$a1;
if($m1=="09")$f1= "Sep/".$a1;
if($m1=="10")$f1= "Oct/".$a1;
if($m1=="11")$f1= "Nov/".$a1;
if($m1=="12")$f1= "Dic/".$a1;


if($m2=="01")$f2= "Ene/".$a2;
if($m2=="02")$f2= "Feb/".$a2;
if($m2=="03")$f2= "Mar/".$a2;
if($m2=="04")$f2= "Abr/".$a2;
if($m2=="05")$f2= "May/".$a2;
if($m2=="06")$f2= "Jun/".$a2;
if($m2=="07")$f2= "Jul/".$a2;
if($m2=="08")$f2= "Ago/".$a2;
if($m2=="09")$f2= "Sep/".$a2;
if($m2=="10")$f2= "Oct/".$a2;
if($m2=="11")$f2= "Nov/".$a2;
if($m2=="12")$f2= "Dic/".$a2;

if($m3=="01")$f3= "Ene/".$a3;
if($m3=="02")$f3= "Feb/".$a3;
if($m3=="03")$f3= "Mar/".$a3;
if($m3=="04")$f3= "Abr/".$a3;
if($m3=="05")$f3= "May/".$a3;
if($m3=="06")$f3= "Jun/".$a3;
if($m3=="07")$f3= "Jul/".$a3;
if($m3=="08")$f3= "Ago/".$a3;
if($m3=="09")$f3= "Sep/".$a3;
if($m3=="10")$f3= "Oct/".$a3;
if($m3=="11")$f3= "Nov/".$a3;
if($m3=="12")$f3= "Dic/".$a3;

if($m4=="01")$f4= "Ene/".$a4;
if($m4=="02")$f4= "Feb/".$a4;
if($m4=="03")$f4= "Mar/".$a4;
if($m4=="04")$f4= "Abr/".$a4;
if($m4=="05")$f4= "May/".$a4;
if($m4=="06")$f4= "Jun/".$a4;
if($m4=="07")$f4= "Jul/".$a4;
if($m4=="08")$f4= "Ago/".$a4;
if($m4=="09")$f4= "Sep/".$a4;
if($m4=="10")$f4= "Oct/".$a4;
if($m4=="11")$f4= "Nov/".$a4;
if($m4=="12")$f4= "Dic/".$a4;
?>


<html><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" --> 
<head>  

<!--  
*** Plataforma en Software Libre PHP, PostGreSQL
*** Realizado por Ing. Raydel Ojeda Figueroa 
   --> 
<!-- InstanceBeginEditable name="doctitle" --> 
<title>IPC</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --> <!-- InstanceEndEditable --> 

<?php if($_SESSION["estilo"]=="g"){?>
<link href="../../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../javascript/cal2.js"></script>
<script language="javascript" src="../../javascript/cal_conf2.js"></script>
<script language="javascript" src="../../javascript/overlib_mini.js"></script>

<script src="../../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../../imagenes/banner.jpg" width="750" height="35"></td>
  </tr>
  <tr>
   
   
   <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td style="padding-left:5px;">
	
				<div id="myMenuID"></div>
		<?php 

if ($_SESSION["rol"] == 'autor')//autor municipal 
{
?>
<script language="javascript"  src="../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../javascript/menu_invitado.js">	
		</script>
<?php
} 
?>
	</td>
	
	<td  class="intro_sup" valign="middle" align="right" >
		<a class="intro_sup" onMouseOver="return overlib('<?php if($_SESSION["rol"]=="admin")print "Administrador";
																elseif($_SESSION["rol"]=="super")print "Súper Administrador";
																elseif($_SESSION["rol"]=="edito")print "Editor-ONE";
																elseif($_SESSION["rol"]=="autor")print "Autor Municipal";
																elseif($_SESSION["rol"]=="aut_p")print "Autor Provincial";										
																elseif($_SESSION["rol"]=="jefes")print "Directivo";
																elseif($_SESSION["rol"]=="invit")print "Invitado";
		?>', BELOW, RIGHT);" onMouseOut="return nd();"href="../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../imagenes/extrasmall/exit.gif">
			&nbsp; </a>
	</td>
</tr>
</table>
   
   
   
  </tr>
  <tr>
          <td align="center" valign="middle" bgcolor="#ffffff"><!-- InstanceBeginEditable name="Body" --> 
           <form method="post" name="frm" id="frm" >
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                        <tr > 
                          <td width="6%" valign="middle"  class="us"><img src="../../imagenes/large/vcalendar.gif" width="48" height="48" border="0"></td>
                          <td width="90%" valign="middle"  class="us"><strong><font color="#5A697E" size="2">Serie 
                                 de precios no centralizados 
                                 <?php if($rol=="autor")echo "de ".$prov_mun;?>
                          </font></strong></td>
                          <td > 
                         <div align="center"><a class="toolbar" href="../autor/n_datos.php?locat=<?php print $locat; ?>"><img src="../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td> 
                            
                          <?php if($rol=="super" || $rol=="admin" || $rol=="edito") {?>
                          <?php }?>
                          <td > 
                            <div align="center"><a class="toolbar" href="../autor/n_captaciones.php?locat=<?php print $locat; ?>">
                              <img   src="../../imagenes/admin/switch_f2.png" alt="Captaciones faltantes" width="32" height="32" border="0"> 
                              <br>
                          Faltantes</a> </div></td>
                          
                           <?php if($rol=="super" || $rol=="admin" || $rol=="edito") {?>
                          <?php }?>
                          
                          
                          <td > 
                            <div align="center"> <a  class="toolbar" href="imp_datos.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td > 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('help/l_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="123"  align="center" cellpadding="0" cellspacing="0"  class="tabla" >
<tr align="center" valign="middle"> 
                    <td height="60" colspan="19"  > 
                      <table width="735" height="55" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                      <tr>
                          <td  colspan="5">
                       
                      <table width="732" align="right" class="filtro">
                       <tr>
                          <td width="77" height="27"><div align="right">Mes:</div></td>
                          <td colspan="2"><select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                              <option value="0">---------------</option>
                              <option <?php if($sel_mes=="01")print "selected";?> value="01">Enero</option>
                              <option <?php if($sel_mes=="02")print "selected";?> value="02">Febrero</option>
                              <option <?php if($sel_mes=="03")print "selected";?> value="03">Marzo</option>
                              <option <?php if($sel_mes=="04")print "selected";?> value="04">Abril</option>
                              <option <?php if($sel_mes=="05")print "selected";?> value="05">Mayo</option>
                              <option <?php if($sel_mes=="06")print "selected";?> value="06">Junio</option>
                              <option <?php if($sel_mes=="07")print "selected";?> value="07">Julio</option>
                              <option <?php if($sel_mes=="08")print "selected";?> value="08">Agosto</option>
                              <option <?php if($sel_mes=="09")print "selected";?> value="09">Septiembre</option>
                              <option <?php if($sel_mes=="10")print "selected";?> value="10">Octubre</option>
                              <option <?php if($sel_mes=="11")print "selected";?> value="11">Noviembre</option>
                              <option <?php if($sel_mes=="12")print "selected";?> value="12">Diciembre</option>
                            </select>                         </td>
                          <td width="65"  align="center"><div align="right">A&ntilde;o:</div></td>
                          <td width="167"  align="center"><div align="left">
                              <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                                <option value="0">------</option>
                                <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){?>
                                <option <?php if($sel_ano==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                                <?php }?>
                              </select>
                          </div></td>
                          <td width="84"  align="center"><div align="right"><a href="#">DPA:</a></div></td>
                          <td width="154"  align="center"><select name="sel_cod_dpa" title="Código DPA" id="sel_cod_dpa" onChange="document.frm.submit();" >
                            <option value="0">---------CUBA---------</option>
                            <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                          </select></td>
                       </tr>
					   </table>
					                </td> </tr>

<tr>
  <td width="162" height="20"><div align="left">Filtro:<input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15"></div></td>
  <td width="137"><select  onChange="document.frm.submit();"  name="sel_filtro">
    <option value="<?php echo "no" ?>">-Seleccionar-</option>
    <option value="<?php echo "captacion.fecha" ?>"<?php if ($sel_filtro == "captacion.fecha") { echo "selected"; } ?>><?php echo htmlspecialchars("Fecha digitada") ?></option>
    <option value="<?php echo "captacion.precio" ?>"<?php if ($sel_filtro == "captacion.precio") { echo "selected"; } ?>><?php echo htmlspecialchars("Precio") ?></option>
    <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
    <option value="<?php echo "cod_estab" ?>"<?php if ($sel_filtro == "cod_estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Establecimiento") ?></option>
    <option value="<?php echo "estab" ?>"<?php if ($sel_filtro == "estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Establecimiento") ?></option>
    <option value="<?php echo "ecod_var" ?>"<?php if ($sel_filtro == "ecod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Variedad") ?></option>
    <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
    <option value="<?php echo "usuario" ?>"<?php if ($sel_filtro == "usuario") { echo "selected"; } ?>><?php echo htmlspecialchars("Usuario") ?></option>
  </select></td>
  <td width="87"><div align="right"><a  href="#" onClick="javascript: document.frm.submit();">Ir: </a>
        <input  name="txt_ir" type="text" class="combo" value="" size="3" >
  </div></td>
  <td colspan="4"  align="center"><div align="right"><a href="#">
    </a><a href="#">&nbsp;
    <?php
  					
  							$pager_nav->Render_Navegator();		?>
    </a>
      <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							?>
  &nbsp;&nbsp;Ver #
  <select name="sel_#" class="inputbox"  onChange="document.frm.submit();">
    <option value="5" <?php if($ver==5){?>selected="selected" <?php } ?>>5</option>
    <option value="10" <?php if($ver==10){?>selected="selected" <?php } ?>>10</option>
    <option value="15" <?php if($ver==15){?>selected="selected" <?php } ?>>15</option>
    <option value="20" <?php if($ver==20){?>selected="selected" <?php } ?>>20</option>
    <option value="25" <?php if($ver==25){?>selected="selected" <?php } ?>>25</option>
    <option value="30" <?php if($ver==30){?>selected="selected" <?php } ?>>30</option>
    <option value="50" <?php if($ver==50){?>selected="selected" <?php } ?>>50</option>
    <option value="100" <?php if($ver==100){?>selected="selected" <?php } ?>>100</option>
    <option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
  </select>
  </div></td>
  </tr>
<tr> 
                            <td height="6" colspan="3">                              </td>
                          <td width="341"  align="center">&nbsp;</td>
                      <td width="8" colspan="3"  align="right">&nbsp;</td>
</tr>
                    </table>                    </td>
                  </tr>
                  <tr align="center" valign="center"  >
                    <td width="17" rowspan="2" class="intro">No</td>
                    <td width="50" rowspan="2" class="intro" ><a href="l_cap_serie.php?order=<?php echo "cod_dpa";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Cod DPA</a></td>
                    <td width="18" rowspan="2" class="intro" ><a href="l_cap_serie.php?order=<?php echo "mercado";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">-</a></td>
                    <td width="195" rowspan="2" class="intro" ><a href="l_cap_serie.php?order=<?php echo "estab";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Establecimiento</a></td>
                   
                    <td width="232" rowspan="2" class="intro" ><a href="l_cap_serie.php?order=<?php echo  "variedad";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Variedad</a></td>
                    <td height="20" colspan="4" class="intro" >Precio</td>
                     <td width="5" rowspan="2" class="intro" >&nbsp;</td>
                  </tr>
                  
                  <tr align="right" > 
                    <td width="50" height="20" class="intro" ><div align="right"><?php echo $f4;?></div></td>
                    <td width="50" class="intro" ><div align="right"><?php echo $f3;?></div></td>                  
                    <td width="50" class="intro" ><div align="right"><?php echo $f2;?></div></td>
                    <td width="50" class="intro" ><div align="right"><?php echo $f1;?></div></td>
                  </tr>
                  <?php
if($rs->fields[0]!='')
{	
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{
		 
			
		  $cantidad1=$rs->fields["cant"];
		  $unidad1=$rs->fields["cap_uni"];	
		  $valor11=$rs->fields["valor1"];
		  $valor12=$rs->fields["valor2"];
		  $valor13=$rs->fields["valor3"];
		  $valor14=$rs->fields["valor4"];
		  $valor15=$rs->fields["valor5"];
		  $valor16=$rs->fields["valor6"];
		  
		  $val1=$rs->fields["val1"];
		  $val2=$rs->fields["val2"];
		  $val3=$rs->fields["val3"];
		  $val4=$rs->fields["val4"];
		  $val5=$rs->fields["val5"];
		  $val6=$rs->fields["val6"];
			
			
					
		  $id_var_estab=$rs->fields["id_var_estab"];
				  
		  $sql2 = "select cont_imp,id_cap,va_a_calculo, precio, n_inc.id_inc, inc, obs, nombre, apellidos, rol, telef, email,valor1,valor2,valor3,valor4,valor5,valor6, cant, cap_uni
		  from captacion, usuario, n_inc, n_obs
		  where usuario.id_usuario=captacion.id_usuario 
		  and captacion.id_obs=n_obs.id_obs 
		  and captacion.id_inc=n_inc.id_inc 
		  and captacion.id_var_estab='$id_var_estab' 
		  and fecha>='$fecha_cal_inicio_sem1_pasada' and fecha<'$fecha_cal_inicio_sem1_actual'";
		  //print $sql2;
		  $rs2 = $db->Execute($sql2);//or die($db->ErrorMsg());
		  $p2=$rs2->fields["precio"];
		  $id_inc2=$rs2->fields["id_inc"];
		  $inc2=$rs2->fields["inc"];
		  $obs2=$rs2->fields["obs"];
		  $cont_imp2=$rs2->fields["cont_imp"];
		  $va_a_calculo2=$rs2->fields["va_a_calculo"];
		  
		  $cantidad2=$rs2->fields["cant"];
		  $unidad2=$rs2->fields["cap_uni"];
		  $valor21=$rs2->fields["valor1"];
		  $valor22=$rs2->fields["valor2"];
		  $valor23=$rs2->fields["valor3"];
		  $valor24=$rs2->fields["valor4"];
		  $valor25=$rs2->fields["valor5"];
		  $valor26=$rs2->fields["valor6"];
	
		  $sql3 = "select cont_imp, id_cap,va_a_calculo, precio, n_inc.id_inc, inc, obs, nombre, apellidos, rol, telef, email,valor1,valor2,valor3,valor4,valor5,valor6, cant, cap_uni
		  from captacion, usuario, n_inc, n_obs
		  where usuario.id_usuario=captacion.id_usuario 
		  and captacion.id_obs=n_obs.id_obs 
		  and captacion.id_inc=n_inc.id_inc 
		  and captacion.id_var_estab='$id_var_estab' 
		  and fecha>='$fecha_cal_inicio_sem1_antepasada' and fecha<'$fecha_cal_inicio_sem1_pasada'";
		  //print $sql3;
		  $rs3 = $db->Execute($sql3);//or die($db->ErrorMsg());
		  $p3=$rs3->fields["precio"];
		  $id_inc3=$rs3->fields["id_inc"];
		  $inc3=$rs3->fields["inc"];
		  $obs3=$rs3->fields["obs"];
		  $cont_imp3=$rs3->fields["cont_imp"];
		  $va_a_calculo3=$rs3->fields["va_a_calculo"];
		  
		  $cantidad3=$rs3->fields["cant"];
		  $unidad3=$rs3->fields["cap_uni"];
		  $valor31=$rs3->fields["valor1"];
		  $valor32=$rs3->fields["valor2"];
		  $valor33=$rs3->fields["valor3"];
		  $valor34=$rs3->fields["valor4"];
		  $valor35=$rs3->fields["valor5"];
		  $valor36=$rs3->fields["valor6"];
			
		  $sql4 = "select id_cap,va_a_calculo, cont_imp, precio, n_inc.id_inc, inc, obs, nombre, apellidos, rol, telef, email,valor1,valor2,valor3,valor4,valor5,valor6, cant, cap_uni
		  from captacion, usuario, n_inc, n_obs
		  where usuario.id_usuario=captacion.id_usuario 
		  and captacion.id_obs=n_obs.id_obs 
		  and captacion.id_inc=n_inc.id_inc 
		  and captacion.id_var_estab='$id_var_estab' 
		  and fecha>='$fecha_cal_inicio_sem1_inter_ant' and fecha<'$fecha_cal_inicio_sem1_inter'";
		  //print $sql4;
		  $rs4 = $db->Execute($sql4);//or die($db->ErrorMsg());
		  
		  $p4=$rs4->fields["precio"];
		  $id_inc4=$rs4->fields["id_inc"];
		  $inc4=$rs4->fields["inc"];
		  $obs4=$rs4->fields["obs"];
		  $cont_imp4=$rs4->fields["cont_imp"];
		  $va_a_calculo4=$rs4->fields["va_a_calculo"];
		  
		  $cantidad4=$rs4->fields["cantidad"];
		  $unidad4=$rs4->fields["unidad"];
		  $valor41=$rs4->fields["valor1"];
		  $valor42=$rs4->fields["valor2"];
		  $valor43=$rs4->fields["valor3"];
		  $valor44=$rs4->fields["valor4"];
		  $valor45=$rs4->fields["valor5"];
		  $valor46=$rs4->fields["valor6"];
		  
		
		  //print $fecha_cal_inicio_sem1_inter_ant;
$p=$rs->fields["precio"];
$id_inc=$rs->fields["id_inc"];
$inc=$rs->fields["inc"];
$obs=$rs->fields["obs"];		 
$cont_imp=$rs->fields["cont_imp"];
$va_a_calculo=$rs->fields["va_a_calculo"];
		  
  ?>
                  <tr  height="50" <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                    <td height="21" align="center" class="raya">
                      <?php  echo $a; ?>                      </td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "DPA: ".$rs->fields["prov_mun_nuevo"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["cod_dpa_nueva"];?></a></td>
                    
                    
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo $rs->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo substr($rs->fields["mercado"],0,1);?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Código establecimiento: ".$rs->fields["cod_estab"]."<br>Código DPA: ".$rs->fields["cod_dpa"]." - ".$rs->fields["prov_mun"]."<br>Direción: ".$rs->fields["dir"]."<br>Tipología: ".$rs->fields["tipologia"];
					/*$fecha_sus=$rs_var_estab->fields["fecha_sus"];
					for($h=0;$h<5;$h++)
					{
						if($id_estab_sustituido!="")
						{
						print "<br>---------------------------------------<br>";
						print "<b>Sustituído el día: ".$fecha_sus."</b><br>";
						$sql_sus="select * from n_mercado,n_estab, n_dpa,n_tipologia where n_estab.cod_dpa=n_dpa.cod_dpa 
						and n_estab.id_mercado=n_mercado.id_mercado and n_estab.id_tipologia=n_tipologia.id_tipologia 
						and n_estab.id_estab='$id_estab_sustituido'";
						$rs_sus=$db->Execute($sql_sus) or die($db->ErrorMsg());
						
						echo "Código establecimiento: ".$rs_sus->fields["cod_estab"]."<br>Código DPA: ".$rs_sus->fields["cod_dpa"]." - ".$rs_sus->fields["prov_mun"]."<br>Direción: ".$rs_sus->fields["dir"]."<br>Tipología: ".$rs_sus->fields["tipologia"];
						$id_estab_sustituido=$rs_sus->fields["id_estab_sustituido"];
						$fecha_sus=$rs_sus->fields["fecha_sus"];
						}
					}*/
					?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["estab"];?></a></td>
                    
                    
                    
                    
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$rs->fields["ecod_var"];
					  echo "<br><b> UM: </b>".$rs->fields["cantidad"]." ".$rs->fields["unidad"];
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$val1;}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$val2;}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$val3;}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$val4;}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$val5;}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$val6;}
					  echo "<br><br><b>Variedad dada de alta en el establecimiento el día: </b>".$fecha_creacion.".";
					  print "<br><b>Día a captar:</b> ";$d=substr($rs->fields["fecha_captar"],8,9);print $array[$d-1];
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" 
                      
                      target="_blank"
                      <?php if($rol=="super" || $rol=="admin" || $rol=="edito") {
                      $href="../../administracion/base/var_estab/m_var_estab.php?cerrar=1&var_aux_mod=".$rs->fields["id_var_estab"]; } 
					  else { 
                      $href="../../administracion/base/var_estab/m_var_estab_m.php?cerrar=1&var_aux_mod=".$rs->fields["id_var_estab"]; }?>
                      href="<?php print $href;?>"
                      ><?php echo $rs->fields["variedad"];?></a></td>
                    <td class="raya"align="center"><div align="right"><a onMouseOver="return overlib('<?php $rol4=$rs4->fields["rol"];$telef_rol4="";
					if($rol4=="edito") 
					{$telef_rol4=$rs4->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
					elseif($rol=="aut_p")
					{$telef_rol4=$rs4->fields["telef"]."<br>Rol: Autor Provincial";}
					elseif($rol4=="autor")
					{$telef_rol4=$rs4->fields["telef"]."<br>Rol: Autor Municipal";} 
					elseif($rol4=="admin")
					{$telef_rol4=$rs4->fields["telef"]."<br>Rol: Administrador";}
					
					

echo "<b>Captado por: </b>". $rs4->fields["nombre"]." ".$rs4->fields["apellidos"]."<br>E-mail: ".$rs4->fields["email"]."<br>Teléfono: ".$telef_rol4;print "<br>";if($id_inc4!=1)echo "<b>Incidencia: </b>".$inc4;else print "<b>Observación: </b>".$obs4;if($cont_imp4)print "<br><b>Precio imputado</b>";print "<br>";if($va_a_calculo4==1){print "<img src=../../imagenes/extrasmall/button_ok.gif width=16 height=16>"; print "Entra dentro del cálculo.";} else {print "<img src=../../imagenes/extrasmall/button_cancel.gif width=16 height=16>";print "  No entra dentro del cálculo.";}echo "<br><br>";echo "<b> UM: </b>".$cantidad4." ".$unidad4;
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$valor41;}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$valor42;}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$valor43;}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$valor44;}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$valor45;}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$valor46;}?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs4->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php if($fecha_cal_inicio_sem1_inter_ant=='' || $p4=='')
		  print "-";
		  else echo number_format($p4, 2, ',', '');?></a></div></td>
                    <td align="right"  class="raya"><div align="right"><a onMouseOver="return overlib('<?php $rol3=$rs3->fields["rol"];$telef_rol3="";
					if($rol3=="edito") 
					{$telef_rol3=$rs3->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
					elseif($rol=="aut_p")
					{$telef_rol3=$rs3->fields["telef"]."<br>Rol: Autor Provincial";}
					elseif($rol3=="autor")
					{$telef_rol3=$rs3->fields["telef"]."<br>Rol: Autor Municipal";} 
					elseif($rol3=="admin")
					{$telef_rol3=$rs3->fields["telef"]."<br>Rol: Administrador";}

echo "<b>Captado por: </b>". $rs3->fields["nombre"]." ".$rs3->fields["apellidos"]."<br>E-mail: ".$rs3->fields["email"]."<br>Teléfono: ".$telef_rol3;print "<br>";if($id_inc3!=1)echo "<b>Incidencia: </b>".$inc3;else print "<b>Observación: </b>".$obs3;if($cont_imp3)print "<br><b>Precio imputado</b>";print "<br>";if($va_a_calculo3==1){print "<img src=../../imagenes/extrasmall/button_ok.gif width=16 height=16>";print "  Entra dentro del cálculo.";} else {print "<img src=../../imagenes/extrasmall/button_cancel.gif width=16 height=16>";print "  No entra dentro del cálculo.";} echo "<br><br>";echo "<b> UM: </b>".$cantidad3." ".$unidad3;
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$valor31;}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$valor32;}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$valor33;}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$valor34;}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$valor35;}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$valor36;}?>', ABOVE, RIGHT);" onMouseOut="return nd();" <?php if($p3>$p4 && $p3!=0){?>class="toolbar_rojo" <?php }if($p3<$p4 && $p3!=0){?>class="toolbar_verde" <?php }else{?>class="toolbar1"<?php }?> href="../autor/m_datos.php?var_aux_mod=<?php echo $rs3->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php if($p3=='')
		  print "-";
		  else echo number_format($p3, 2, ',', '');?></a></div></td>
                     
					 
                     <td align="right"  class="raya"><div align="right"><a onMouseOver="return overlib('<?php $rol2=$rs2->fields["rol"];$telef_rol2="";
					if($rol2=="edito") 
					{$telef_rol2=$rs2->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
					elseif($rol=="aut_p")
					{$telef_rol2=$rs2->fields["telef"]."<br>Rol: Autor Provincial";}
					elseif($rol2=="autor")
					{$telef_rol2=$rs2->fields["telef"]."<br>Rol: Autor Municipal";} 
					elseif($rol2=="admin")
					{$telef_rol2=$rs2->fields["telef"]."<br>Rol: Administrador";}

echo "<b>Captado por: </b>". $rs2->fields["nombre"]." ".$rs2->fields["apellidos"]."<br>E-mail: ".$rs2->fields["email"]."<br>Teléfono: ".$telef_rol2;print "<br>";if($id_inc2!=1)echo "<b>Incidencia: </b>".$inc2;else print "<b>Observación: </b>".$obs2;if($cont_imp2)print "<br><b>Precio imputado</b>";print "<br>";if($va_a_calculo2==1){print "<img src=../../imagenes/extrasmall/button_ok.gif width=16 height=16>";print "  Entra dentro del cálculo.";} else {print "<img src=../../imagenes/extrasmall/button_cancel.gif width=16 height=16>";print "  No entra dentro del cálculo.";}echo "<br><br><b>Variación mensual: </b>";if($p3!=0){$var2=$p2/$p3*100-100;print number_format($var2, 2, ',', '')." %";} else print "-";echo "<br><br>";echo "<b> UM: </b>".$cantidad2." ".$unidad2;
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$valor21;}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$valor22;}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$valor23;}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$valor24;}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$valor25;}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$valor26;}?>', ABOVE, RIGHT);" onMouseOut="return nd();" <?php if($p2>$p3 && $p2!=0){?>class="toolbar_rojo" <?php }if($p2<$p3 && $p2!=0){?>class="toolbar_verde" <?php }else{?>class="toolbar1"<?php }?> href="../autor/m_datos.php?var_aux_mod=<?php echo $rs2->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php if($p2=='')
		  print "-";
		  else echo number_format($p2, 2, ',', '');?></a></div></td>
                    <td align="right"  class="raya"><div align="right"><a onMouseOver="return overlib('<?php $rol1=$rs->fields["rol"];$telef_rol="";
					if($rol1=="edito") 
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
					elseif($rol=="aut_p")
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Provincial";}
					elseif($rol=="autor")
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Municipal";} 
					elseif($rol=="admin")
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Administrador";}

echo "<b>Captado por: </b>". $rs->fields["nombre"]." ".$rs->fields["apellidos"]."<br>E-mail: ".$rs->fields["email"]."<br>Teléfono: ".$telef_rol;print "<br>";if($id_inc!=1)echo "<b>Incidencia: </b>".$inc;else print "<b>Observación: </b>".$obs;if($cont_imp)print "<br><b>Precio imputado</b>";echo "<br><br><b>Fecha de digitación:</b> ".$fecha_dig;print"<br><b>Fecha de cierre de semana:</b> ".$fecha_cierre_sem."<br><b>Día a captar:</b> ";$d=substr($rs->fields["fecha_captar"],8,9);print $array2[$d-1];print "<br>";if($va_a_calculo==1){print "<img src=../../imagenes/extrasmall/button_ok.gif width=16 height=16>";print "  Entra dentro del cálculo.";} else {print "<img src=../../imagenes/extrasmall/button_cancel.gif width=16 height=16>";print "  No entra dentro del cálculo.";}echo "<br><br><b>Variación mensual: </b>";if($p2!=0){$var1=$p/$p2*100-100;print number_format($var1, 2, ',', '')." %";} else print "-";echo "<br><br>";echo "<b> UM: </b>".$cantidad1." ".$unidad1;
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$valor11;}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$valor12;}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$valor13;}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$valor14;}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$valor15;}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$valor16;}?>', ABOVE, RIGHT);" onMouseOut="return nd();" <?php if($p>$p2 && $p!=0){?>class="toolbar_rojo" <?php }if($p<$p2 && $p!=0){?>class="toolbar_verde" <?php }else{?>class="toolbar1"<?php }?>href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php if($p=='')
		  print "-";
		  else echo number_format($p, 2, ',', '');?></a></div></td>
          <td class="raya"align="center">&nbsp;</td>
                  </tr>
                  <?php 
					
    
 				if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_var_estab"];
		       	 }
				 elseif($rs->fields["id_var_estab"]!='')
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_var_estab"];
		         }
				//print $cadenacheckboxp;

	  	$rs->MoveNext();
	  	}
  	}
  	
} 		
  ?>
                </table>
                <br>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "n_var_estab";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_var_estab";?>">
                  
                  <input type="hidden" name="location2" value="<?php echo "../../../captaciones/listados/l_cap_serie.php?order=".$order."&type=".$ordtype."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
                </p>
              </div>
              </form>
      <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
