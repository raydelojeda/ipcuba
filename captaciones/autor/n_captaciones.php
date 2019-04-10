<?php 

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

//print $_POST['txt_ir'];
if($_POST['txt_ir'])
{//print "sds";
header("Location:n_captaciones.php?curr_page=".$_POST['txt_ir']."&order=".$order."&type=".$ordtype."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa."&sel_mes=".$sel_mes."&sel_ano=".$sel_ano."&porc=".$porc);
}

if (isset($_GET["order"])) $order = $_GET["order"]; else $order="n_var_estab.fecha_captar,estab, ecod_var, cod_var";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if (isset($_GET["otra"])) $otra = $_GET["otra"];

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];
if ($_GET["sel_estab"]!="") $sel_estab = $_GET['sel_estab'];
if (isset($_POST["sel_estab"])) $sel_estab = $_POST['sel_estab'];
if ($_GET["sel_mes"]!="") $sel_mes = $_GET['sel_mes'];
if (isset($_POST["sel_mes"])) $sel_mes = $_POST['sel_mes'];
if($sel_mes=="")$sel_mes =date("m");
if ($_GET["sel_ano"]!="") $sel_ano = $_GET['sel_ano'];
if (isset($_POST["sel_ano"])) $sel_ano = $_POST['sel_ano']; 
if ($_GET["central"]!="") $central = $_GET['central'];
if (isset($_POST["central"])) $central = $_POST['central']; 
if($sel_ano=="")$sel_ano =date("Y");


$sel_fecha=substr($sel_estab,0,10);
$sel_estab=substr($sel_estab,10,20);

//print $sel_estab."  ".$sel_fecha;

$array=array("Domingo de la 1ra semana","Lunes de la 1ra semana","Martes de la 1ra semana","Miércoles de la 1ra semana","Jueves de la 1ra semana","Viernes de la 1ra semana","Sábado de la 1ra semana","Domingo de la 2da semana","Lunes de la 2da semana","Martes de la 2da semana","Miércoles de la 2da semana","Jueves de la 2da semana","Viernes de la 2da semana","Sábado de la 2da semana","Domingo de la 3ra semana","Lunes de la 3ra semana","Martes de la 3ra semana","Miércoles de la 3ra semana","Jueves de la 3ra semana","Viernes de la 3ra semana","Sábado de la 3ra semana","Domingo de la 4ta semana","Lunes de la 4ta semana ","Martes de la 4ta semana","Miércoles de la 4ta semana","Jueves de la 4ta semana","Viernes de la 4ta semana","Sábado de la 4ta semana",);
$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-4","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);
//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_var_estab_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg();
$fecha_base = $rs_var_estab_fecha->Fields('max');
//---------------------------------------------------

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
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_pasada=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------


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
and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";//print $sql_cal;die();	
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());
$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$hoy=date("Y-m-d");
if($hoy<$fecha_cal_inicio_sem1_actual)
{
	//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
	$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";
	
	if($sel_mes==01){$sel_mes=12;$sel_ano=$sel_ano-1;}else $sel_mes=$sel_mes-1;
	
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
	and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";//print $sql_cal;die();	
	$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());
	$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];
	//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
}

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

//----------------------------------------------------------------------------
$sql_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol,id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$sql_usuario;	
//print 	$sql_usuario;
$rs_var_estab_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$id_usuario=$rs_var_estab_usuario->Fields("id_usuario");
$cod_dpa=$rs_var_estab_usuario->Fields("cod_dpa");
$prov_mun=$rs_var_estab_usuario->Fields("prov_mun");
$rol=$rs_var_estab_usuario->Fields("rol");
$cod_dpa2=substr($rs_var_estab_usuario->Fields("cod_dpa"),0,2)."%";
$mensaje="";
//----------------------------------------------------------------------------
$fecha_base_dia_actual=substr($fecha_base,0,8).date("d");

$hoy=date("Y-m-d");
//---------------------------------------------------	
if(date("m")!=$sel_mes)
{	$fecha_cierre_sem4_8=substr($fecha_base,0,8)."27";
	$sql_cal = "select fecha_cal from calendario where fecha_captar>='$fecha_cierre_sem4_8' and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3'";		
	$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;die();
	$fecha_cal = $rs_cal->Fields('fecha_cal');
	$v4=$fecha_cal;
}
//---------------------------------------------------


//---------------------------------------------------					 
$sql_cal = "select max(fecha_captar) from calendario where fecha_cal>='$fecha_01_ini3' and fecha_cal<='".$hoy."'";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_captar = $rs_cal->Fields('max');
//print $fecha_captar;
//---------------------------------------------------
 
//print $fecha_cal_inicio_sem1_pasada."  ".$fecha_cal_inicio_sem1_actual;


if($central=="")
$central=0;


