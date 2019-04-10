<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");

$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$rol=$rs_usuario->Fields("rol");

if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------


if($_POST["sel_mes"]!=0 and $_POST["sel_ano"]!=0)
{

    $sem=$_POST["sel_sem"];
	$ano_mes=substr($fecha_base,0,7);	
	if($sem=="01")
	{$dia_base_ini="04";$dia_base_fin="07";$miercoles_dia_cierre="11";}
	if($sem=="02")
	{$dia_base_ini="08";$dia_base_fin="14";$miercoles_dia_cierre="18";}
	if($sem=="03")
	{$dia_base_ini="15";$dia_base_fin="21";$miercoles_dia_cierre="25";}
	if($sem=="04")
	{$dia_base_ini="22";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	if($sem=="0")
	{$dia_base_ini="04";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	
						
	$fecha_base_fin=$ano_mes."-".$dia_base_fin;
	$fecha_base_ini=$ano_mes."-".$dia_base_ini;
	//$miercoles_cierre=$ano_mes."-".$miercoles_dia_cierre;
//print $fecha_base_ini."  ".$fecha_base_fin;

//------------------INICIO DE SEMANA---------------------------------	
$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];

if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual
			 
$sql_cal = "select * from calendario where fecha_captar='".$fecha_base_ini."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
//------------------INICIO DE SEMANA---------------------------------	





//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 O DEL MES--------------------------------
$fecha_cierre_sem4=substr($fecha_base,0,8)."04";

$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];
if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

if(strlen($mes_next)==1)
$mes_next=0 .$mes_next;

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4."' 
and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_cal_inicio_sem1=$rs_cal->fields["fecha_cal"];//print $fecha_cal_inicio_sem1;
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 O DEL MES--------------------------------


//--------------------------------PARA OBETENER LA FECHA DEL CIERRE DE SEMANA 4 O DEL MES--------------------------------
$fecha_cierre_sem4=substr($fecha_base,0,8)."04";	

$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];

if($mes=="11")
{$mes_next1=$mes+1;$mes_next2="01";$ano_next=$ano+1;}
elseif($mes=="12")
{$mes_next1="01";$mes_next2="02";$ano_next=$ano+1;$ano=$ano+1;}
else
{$mes_next2=$mes+2;$ano_next=$ano;$mes_next1=$mes+1;}

//print $fecha_cal_inicio_sem1."   ".$fecha_act;
if($fecha_cal_inicio_sem1_aux>$fecha_act)
{
if($mes=="12")
{$mes_next1="12";$mes_next2="01";$ano_next=$ano+1;}
else
{$mes_next2=$mes+1;$ano_next=$ano;$mes_next1=$mes;}
}



if(strlen($mes_next1)==1)
$mes_next1=0 .$mes_next1;

if(strlen($mes_next2)==1)
$mes_next2=0 .$mes_next2;

$fecha_01_ini=$ano."-".$mes_next1."-"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."-".$mes_next2."-"."01";//esta fecha es para quedarme dentro del mes actual
//print $fecha_01_ini."  ".$fecha_01_next."<br>";	
$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_cal_cierre_sem4=$rs_cal->fields["fecha_cal"];//print $fecha_cal_cierre_sem4;
//--------------------------------PARA OBETENER LA FECHA DEL CIERRE DE SEMANA 4 O DEL MES--------------------------------