$query = "SELECT fecha_captar,n_var_estab.id_var_estab, variedad, ecod_var,cod_var, n_variedad.id_variedad,id_estab_sustituido,fecha_sus, unidad,tipologia, 
cod_estab,dir,n_estab.cod_dpa,n_estab.id_estab, estab, prov_mun, mercado, n_mercado.id_mercado, cantidad, n_var_estab.valor1,n_var_estab.valor2,n_var_estab.valor3,n_var_estab.valor4,n_var_estab.valor5,n_var_estab.valor6,
n_variedad.carac1,n_variedad.carac2,n_variedad.carac3,n_variedad.carac4,n_variedad.carac5,n_variedad.carac6
FROM n_var_estab 
LEFT OUTER JOIN captacion ON fecha>='$fecha_cal_inicio_sem1_actual' and fecha<='$hoy' and fecha<'$fecha_cal_inicio_sem1_next' and n_var_estab.id_var_estab = captacion.id_var_estab and n_var_estab.desuso='0'
LEFT JOIN b_variedad ON b_variedad.idb_variedad=n_var_estab.idb_variedad and b_variedad.fecha='".$fecha_base."' and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_estab ON n_estab.id_estab=n_var_estab.id_estab and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_dpa ON n_dpa.cod_dpa=n_estab.cod_dpa and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_var_estab.desuso='0'
LEFT JOIN n_variedad ON n_variedad.id_variedad=b_variedad.id_variedad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_tipologia ON n_tipologia.id_tipologia=n_estab.id_tipologia and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN e_articulo ON e_articulo.ide_articulo=n_variedad.ide_articulo and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_unidad ON n_unidad.id_unidad=n_var_estab.id_unidad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_mercado ON b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
WHERE captacion.id_var_estab IS NULL and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'";



if($rol=='aut_p' && $sel_cod_dpa==0) 
$query=$query."and (central='0' or central='2') and n_estab.cod_dpa like '".$cod_dpa2."'";
if($rol=="autor")
$query=$query."and central='0' and n_estab.cod_dpa='".$cod_dpa."'";			
elseif($rol=='admin' || $rol=='super' || $rol=='edito'|| $rol=='aut_p')
{if($sel_cod_dpa!=0)
$query .= "and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}	


if($ver=="")
$ver=10;
//print $query;
if($sel_estab!=0 && $fecha_captar!=0 && $sel_fecha!=0)
{$query .= "and n_estab.cod_estab='".$sel_estab."' and n_var_estab.fecha_captar='".$sel_fecha."'"; 


//print $ver."dfgdfgr";
if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") 
{$query .= " and $sel_filtro ~* '$txt_filtro'";}
  
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype).$otra;




$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs_var_estab = $pager_nav->curr_rs;
$id_estab_sustituido=$rs_var_estab->fields["id_estab_sustituido"];
}
else 
{
$escoger_estab=0;
}



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
<!-- InstanceBeginEditable name="head" --> 
<style type="text/css">
<!--
.style2 {font-size: 16px}
-->
</style>
<style type="text/css">
<!--
.style3 {font-size: 14px}
-->
</style>
<style type="text/css">
<!--
.style4 {font-size: 14}
-->
</style>
<!-- InstanceEndEditable --> 

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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../imagenes/extrasmall/exit.gif">
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
                         <td width="4%" valign="middle"  class="us"><img src="../../imagenes/admin/news.png" width="48" height="48" border="0" /><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td width="71%" valign="middle"  class="us"><span class="style4"><strong><font color="#5A697E">Captación 
                          de precios disponibles faltantes <?php if($central!=1)echo "no ";?>centralizados <?php if($rol!="admin" && $rol!="super")echo "de ".$prov_mun;?>
                           en el mes de <?php echo $fecha_text;?></font></strong></span>
                          </td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" > 
                            <input type="image"  onClick="suma_control();" name="btn_save" id="btn_save"   src="../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0"/>
                            <br />
                            <label>Guardar</label>
                            </a> </div></td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" href="<?php if($_GET['locat']!="")
{
print $_GET['locat'];
}else print "l_datos_m.php";?>">  
                            <img src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" name="imageField2" width="32" height="32" border="0" id="imageField2" /> 
                            <br />
                          Cancelar</a> </div></td>
                        <td width="7%"> 
                          <div align="center"><a class="toolbar" href="#" onClick="window.open('help/n_captaciones.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" id="help" /><br />
                          Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="747" height="60"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<tr align="center" valign="middle"> 
                    <td height="50" colspan="21"  >
                      <table width="743" height="82" border="0" cellpadding="0" cellspacing="0" class="filtro" >
<tr>
  <td height="18" colspan="4"  align="right" valign="middle"  > <?php if($rol=='admin' || $rol=='super' || $rol=='edito'|| $rol=='aut_p'){?> 
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
						if($rol=='aut_p') 
 						{$tabla=$tabla."  and cod_dpa like '".$cod_dpa2."'";}
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                          </select></td>
                       </tr>
					   </table>
					   <?php }?></td>
  </tr>
<tr>
  <td width="183" height="18"  align="right" valign="middle"  >Filtro:
                          <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15"></td>
                          <td width="165" align="center" valign="middle" ><a href="#">
<select  onChange="document.frm.submit();" class="combo" name="sel_filtro">
                                <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                                                             
                              <option value="<?php echo "ecod_var" ?>"<?php if ($sel_filtro == "ecod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Variedad") ?></option>
                              
                        <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                                <option value="<?php echo "fecha_captar" ?>"<?php if ($sel_filtro == "fecha_captar") { echo "selected"; } ?>><?php echo htmlspecialchars("Fecha a Captar") ?></option>
                            </select>
                            </a></td>
                          <td width="94"  align="right"><a  href="#" onClick="javascript: document.frm.submit();">Ir: </a>
                          <input  name="txt_ir" type="text" class="combo" value="" size="3" ></td>
                        <td width="307"  align="right"><a href="#">
                          <?php 
						  if($sel_estab!=0)
						  { 					
  							$pager_nav->Render_Navegator();		
							?>
                        </a>
                          <?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];
							}		
							?>                          &nbsp;Ver #
<select name="sel_#" class="inputbox"  onChange="document.frm.submit();">
                          <option value="5" <?php if($ver==5){?>selected="selected" <?php } ?>>5</option>
                          <option value="10" <?php if($ver==10){?>selected="selected" <?php } ?>>10</option>
                          <option value="15" <?php if($ver==15){?>selected="selected" <?php } ?>>15</option>
                          <option value="20" <?php if($ver==20){?>selected="selected" <?php } ?>>20</option>
                          <option value="25" <?php if($ver==25){?>selected="selected" <?php } ?>>25</option>
                          <option value="30" <?php if($ver==30){?>selected="selected" <?php } ?>>30</option>
                          <option value="50" <?php if($ver==50){?>selected="selected" <?php } ?>>50</option>
                          <option value="150" <?php if($ver==150){?>selected="selected" <?php } ?>>150</option>
                          <option value="300" <?php if($ver==300){?>selected="selected" <?php } ?>>300</option>
                          <option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
                        </select></td>
</tr>
<tr>
  <td height="23" colspan="2"  align="right" valign="middle"  ><div align="left">&nbsp;<?php if($fecha_captar){?>Autorizado a captar:
    <b><?php $today=substr($fecha_captar,8,9);echo $array[$today-1]." (".$array2[$today-1].")";?></b><?php }?></div></td>
  <td  align="center">&nbsp;</td>
  <td  align="right">&nbsp;</td>
</tr>





<tr>
  <td height="23" colspan="4"  align="right" valign="middle">
    <div align="left">
      <table width="740" height="26" border="0" cellpadding="0" cellspacing="0" class="filtro" >
        <tr>
          <td width="105" height="20"><div align="right">Establecimiento:&nbsp;</div></td>
          <td><select name="sel_estab" title="Establecimientos" id="sel_estab" onChange="document.frm.submit();" >
            <option value="0">------------------</option>
            <?php 
				if($sel_estab!=0 || $fecha_captar!=0)
				{
						$tabla="n_dpa,n_estab,n_var_estab 
						where n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa=n_dpa.cod_dpa and incluido='". 1 ."' ";
						$campo0=estab;
						$campo1=" n_var_estab.fecha_captar,estab";
						//$campo_id="cod_estab";
						$id=$_POST['sel_estab'];
						if($campo1!='')
						$query_sel = "SELECT distinct n_estab.cod_estab,n_var_estab.fecha_captar,estab
FROM n_var_estab 
LEFT OUTER JOIN captacion ON fecha>='$fecha_cal_inicio_sem1_actual' and fecha<='$hoy' and fecha<'$fecha_cal_inicio_sem1_next' and n_var_estab.id_var_estab = captacion.id_var_estab and n_var_estab.desuso='0'
LEFT JOIN b_variedad ON b_variedad.idb_variedad=n_var_estab.idb_variedad and b_variedad.fecha='".$fecha_base."' and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_estab ON n_estab.id_estab=n_var_estab.id_estab and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_dpa ON n_dpa.cod_dpa=n_estab.cod_dpa and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_var_estab.desuso='0'
LEFT JOIN n_variedad ON n_variedad.id_variedad=b_variedad.id_variedad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_tipologia ON n_tipologia.id_tipologia=n_estab.id_tipologia and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN e_articulo ON e_articulo.ide_articulo=n_variedad.ide_articulo and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_unidad ON n_unidad.id_unidad=n_var_estab.id_unidad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_mercado ON b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
WHERE captacion.id_var_estab IS NULL and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'";



if($rol=='aut_p' && $sel_cod_dpa==0) 
$query_sel=$query_sel."and (central='0' or central='2') and n_estab.cod_dpa like '".$cod_dpa2."'";
if($rol=="autor")
$query_sel=$query_sel."and central='0' and n_estab.cod_dpa='".$cod_dpa."'";			
elseif($rol=='admin' || $rol=='super' || $rol=='edito'|| $rol=='aut_p')
{if($sel_cod_dpa!=0)
$query_sel .= "and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
} 

$query_sel .= "order by $campo1";
						//print $query_sel;
						$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs_selected->RecordCount();
						
						
							for ($i = 0; $i < $cant_rs;$i++)
							{	$fecha_captar=$rs_selected->Fields("fecha_captar");
								$dia=substr($fecha_captar,8,2);
								$rs_fields0=$rs_selected->Fields($campo0);
								$rs_fields1=$rs_selected->Fields('cod_estab');
								$rs_fields_id=$rs_selected->Fields('fecha_captar').$rs_selected->Fields('cod_estab');										 
								echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $array2[$dia-1]."&nbsp;&nbsp;&nbsp;". $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
								$rs_selected->MoveNext();
							}
				
				
				}
						?>
          </select></td>
          </tr>
      </table><?php //print $query_sel; ?>
    </div></td>
  </tr>
                    </table>                    </td>
                  </tr>
                  
                  