//--------------------------------------------------------------------------------------------------------------

  $sem=$_POST["sel_sem"];
	$ano_mes=substr($fecha_base,0,7);	
	if($sem=="01")
	{$dia_base_ini="04";$dia_base_fin="07";$miercoles_dia_cierre="11";}
	if($sem=="02")
	{$dia_base_ini="08";$dia_base_fin="14";$miercoles_dia_cierre="18";}
	if($sem=="03")
	{$dia_base_ini="15";$dia_base_fin="21";$miercoles_dia_cierre="25";}
	if($sem=="04")
	{$dia_base_ini="22";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	if($sem=="0")
	{$dia_base_ini="04";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	
						
	$fecha_base_fin=$ano_mes."-".$dia_base_fin;
	$fecha_base_ini=$ano_mes."-".$dia_base_ini;
	//$miercoles_cierre=$ano_mes."-".$miercoles_dia_cierre;
//print $fecha_base_ini."  ".$fecha_base_fin;

//---------------------------------------------------	
$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];

if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual
			 
$sql_cal = "select * from calendario where fecha_captar='".$fecha_base_ini."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$rs_cal->MoveFirst();
$fecha_cal_ini=$rs_cal->fields["fecha_cal"];
//---------------------------------------------------

///-----------------------------------------------------
$rs_cal->MoveFirst();
$dia_captar=substr($rs_cal->fields["fecha_captar"],8,9);
$dia_cal=substr($rs_cal->fields["fecha_cal"],8,9);

if(($dia_captar-$dia_cal)>0)
{$dif=$dia_captar-$dia_cal;  $dia_cal_cierre=$miercoles_dia_cierre-$dif;}
else
{$dif=$dia_cal-$dia_captar;   $dia_cal_cierre=$miercoles_dia_cierre+$dif;}
//print  $dia_cal_cierre."   ".$miercoles_dia_cierre."   ".$dif."<br>";
$fecha_cierre_sem=substr($rs_cal->fields["fecha_cal"],0,8).$dia_cal_cierre;

if($sem=="04" || $sem=="0")
$fecha_cierre_sem=$fecha_cal_cierre_sem4;
///-----------------------------------------------------

$query = "select distinct n_dpa.cod_dpa, prov_mun,cod_dpa_nueva,prov_mun_nuevo, count(id_var_estab) from n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa and n_var_estab.id_estab=n_estab.id_estab 
and incluido='1' and central='0' and n_variedad.ide_articulo!='1' and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
";

$query.= "and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' "; 
$query.= " group by n_dpa.cod_dpa, prov_mun, cod_dpa_nueva,prov_mun_nuevo order by n_dpa.cod_dpa";
//and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;//print $rs;
//print $rs;
$prov_mun=$rs->fields["prov_mun"];//print $_POST["sel_mes"];
}
?>

<html>
<head>
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
<link href="../../../css/theme.css" rel="stylesheet" type="text/css">
<link href="../../../css/estilos.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript"   src="../../../javascript/overlib_mini.js"></script>
<script language="javascript"    src="../../../javascript/barra/floater_xlibAbajo.js"></script>
<script language="javascript"    src="../../../javascript/barra/basic.js"></script>
<script language="javascript"    src="../../../javascript/barra/scripts1.js"></script>
<script language="JavaScript" src="../../../javascript/funciones.js" type="text/javascript">

var cabecera=window.screenTop

if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<body><form method="post" name="frm" id="frm" action="">
<div id="contenido1">
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td> <table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
          <tr> 
            <td><img src="../../../imagenes/banner.jpg" width="750" height="35"></td>
          </tr>
          <tr> 
            <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
              <tr> 
                <td class="menubackgr" style="padding-left:5px;"> <div id="myMenuID"></div>
					<?php 