<script language="javascript"  type="text/javascript">
function suma_control()
{
text='Deber entrar la suma de control para el establecimiento <?php print "(".$rs_var_estab->fields["cod_estab"].". ".$rs_var_estab->fields["estab"].")";?>';




 sel = ""; 
arr_a = String(document.frm.cadena.value).split(","); 
var suma_precio=0;

for (i=0;i<arr_a.length;i++){

 //alert("srg");alert("document.frm.txt_precio_"+arr_a[i]+".value");
  precio = parseFloat(eval("document.frm.txt_precio_"+arr_a[i]+".value"));
  //alert(precio);	
	//suma_precio=parseFloat(suma_precio);
	if((isNaN(precio))==false)
  	suma_precio+=precio;// 
	
	//suma_precio1=Math.round(suma_precio,5);alert(suma_precio1);
	suma_precio_ok=suma_precio.toFixed(2);//alert(suma_precio_ok);
	
   }
  
document.frm.suma.value="no";
	if((isNaN(suma_precio))==false)
	{
	var suma_control=window.prompt(text,"");//alert(suma_control);		
	lenght=suma_control.length;
			//aux=suma_control.substring(0,3);	  
			
			
			for(j=0; j<lenght; j++)
			{				
				aux=suma_control.substring(j,j+1);
				if((aux)=='.')
				{//alert(j);
				var punto=true;
				if(j==0)
					{
					suma_control='0'+suma_control;						
					lenght=suma_control.length;
					}
				if(j==lenght-1)
					{
					suma_control=suma_control+'00';						
					lenght=suma_control.length;
					}
				if(j==lenght-2)
					{
					suma_control=suma_control+'0';						
					lenght=suma_control.length;
					}
					
				}
				
				
				
				if(punto!=true && j==lenght-1 && !isNaN(suma_control))	
					{suma_control=suma_control+'.00';
					
					lenght=suma_control.length;}
			}
			
			
			
			if(isNaN(suma_control)){alert('El campo precio debe contener solo números.');
			suma_control='';letras=true;}
			//alert(p);
			else if(suma_control=='')
			{suma_control='';letras=true;
			alert('Debe escribir correctamente la suma control.');}
			  
				
			//alert(suma_control);alert(suma_precio_ok);
			// suma_control_ok=suma_control.toFixed(2);
			if (suma_precio_ok==suma_control)
			{
				document.frm.suma.value="si";
				document.frm.submit();
			}
			else
			{alert("La suma de control no es igual a la suma de todos los precios. No puede ingresar los datos hasta que los verifique nuevamente.");
			document.frm.suma.value="no";
			}
			
	}
}
</script>
                  
                  
                  
                  
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="19" height="19" align="center">No</td>
                    <td width="54" class="intro" ><a href="n_captaciones.php?order=<?php echo "mercado" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Mercado</a></td>
                    <td width="193" class="intro" ><a href="n_captaciones.php?order=<?php echo "cod_estab" ?>&type=<?php echo $ordtypestr ?>&otra=<?php echo " ,variedad,fecha_captar" ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Establecimiento</a></td>
                    <td width="214" class="intro" ><a href="n_captaciones.php?order=<?php echo "variedad" ?>&type=<?php echo $ordtypestr ?>&otra=<?php echo " ,cod_estab,fecha_captar" ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Variedad</a></td>
                    <td width="77" class="intro" ><a href="n_captaciones.php?order=<?php echo "fecha_captar" ?>&type=<?php echo $ordtypestr ?>&otra=<?php echo " ,variedad,cod_estab" ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">D&iacute;a a captar</a></td>
                   <?php $query_inc = "select inc from n_inc order by id_inc";//aquí obligamos a que sea una incidencia con id=1 por defecto
$rs_inc=$db->Execute($query_inc) or $mensaje=$db->ErrorMsg() ;
$cant_rs_inc=$rs_inc->RecordCount();