if ($_SESSION["rol"] == 'autor')//autor municipal 
{
?>
<script language="javascript"  src="../../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../../javascript/menu_admin.js">	
		</script>


<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../../javascript/menu_super.js">	
		</script>


<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../../javascript/menu_invitado.js">	
		</script>
<?php
} 
?>
                </td>
                <td class="menubackgr"  valign="middle" align="right" > <a class="intro_sup" onMouseOver="return overlib('<?php if($_SESSION["rol"]=="admin")print "Administrador";
																elseif($_SESSION["rol"]=="super")print "Súper Administrador";
																elseif($_SESSION["rol"]=="edito")print "Editor-ONE";
																elseif($_SESSION["rol"]=="autor")print "Autor Municipal";
																elseif($_SESSION["rol"]=="aut_p")print "Autor Provincial";										
																elseif($_SESSION["rol"]=="jefes")print "Directivo";
																elseif($_SESSION["rol"]=="invit")print "Invitado";
		?>', ABOVE, RIGHT);" onMouseOut="return nd();" href="../../../php/logout.php" style="color: #333333; font-weight: bold"> 
                  Salir:&nbsp; <?php print $_SESSION["user"];?></a> </td>
              </tr>
            </table>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                  <tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar" id="toolbar"  >
                        <tr  > 
                          <td width="8%" valign="middle"  class="us"><img src="../../../imagenes/admin/searchtext.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="75%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Incidencias y cumplimientos por municipio.</font></strong></td>
                          
                          <td width="7%"> <div align="center"> <a  class="toolbar" href="exp_inc_x_prov.php?sem=<?php print $sem;?>&mes=<?php print $mes;?>&ano=<?php print $ano;?>"   target="_blank"> 
                              <img   src="../../../imagenes/xls_16.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Exportar</a> </div></td>
                          <td width="7%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                          Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
               <br>
               <br>
                <table width="99%" height="200" border="0" cellpadding="0" cellspacing="0" class="tabla" id="toolbar1">
                  
                  <tr align="center" valign="center"  >
                    <td height="33" colspan="10" ><table width="696" height="32" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                      <tr>
                        <td width="79"><div align="right">Semana:</div></td>
                        <td width="130"><select name="sel_sem" id="sel_mes2" onChange="javascript:document.frm.submit();">
                          <option value="0">---------------</option>
                          <option <?php if($_POST["sel_sem"]=="01")print "selected";?> value="01">Primera</option>
                          <option <?php if($_POST["sel_sem"]=="02")print "selected";?> value="02">Segunda</option>
                          <option <?php if($_POST["sel_sem"]=="03")print "selected";?> value="03">Tercera</option>
                          <option <?php if($_POST["sel_sem"]=="04")print "selected";?> value="04">Cuarta</option>
                        </select></td>
                        <td width="78" height="20"><div align="right">Mes:</div></td>
                        <td width="136">
                          <select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                          <option value="0">---------------</option>
                          <option <?php if($_POST["sel_mes"]=="01")print "selected";?> value="01">Enero</option>
                          <option <?php if($_POST["sel_mes"]=="02")print "selected";?> value="02">Febrero</option>
                          <option <?php if($_POST["sel_mes"]=="03")print "selected";?> value="03">Marzo</option>
                          <option <?php if($_POST["sel_mes"]=="04")print "selected";?> value="04">Abril</option>
                          <option <?php if($_POST["sel_mes"]=="05")print "selected";?> value="05">Mayo</option>
                          <option <?php if($_POST["sel_mes"]=="06")print "selected";?> value="06">Junio</option>
                          <option <?php if($_POST["sel_mes"]=="07")print "selected";?> value="07">Julio</option>
                          <option <?php if($_POST["sel_mes"]=="08")print "selected";?> value="08">Agosto</option>
                          <option <?php if($_POST["sel_mes"]=="09")print "selected";?> value="09">Septiembre</option>
                          <option <?php if($_POST["sel_mes"]=="10")print "selected";?> value="10">Octubre</option>
                          <option <?php if($_POST["sel_mes"]=="11")print "selected";?> value="11">Noviembre</option>
                          <option <?php if($_POST["sel_mes"]=="12")print "selected";?> value="12">Diciembre</option>                          
                          </select>                        </td>
                        <td width="91"  align="center"><div align="right">A&ntilde;o:</div></td>
                        <td width="162"  align="center"><div align="left">
                          <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                            <option value="0">------</option>
                            <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){?>
                            <option <?php if($_POST["sel_ano"]==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                            <?php }?>                    
                          </select>
                        </div></td>
                      </tr>
                      
                    </table>
                    <label></label></td>
                  </tr>
                  
                  
                  <tr align="center" valign="center"  > 
                    <td height="20" colspan="2" align="center" class="intro1">Municipio</td>
                    <td width="9%" align="center" class="intro1"><a onMouseOver="return overlib('Cantidad de precios distribuidos a captar en el mes.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Precios que se distribuyeron en el mes</a></td>
                    
                    <td width="9%" align="center" class="intro1"><a onMouseOver="return overlib('Captaciones digitadas en el sistema en fecha, las mismas pueden ser con precios observados o no observados.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Incorporados en el sistema en fecha</a></td>
                    
                    <td width="10%" align="center" class="intro1"><a onMouseOver="return overlib('Captaciones digitadas en el sistema fuera de fecha, las mismas pueden ser con precios observados o no observados.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Incorporados en el sistema fuera de fecha</a></td>
                    
                    <td width="8%" align="center" class="intro1"><a onMouseOver="return overlib('Cantidad de precios no observados por alguna razón. Puede ser que no se visitó el establecimiento, estaba cerrado temporalmente o definitivamente o puede ser que dicha variedad no estaba disponible en el formulario de captación de precios por ajustes en las sustituciones.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Precios no observados</a></td>
                    
                    <td width="9%" align="center" class="intro1"><a onMouseOver="return overlib('Precios que no se fueron a obervar ya que no se visitó el establecimiento.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Precios no observados por no realizar la visita</a></td>
                    
                    <td width="10%" align="center" class="intro1"><a onMouseOver="return overlib('Precios no observados por alguna falta.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Faltas ocasionales, definitivas o temporales</a></td>
                    
                    <td width="10%" align="center" class="intro1"><a onMouseOver="return overlib('Porcentaje de precios observados respecto a los precios distribuidos en el mes.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Porcentaje de observados en fecha respecto al total (%)</a></td>
                    
                    <td width="11%" align="center" class="intro1"><a onMouseOver="return overlib('Porcentaje de captaciones digitadas en el sistema respecto a los precios distribuidos en el mes.', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1">Cumplimiento en fecha(%)</a></td>
                  </tr>
                  <?php
  $cadenacheckboxp = "";
 if($mes!=0 and $ano!=0)
{
  if($rs->fields[0]!='')
{

	$rs->MoveFirst();
	$ch1=0;
	$mejor=1;
	$peor=100;
	
	
	  	while (!$rs->EOF)
	  	{

  if($mes!=0 and $ano!=0)
                  {
				  if($sem=="04" || $sem=="0")
				  $fecha_cierre_sem=$fecha_cal_cierre_sem4;
				   
                  $sql1 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_ini."' and captacion.fecha<'".$fecha_cierre_sem."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."'
				  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  //print $sql1."<br><br>";
				  $rs1 = $db->Execute($sql1)or die($db->ErrorMsg());
				  
				  $sql2 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_ini."' and captacion.fecha<'".$fecha_cierre_sem."'
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql2;
				  $rs2 = $db->Execute($sql2)or die($db->ErrorMsg());//no observados en fecha
				  
				 
				  $sql22 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')			    
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql22."<br>";
				  $rs22 = $db->Execute($sql22)or die($db->ErrorMsg());//no observados en fecha y fuera de fecha
				  //and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')
				  
				  $sql4 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0' and id_inc='4'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				 // print $sql4;
				  $rs4 = $db->Execute($sql4)or die($db->ErrorMsg());
				  
				  $sql5 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."'  
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0' and (id_obs='5' or id_obs='3' or id_obs='2') and id_inc='1'
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql5;
				  $rs5 = $db->Execute($sql5)or die($db->ErrorMsg());
				  
				  if($_POST["sel_sem"]!="04")
				  {
				  $sql6 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cierre_sem."' and captacion.fecha<'".$fecha_01_next."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_01_next."' or n_var_estab.desuso='0')
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql6."<br><br>";
				  //and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_01_next."' or n_var_estab.desuso='0')
				  $rs6 = $db->Execute($sql6)or die($db->ErrorMsg());
				  }
                  

$count22=$rs22->fields["count"];
$count2=$rs2->fields["count"];
$count6=$rs6->fields["count"];
if($sem=="04")
{$count22=$count2;$count6="";}


 if($rs1->fields["count"]!=0)
 $porc=$count22/($rs1->fields["count"]+$count6);//porcentajeno observados en fecha y fuera de fecha
 
 

 ?>



  
                  <tr <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?> > 
                    <td height="21" colspan="2"align="center" class="raya"><div align="left"><a onMouseOver="return overlib('<?php echo $prov_mun;?>', ABOVE, RIGHT);" onMouseOut="return nd();"  ><?php echo $rs->fields["cod_dpa_nueva"].". "; echo $rs->fields["prov_mun_nuevo"];?></a></div></td>
                    <td class="raya" align="center"><a class="toolbar1" >
                      <?php if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch=$ch+$rs->fields["count"]; $cuba=$cuba+$rs->fields["count"];echo $rs->fields["count"];?>
                    </a></td>
                    <td class="raya" align="center"><?php if($rs1->fields["count"]>$rs->fields["count"]) $digitadas=$rs->fields["count"];else $digitadas=$rs1->fields["count"]; print $digitadas;if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch1=$ch1+$digitadas; $cuba1=$cuba1+$digitadas;?></td>
                 
				  
				    <td class="raya" align="center"><?php $fuera_fecha=$count6;print $fuera_fecha; if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch6=$ch6+$fuera_fecha; $cuba6=$cuba6+$fuera_fecha;?></td>
				    
					<?php //echo "<b>De los cuáles:<br>No observados en fecha:</b> ";
					if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch2=$ch2+$count2; $cuba2=$cuba2+$count2;
					//echo $count2;
					if($sem!="04" && $sem!="0"){$pnff=$count22-$count2;if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch_pnff=$ch_pnff+$pnff; $cuba_pnff=$cuba_pnff+$pnff;//echo "<b><br>No observados fuera de fecha:</b> ".$pnff;$pnff="";
					}?>
                  
                    <td class="raya" align="center"><a onMouseOver="return overlib('<?php if($porc!="")echo "<b>Porcentaje de no observados tanto en fecha y fuera de fecha: </b>".round($porc*100,1)." %";$porc="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch22=$ch22+$count22; $cuba22=$cuba22+$count22;if($sem!="04")echo $count22; else echo $count2;?></a></td>
                    
                    <td class="raya" align="center"><?php if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch4=$ch4+$rs4->fields["count"]; $cuba4=$cuba4+$rs4->fields["count"];echo $rs4->fields["count"];?></td>
                    <td class="raya" align="center"><?php if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch5=$ch5+$rs5->fields["count"]; $cuba5=$cuba5+$rs5->fields["count"];echo $rs5->fields["count"];?></td>
                    <?php
                    	 $porc_en_fec_y_no=round(($digitadas+$fuera_fecha-$count22)/$rs->fields["count"]*100,1);
 //print $porc_en_fec_y_no."  = ".$digitadas." + ".$fuera_fecha." - ".$count22." / ".$rs->fields["count"];
 
 $porc3=round($digitadas/$rs->fields["count"]*100,1);//cumplimiento en fecha
 $porc6=round(($digitadas+$fuera_fecha)/$rs->fields["count"]*100,1);//cumplimiento en fecha y fuera de fecha
 

                    ?>
                    
                    <td class="raya" align="center"><a onMouseOver="return overlib('<?php echo "<b>Porcentaje observados respecto al total en fecha y fuera de fecha: </b> ";if($porc_en_fec_y_no!=0)print $porc_en_fec_y_no." %";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if($digitadas!=0)$porc2=round(($digitadas-$rs2->fields["count"])/$rs->fields["count"]*100,1);if($porc2!="0")print $porc2;?></a></td>
                    
                    <td class="raya" align="center"><a onMouseOver="return overlib('<?php if($porc6!=0)echo "<b>Cumplimiento en fecha y fuera de fecha: </b>".$porc6." %";$porc6="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if($porc3!="0")print $porc3;?></a></td>
                  </tr>
                  
                  <?php 
		$prom=($porc2+$porc3)/2;if($mejor<$prom){$mejor=$prom;$mejor_dpa=$rs->fields["cod_dpa"].". ".$rs->fields["prov_mun"];}
    	$prom=($porc2+$porc3)/2;if($peor>$prom){$peor=$prom;$peor_dpa=$rs->fields["cod_dpa"].". ".$rs->fields["prov_mun"];}
		$porc2=0;
		
		

	  	$rs->MoveNext();
	  	}
  	}
  	
  		
if($ch1!=0 || $ch6!=0)$porc_ch=$ch22/($ch1+$ch6); if($porc_ch!="")//print $porc_ch."  ".$ch22."  ".$ch1;//porcentaje de no observados en ch

if($ch!="0")$porc2_ch=round(($ch1-$ch2)/$ch*100,1);//porcentaje de observados respecto al total en fecha
	
if($ch!="0")$porc_ch_en_f_y_fuera=round(($ch1+$ch6-$ch22)/$ch*100,1);//porcentaje de observados respecto al total en fecha y fuera de fecha
//print $porc_ch_en_f_y_fuera." = ".$ch1." + ".$ch6." - ".$ch22." / ".$ch;
	
if($cuba1!=0 || $cuba6!=0)$porc_cuba=$cuba22/($cuba1+$cuba6);//porcentaje de no observados en cuba 

if($cuba!="0" && $cuba!="")$porc2_cuba=round(($cuba1-$cuba2)/$cuba*100,1);//porcentaje de observados respecto al total en fecha
if($cuba!="0")$porc_cuba_en_f_y_fuera=round(($cuba1+$cuba6-$cuba22)/$cuba*100,1);//porcentaje de observados respecto al total en fecubaa y fuera de fecubaa
		
		
if($ch!="0" && $ch!="")$porc3_ch=round($ch1/$ch*100,1);//cumplimiento en fecha
if($ch!="0" && $ch!="")$porc6_ch=round(($ch1+$ch6)/$ch*100,1);//cumplimiento en fecha y fuera de fecha
//print $porc6_ch." = ".$ch1." + ".$ch6." / ".$ch;

if($cuba!="0" && $cuba!="")$porc3_cuba=round($cuba1/$cuba*100,1);//cumplimiento en fecha
if($cuba!="0" && $cuba!="")$porc6_cuba=round(($cuba1+$cuba6)/$cuba*100,1);//cumplimiento en fecha y fuera de fecha
  ?>
  
  				  <tr <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?> >
  				    <td width="3%" height="21"align="center" class="raya">&nbsp;</td>
  				    <td width="21%" align="center" class="raya">&nbsp;</td>
  				    <td class="raya" align="center">&nbsp;</td>
  				    <td class="raya" align="center">&nbsp;</td>
			        <td class="raya" align="center">&nbsp;</td>
			        <td class="raya" align="center">&nbsp;</td>
			        <td class="raya" align="center">&nbsp;</td>
			        <td class="raya" align="center">&nbsp;</td>
			        <td class="raya" align="center">&nbsp;</td>
  				    <td class="raya" align="center">&nbsp;</td>
  				  </tr>
  				  <tr <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?> >
                    <td height="21" colspan="2"align="center" class="raya"><div align="left"><strong>2300. La Habana</strong></div></td>
                    <td class="raya" align="center"><b><?php print $ch;?></b></td>
                    <td class="raya" align="center"><b><?php print $ch1;?></b></td>
                    <td class="raya" align="center"><b><?php print $ch6;?></b></td>
                    <?php //if($ch2!=0)echo "<b>No observados en fecha: </b>".$ch2;if($sem!="04" && $sem!="0"){echo "<b><br>No observados fuera de fecha:</b> ".$ch_pnff;$porc_ch_enf="";}?>
                    <td class="raya" align="center"><b><a onMouseOver="return overlib('<?php if($porc_ch!=0)echo "<b>Porcentaje de no observados en fecha y fuera de fecha: </b>".round($porc_ch*100,1)." %";$porc_ch="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php print $ch22;?></a></b></td>
                    <td class="raya" align="center"><b><?php print $ch4;?></b></td>
                    <td class="raya" align="center"><b><?php print $ch5;?></b></td>
                    <td class="raya" align="center"><b><a onMouseOver="return overlib('<?php if($porc_ch_en_f_y_fuera!=0)echo "<b>Porcentaje de observados en fecha y fuera de fecha: </b>".$porc_ch_en_f_y_fuera." %";$porc_ch_en_f_y_fuera="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if($porc2_ch!="0")print $porc2_ch;?></a></b></td>
                   
                    
  				    <td class="raya" align="center"><b><a onMouseOver="return overlib('<?php if($porc6_ch!=0)echo "<b>Cumplimiento en fecha y fuera de fecha: </b>".$porc6_ch." %";$porc6_ch="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if($porc3_ch!="0")print $porc3_ch;?></a></b></td>
  				  </tr>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row1\"";   ?> >
                    <td height="21" colspan="2"align="center" class="raya"><div align="left"><strong>Total Cuba</strong></div></td>
                    <td class="raya" align="center"><b><?php print $cuba;?></b></td>
                    <td class="raya" align="center"><b><?php print $cuba1;?></b></td>
                    <td class="raya" align="center"><b><?php print $cuba6;?></b></td>
                    <?php //if($cuba2!=0)echo "<b>No observados en fecha: </b>".$cuba2;if($sem!="04" && $sem!="0"){echo "<b><br>No observados fuera de fecha:</b> ".$cuba_pnff;$cuba_pnff="";}?>
                    <td class="raya" align="center"><a onMouseOver="return overlib('<?php if($porc_cuba!="")echo "<b>Porcentaje de no observados en fecha y fuera de fecha: </b>".round($porc_cuba*100,1)." %";$porc_cuba="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><b><?php print $cuba22;?></b></a></td>
                    <td class="raya" align="center"><b><?php print $cuba4;?></b></td>
                    <td class="raya" align="center"><b><?php print $cuba5;?></b></td>
                    <td class="raya" align="center"><b><a onMouseOver="return overlib('<?php if($ch2!=0)echo "<b>Porcentaje de observados en fecha y fuera de fecha: </b>".$porc_cuba_en_f_y_fuera." %";$porc_cuba_en_f_y_fuera="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if($porc2_cuba!="0")print $porc2_cuba;?></a></b></td>
                   
                   
                    <td class="raya" align="center"><b><a onMouseOver="return overlib('<?php if($porc6_cuba!=0)echo "<b>Cumplimiento en fecha y fuera de fecha: </b>".$porc6_cuba." %";$porc6_cuba="";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php if($porc3_cuba!="0")print $porc3_cuba;?></a></b></td>
                  </tr>
                  
                  
                  
                  
                  
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td height="21" colspan="2"align="center" class="raya">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td align="center" valign="middle" class="raya"><img src="../../../imagenes/extrasmall/favorites.gif" alt="" width="16" height="16"></td>
                    <td align="center" valign="middle" class="raya"><div align="right" ><strong>Mejor DPA:</strong></div></td>
                    <td colspan="3" align="center" class="raya"><div align="left"><strong>&nbsp;<?php if($mejor!="0")print $mejor_dpa;?>
                    </strong></div></td>
                  </tr>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row1\"";   ?> >
                    <td height="21" colspan="2"align="center" class="raya">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center"><img src="../../../imagenes/extrasmall/14_layer_deletelayer.gif" width="16" height="16"></td>
                    <td align="center" class="raya"><div align="right" ><strong>Peor DPA:</strong></div></td>
                    <td colspan="3" align="center" class="raya"><div align="left" ><strong>&nbsp;<?php print $peor_dpa;?></strong></div></td>
                  </tr>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row1\"";   ?> >
                    <td height="21" colspan="2"align="center" class="raya">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td class="raya" align="center">&nbsp;</td>
                    <td align="center" class="raya">&nbsp;</td>
                    <td colspan="3" align="center" class="raya">&nbsp;</td>
                  </tr>
                  
                  <?php }
				  }
				  ?>
                </table>
              </div>
             
              <br></td>
          </tr>
        </table></td>
  </tr>
  </table>
   <table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Grupo de IPC 2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</form>

</body>
</html>