$query_obs = "select obs from n_obs order by id_obs";//aquí obligamos a que sea una obsidencia con id=1 por defecto
$rs_obs=$db->Execute($query_obs) or $mensaje=$db->ErrorMsg() ;
$cant_rs_obs=$rs_obs->RecordCount();?>
                    <td width="68" class="intro" ><a onMouseOver="return overlib('<?php echo "<b>Incidencias de establecimientos:</b><br>";for($l=1;$l<=$cant_rs_inc;$l++){print $rs_inc->fields["inc"]."<br>";$rs_inc->MoveNext();}?>', BELOW, LEFT);" onMouseOut="return nd();">Incidencia</a></td>
                    <td width="49" class="intro" >Precio</td>
                    <td width="71" class="intro" ><a onMouseOver="return overlib('<?php echo "<b>Observaciones sobre el precio:</b><br>";for($o=1;$o<=$cant_rs_obs;$o++){print $rs_obs->fields["obs"]."<br>";$rs_obs->MoveNext();}?>', ABOVE, RIGHT);" onMouseOut="return nd();">Observación</a></td>
                  </tr>
                  <?php

	if($fecha_captar!=0 && $sel_estab!=0)	
	{		
			if(isset($_POST['location']))			
			{				
				$rs_var_estab->MoveFirst();
				while (!$rs_var_estab->EOF)
				{	
				$magic_quotes = get_magic_quotes_gpc();
				
				$valor1=str_replace("'","&#039;",$rs_var_estab->fields["valor1"]);
				$valor2=str_replace("'","&#039;",$rs_var_estab->fields["valor2"]);
				$valor3=str_replace("'","&#039;",$rs_var_estab->fields["valor3"]);
				$valor4=str_replace("'","&#039;",$rs_var_estab->fields["valor4"]);
				$valor5=str_replace("'","&#039;",$rs_var_estab->fields["valor5"]);
				$valor6=str_replace("'","&#039;",$rs_var_estab->fields["valor6"]);
				$cantidad=$rs_var_estab->fields["cantidad"];	
				$unidad=$rs_var_estab->fields["unidad"];
							
				$id_var_estab_fecha=$rs_var_estab->fields["id_estab"].$rs_var_estab->fields["id_var_estab"];
				
				$txt_precio = $_POST['txt_precio_'.$id_var_estab_fecha];
				$sel_obs= $db->qstr($_POST['sel_obs_'.$id_var_estab_fecha], $magic_quotes);
				$sel_inc= $db->qstr($_POST['sel_inc_'.$id_var_estab_fecha], $magic_quotes);
				$id_var_estab=$rs_var_estab->fields["id_var_estab"];	
				$id_estab=$rs_var_estab->fields["id_estab"];
				$fecha_captar=$rs_var_estab->fields["fecha_captar"];
				if(date("m")!=$sel_mes)
				{$fecha_dig=$v4;$hoy=$v4;}else $fecha_dig=$hoy;
				//print $txt_precio;	
				
				//print "---".$_POST['sel_inc_'.$id_var_estab_fecha]."---";
				if($_POST['sel_inc_'.$id_var_estab_fecha]!="1" and $_POST['sel_inc_'.$id_var_estab_fecha]!="")//hay que preguntar por el vacío ya que solo muestra las faltantes pero el select las recoge todas por lo que las que ya se captaron no tendrán incidencia
				{ 
					$sql_estab="select * from n_var_estab where id_estab='".$id_estab."' and fecha_captar='".$fecha_captar."' and n_var_estab.desuso='0'";//print $sql_estab;
					$rs_estab=$db->Execute($sql_estab) or $mensaje=$db->ErrorMsg();
					$cant_estab=$rs_estab->RecordCount();
					for($m=0;$m<$cant_estab;$m++)
					{//print $m;
						$id_var_estab=$rs_estab->fields["id_var_estab"];
						
						$sql_cap="select id_var_estab from captacion where id_var_estab='$id_var_estab' and fecha>'$fecha_cal_inicio_sem1_actual' and fecha<='$hoy'";
						$rs_cap=$db->Execute($sql_cap) or die($db->ErrorMsg());//print $sql_cap;
						$id=$rs_cap->fields["id_var_estab"];						
						if($id=="")
						{
							$sql_inc="INSERT INTO captacion 
							(id_usuario,id_var_estab,valor1,valor2,valor3,valor4,valor5,valor6,
							cant,cap_uni,id_obs,id_inc,fecha,precio,va_a_calculo) 
							VALUES 
							($id_usuario,$id_var_estab,'$valor1','$valor2','$valor3','$valor4','$valor5','$valor6',
							'$cantidad','$unidad','1',$sel_inc,'$fecha_dig','0','0')";//print $sql_inc."<br>";
							$rs_inc=$db->Execute($sql_inc) or $mensaje=$db->ErrorMsg();
							
							if($rs_inc)
							{
							$gestor = @fopen($camino, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $sql_inc.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							}
							
						}	
						else
						{
							$sql_u = "UPDATE captacion SET  valor1='$valor1', valor2='$valor2', valor3='$valor3', valor4='$valor4', valor5='$valor5', valor6='$valor6', cant='$cantidad', cap_uni='$unidad', id_usuario ='".$id_usuario."',id_obs = '1',id_inc = ".$sel_inc.",fecha = '".$fecha_dig."',va_a_calculo='0', precio = '0' WHERE id_var_estab = '".$id."' and fecha>'$fecha_cal_inicio_sem1_actual' and fecha<='$hoy'";
							//print $sql."<br>";
							$rs_u = $db->Execute($sql_u) or $mensaje=$db->ErrorMsg() ;
							
							if($rs_u)
							{
							$gestor = @fopen($camino, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $sql_u.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							}
							
							
						}
						$rs_estab->MoveNext();	
					}
							
				}				
				if($_POST['txt_precio_'.$id_var_estab_fecha]!="" && ($_POST['sel_obs_'.$id_var_estab_fecha]=="6" || $_POST['sel_obs_'.$id_var_estab_fecha]=="4" || $_POST['sel_obs_'.$id_var_estab_fecha]=="8" || $_POST['sel_obs_'.$id_var_estab_fecha]=="9") && $_POST['sel_inc_'.$id_var_estab_fecha]=="1")
					{			
						$sql_cap="select id_var_estab from captacion where id_var_estab='$id_var_estab' and fecha>'$fecha_cal_inicio_sem1_actual' and fecha<='$hoy'";
						$rs_cap=$db->Execute($sql_cap) or die($db->ErrorMsg());//print $sql_cap;
						if($rs_cap->fields["id_var_estab"]=="")
						{
							
							$sql_cap_ant="select precio from captacion where id_var_estab='$id_var_estab' 
							and fecha>='$fecha_cal_inicio_sem1_pasada' and fecha<'$fecha_cal_inicio_sem1_actual'";
							$rs_cap_ant=$db->Execute($sql_cap_ant) or die($db->ErrorMsg());
							//print $sql_cap_ant;
							$precio_ant=$rs_cap_ant->fields["precio"];
							if($precio_ant!=0)
							$rel=$txt_precio/$precio_ant;//print $rel." = ".$txt_precio." / ".$precio_ant;
							
							$va_a_calculo=0;
							
							if($rel>0.5 && $rel<1.5)
							$va_a_calculo=1;
							if($precio_ant==0)
							$va_a_calculo=1;
							
							
							$consulta="INSERT INTO captacion (id_usuario,id_var_estab,valor1,valor2,valor3,valor4,valor5,valor6,cant,cap_uni,id_obs,id_inc,fecha,precio,va_a_calculo) 
							VALUES ($id_usuario,$id_var_estab,'$valor1','$valor2','$valor3','$valor4','$valor5','$valor6','$cantidad','$unidad',$sel_obs,1,'".$fecha_dig."','$txt_precio','$va_a_calculo')";
							//print $consulta;
							if($_POST['suma']!="no")//print $_POST['suma'];
							$rs2=$db->Execute($consulta) or $mensaje=$db->ErrorMsg();
							
							
							if($rs2)
							{
							$gestor = @fopen($camino, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $consulta.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							}
						}
					}
					
				if($_POST['txt_precio_'.$id_var_estab_fecha]=="" && ($_POST['sel_obs_'.$id_var_estab_fecha]=="2" || $_POST['sel_obs_'.$id_var_estab_fecha]=="3" || $_POST['sel_obs_'.$id_var_estab_fecha]=="5" || $_POST['sel_obs_'.$id_var_estab_fecha]=="1") && $_POST['sel_inc_'.$id_var_estab_fecha]=="1")
					{	
						$sql_cap="select id_var_estab from captacion where id_var_estab='$id_var_estab' and fecha>'$fecha_cal_inicio_sem1_actual' and fecha<='$hoy'";
						$rs_cap=$db->Execute($sql_cap) or die($db->ErrorMsg());//print $sql_cap;
						if($rs_cap->fields["id_var_estab"]=="")
						{
							$consulta="INSERT INTO captacion 
							(id_usuario,id_var_estab,valor1,valor2,valor3,valor4,valor5,valor6,
							cant,cap_uni,id_obs,id_inc,fecha,precio,va_a_calculo) 
							VALUES 
							($id_usuario,$id_var_estab,'$valor1','$valor2','$valor3','$valor4','$valor5','$valor6',
							'$cantidad','$unidad',$sel_obs,1,'".$fecha_dig."',0,0)";//print $consulta;
							if($_POST['suma']!="no")
							$rs2=$db->Execute($consulta) or $mensaje=$db->ErrorMsg();							
							
							if($rs2)
							{
							$gestor = @fopen($camino, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $consulta.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							}
						}
					}
					
				$rs_var_estab->MoveNext();						
				}
			$pager_nav = new CData_PagerNav($db, $query, $_POST['sel_#'],"frm",$order,$ordtype);
			$rs_var_estab = $pager_nav->curr_rs;
			$rs_var_estab->MoveFirst();
			}
				  
	}

	  
if($rs_var_estab->fields["id_var_estab"]!='')
{	
  
  	if ($rs_var_estab->RecordCount() > 0)
  	{
	$cadena = "";
	 	$rs_var_estab->MoveFirst();
	
	  	while (!$rs_var_estab->EOF)
	  	{//print $c;
	$id_var_estab_fecha=$rs_var_estab->fields["id_estab"].$rs_var_estab->fields["id_var_estab"];
	$id_var_estab=$rs_var_estab->fields["id_var_estab"];
	$fecha=substr($fecha_ant,0,8).substr($rs_var_estab->fields["fecha_captar"],8,2);
   // print $rs_var_estab->fields["id_estab"];		
	$fecha2=substr($fecha_captar,8,9);
	//print $fecha;
	
	
	
	
?>     
  				<tr  height="20" <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                    <td height="22"   align="center" class="raya">
                      <?php echo $a; ?>                     </td>
                      
                    <td  class="raya" align="center"><a onMouseOver="return overlib('<?php echo $rs_var_estab->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php echo substr($rs_var_estab->fields["mercado"],0,1);?></a></td>
                    
                     <td  class="raya" align="center"><a onMouseOver="return overlib('<?php echo "Código establecimiento: ".$rs_var_estab->fields["cod_estab"]."<br>Código DPA: ".$rs_var_estab->fields["cod_dpa"]." - ".$rs_var_estab->fields["prov_mun"]."<br>Direción: ".$rs_var_estab->fields["dir"]."<br>Tipología: ".$rs_var_estab->fields["tipologia"];
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
					?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php echo $rs_var_estab->fields["estab"];?></a></td>
                    
                    <td  class="raya" align="center"><a target="_blank"
                      <?php if($rol=="admin" || $rol=="edito") {
                      $href="../../administracion/base/var_estab/m_var_estab.php?cerrar=1&var_aux_mod=".$rs_var_estab->fields["id_var_estab"]; } 
					  else { 
                      $href="../../administracion/base/var_estab/m_var_estab_m.php?cerrar=1&var_aux_mod=".$rs_var_estab->fields["id_var_estab"]; }?>
                      href="<?php print $href;?>"
                      onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>";if($rs_var_estab->fields["ecod_var"]){ print $rs_var_estab->fields["ecod_var"];} else print $rs_var_estab->fields["cod_var"];
					  echo "<br><b> UM: </b>".$rs_var_estab->fields["cantidad"]." ".$rs_var_estab->fields["unidad"];
					  if($rs_var_estab->fields["carac1"]) {echo "<br><b> ".$rs_var_estab->fields["carac1"].": </b>".$rs_var_estab->fields["valor1"];}
					  if($rs_var_estab->fields["carac2"]) {echo "<br><b> ".$rs_var_estab->fields["carac2"].": </b>".$rs_var_estab->fields["valor2"];}
					  if($rs_var_estab->fields["carac3"]) {echo "<br><b> ".$rs_var_estab->fields["carac3"].": </b>".$rs_var_estab->fields["valor3"];}
					  if($rs_var_estab->fields["carac4"]) {echo "<br><b> ".$rs_var_estab->fields["carac4"].": </b>".$rs_var_estab->fields["valor4"];}
					  if($rs_var_estab->fields["carac5"]) {echo "<br><b> ".$rs_var_estab->fields["carac5"].": </b>".$rs_var_estab->fields["valor5"];}
					  if($rs_var_estab->fields["carac6"]) {echo "<br><b> ".$rs_var_estab->fields["carac6"].": </b>".$rs_var_estab->fields["valor6"];}
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();"class="toolbar1"><?php echo $rs_var_estab->fields["variedad"];?></a></td>
                    <td  class="raya" align="center"><a onMouseOver="return overlib('<?php echo $array[$fecha2-1];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php echo $array2[$fecha2-1];?></a></td>
                    <td  class="raya" align="center">
                     <?php //echo $id_var_estab_fecha;?>
                    <select name="sel_inc_<?php echo $id_var_estab_fecha;?>" id="sel_inc_<?php echo $id_var_estab_fecha;?>" onChange="inc=document.frm.sel_inc_<?php echo $id_var_estab_fecha;?>.value;
                    if(inc==2)
                    aux='un Cierre temporal';
                    if(inc==3)
                    aux='un Cierre definitivo';
                    if(inc==4)
                    aux='un No visitado';
                    if(inc==5)
                    aux='una Negativa';
                    text='Ha marcado '+aux+' en el establecimiento <?php print "(".$rs_var_estab->fields["cod_estab"].". ".$rs_var_estab->fields["estab"].")";?> ¿Confirma que desea hacer esto?';
                    if(confirm(text))document.frm.submit();
                    else
                    document.frm.sel_inc_<?php echo $id_var_estab_fecha;?>.value=1;">
                   		
                        <option value="1" title="Establecimiento visitado">E0</option>
                        <option value="2" title="Cierre temporal del establecimiento">E1</option>
                        <option value="3" title="Cierre definitivo del establecimiento">E2</option>
                        <option value="4" title="Establecimiento no Visitado">E3</option>
                        <option value="5" title="Negativa">E4</option>
                      <?php /*
					  if(confirm(text))document.frm.submit();else document.frm.sel_inc_<?php echo $id_var_estab_fecha;?>.value=1;
                        $query = "select * from n_inc order by id_inc";//aquí obligamos a que sea una incidencia con id=1 por defecto                             //Ext.MessageBox.confirm('Confirmación', text, confirmar);
						$rs=$db->Execute($query) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs->RecordCount();
							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs->Fields("inc");
								$rs_fields2=substr($rs_fields0,0,2);
								$rs_fields0=$rs->Fields("inc");
								$rs_fields3=substr($rs_fields0,3,50);
								//print $rs_fields3;
								$rs_fields1="";
								$rs_fields_id=$rs->Fields("id_inc");										 
								echo"<option title=\"";echo $rs_fields3; echo"\" value=";echo $rs_fields_id;echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields2; echo "</option>";
								$rs->MoveNext();
							}
						*/?>
                    </select></td>
                    <td class="raya"align="center">
                     
                      <input tabindex="<?php echo $a; ?>" <?php if($rs_var_estab->fields["cantidad"]=='' || $rs_var_estab->fields["unidad"]==''){?> disabled  value="U/M"<?php } else {?>value="<?php echo $_POST['txt_precio_'.$id_var_estab_fecha];?>" <?php }?> name="txt_precio_<?php echo $id_var_estab_fecha;?>" title="txt_precio_<?php echo $id_var_estab_fecha;?>"  type="text"  id="txt_precio_<?php echo $id_var_estab_fecha;?>"onchange="javascript:Validar_Varios_Precios('warning<?php echo $id_var_estab_fecha;?>');"  size="6" /></td>
                    
                    <td class="raya"align="center"><select name="sel_obs_<?php echo $id_var_estab_fecha;?>" onChange="javascript:Validar_Varios_Precios('warning<?php echo $id_var_estab_fecha;?>');" id="sel_obs_<?php echo $id_var_estab_fecha;?>">
<option value="6" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==6) print "selected";?> title="Precio normal">PN</option> 
<option value="9" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==9) print "selected";?> title="Comparable">C</option>
<option value="8" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==8) print "selected";?> title="Rebaja">R</option>
<option value="4" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==4) print "selected";?> title="En oferta">O</option>
<option value="5" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==5) print "selected";?> title="Falta ocasional">FO</option>
<option value="2" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==2) print "selected";?> title="Falta estacional">FE</option>
<option value="3" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==3) print "selected";?> title="Falta definitiva">FD</option>     
<option value="1" <?php if($_POST['sel_obs_'.$id_var_estab_fecha]==1) print "selected";?> title="No disponible en formulario">ND</option>
                      
                      <?php /*
						$query = "select * from n_obs order by id_obs";
						$rs=$db->Execute($query) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs->RecordCount();
							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs->Fields("obs");
								$rs_fields2=substr($rs_fields0,0,2);
								$rs_fields0=$rs->Fields("obs");
								$rs_fields3=substr($rs_fields0,3,50);
								print $rs_fields3;
								$rs_fields1="";
								$rs_fields_id=$rs->Fields("id_obs");										 
								echo"<option title=\"";echo $rs_fields3; echo"\" value=";echo $rs_fields_id; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields2; echo "</option>";
								$rs->MoveNext();
							}
						*/?></select>                    </td>
                  </tr>
                  
                  <?php 
					
    	  	if($cadena == "")
			 {
				$cadena = $id_var_estab_fecha;
			 }
			 elseif($id_var_estab_fecha!='')
			 {
				$cadena .= ",".$id_var_estab_fecha;
			 }
			
			
			//print $cadena."<br>";
			
			
			
	  	$rs_var_estab->MoveNext();
	  	}
  	}
  	
} 		

else
{
?>
<tr align="center" valign="center"  > 
<td class="raya" colspan="8"  height="20"><?php if($escoger_estab==0 && $fecha_captar!='') {print "Debe escoger un establecimiento";}else
{print "No hay captaciones a realizar hasta la fecha para este municipio.";}?></td></tr>
<?php
}
?>
                </table>
                
    <input type="hidden" name="suma" value="">            
    <input type="hidden" name="cadena" value="<?php echo $cadena;?>">         
    <input type="hidden" name="no" value="<?php echo $a;?>">           
    <input type="hidden" name="location" value="<?php echo "l_datos_m.php";?>">
                 
                <br>
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
