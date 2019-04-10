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
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];
if ($_GET["sel_moneda"]!="") $sel_moneda = $_GET['sel_moneda'];
if (isset($_POST["sel_moneda"])) $sel_moneda = $_POST['sel_moneda'];

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
{$dif=$dia_cal-dia_captar;   $dia_cal_cierre=$miercoles_dia_cierre+$dif;}
//print  $dia_cal_cierre."   ".$miercoles_dia_cierre."   ".$dif."<br>";
$fecha_cierre_sem=substr($rs_cal->fields["fecha_cal"],0,8).$dia_cal_cierre;

if($sem=="04" || $sem=="0")
$fecha_cierre_sem=$fecha_cal_cierre_sem4;
///-----------------------------------------------------


$query = "select e_articulo.ide_articulo,earticulo, count (n_variedad.id_variedad)
from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad, e_articulo 
where e_articulo.ide_articulo=n_variedad.ide_articulo
and n_var_estab.idb_variedad=b_variedad.idb_variedad 
and b_variedad.id_variedad=n_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa 
and n_var_estab.id_estab=n_estab.id_estab 
and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
and n_var_estab.id_var_estab=captacion.id_var_estab 
and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
and captacion.fecha>='".$fecha_cal_ini."' and captacion.fecha<'".$fecha_cierre_sem."'
and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
and captacion.precio='0'";

if($rol=='aut_p') 
{$query=$query." and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$query=$query." and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$query .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
} 
if($sel_moneda!=0)
$query .= " and b_variedad.id_mercado='".$sel_moneda."'"; 

$query.= " group by e_articulo.ide_articulo,earticulo order by count (n_variedad.id_variedad) desc";

if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";//print $query;
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=150;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;//print $rs;
//print $rs;
//print $_POST["sel_mes"];
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
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../../javascript/menu_super.js">	
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
                <td class="menubackgr"  valign="middle" align="right" > <a href="../../../php/logout.php" style="color: #333333; font-weight: bold"> 
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
                          <td width="10%" valign="middle"  class="us"><img src="../../../imagenes/large/db_status.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="82%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Faltas por art&iacute;culo.</font></strong></td>
                          
                          <td width="8%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                          Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="102" border="0" cellpadding="0" cellspacing="0" class="tabla" id="toolbar1">
                  
                  <tr align="center" valign="center"  >
                    <td height="49" colspan="9" ><table width="747" height="40" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                      <tr>
                        <td height="20"><div align="right">Mercado:</div></td>
                        <td><select name="sel_moneda" title="Mercado" id="sel_moneda" onChange="document.frm.submit();" >
                            <option value="0">----</option>
                            <?php 
                     				$id=$_POST['sel_moneda'];
									
									$query_sel = "select mercado, id_mercado from n_mercado";
									$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
									$cant_rs=$rs_selected->RecordCount();
										for ($i = 0; $i < $cant_rs;$i++)
										{
											$rs_fields0=$rs_selected->Fields('mercado');
											$rs_fields_id=$rs_selected->Fields('id_mercado');						$rs_fields1="";				 
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											$rs_selected->MoveNext();
										}
								    ?>
                        </select></td>
                        <td><div align="right"> <a href="#">
                            <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
                          DPA:
                          <?php }?>
                        </a></div></td>
                        <td><div align="left">
                            <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
                            <select name="sel_cod_dpa" title="C&oacute;digo DPA" id="sel_cod_dpa" onChange="document.frm.submit();" >
                              <option value="0">---------CUBA---------</option>
                              <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                            </select>
                            <?php }?>
                          &nbsp; </div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="62"><div align="right">Semana:</div></td>
                        <td width="115"><select name="sel_sem" id="sel_mes2" onChange="javascript:document.frm.submit();">
                          <option value="0">---------------</option>
                          <option <?php if($_POST["sel_sem"]=="01")print "selected";?> value="01">Primera</option>
                          <option <?php if($_POST["sel_sem"]=="02")print "selected";?> value="02">Segunda</option>
                          <option <?php if($_POST["sel_sem"]=="03")print "selected";?> value="03">Tercera</option>
                          <option <?php if($_POST["sel_sem"]=="04")print "selected";?> value="04">Cuarta</option>
                        </select></td>
                        <td width="40" height="20"><div align="right">Mes:</div></td>
                        <td width="122">
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
                        <td width="36"><div align="right">A&ntilde;o:</div></td>
                        <td width="89"><div align="left">
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
                    <td width="5%" class="intro">No</td> 
                    <td width="25%" height="20" class="intro">Art&iacute;culo</td>
                    <td class="intro" width="12%">Precios no observados</td>
                    <td class="intro" width="11%">Precios por No visitados</td>
                    <td class="intro" width="12%">Faltas ocasionales</td>
                    <td class="intro" width="12%">Faltas definitivas </td>
                    <td class="intro" width="12%">Faltas temporales</td>
                    <td class="intro" width="11%">No disponible en formulario</td>
                  </tr>
                  <?php
  $cadenacheckboxp = "";
 if($mes!=0 and $ano!=0)
{

	$rs->MoveFirst();
		
	
	  	while (!$rs->EOF)
	  	{
		$ide_articulo=$rs->fields["ide_articulo"];

  if($mes!=0 and $ano!=0)
                  {
				  if($sem=="04" || $sem=="0")
				  $fecha_cierre_sem=$fecha_cal_cierre_sem4;
				   
                  $sql1 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, b_variedad, n_variedad, n_estab,n_dpa, e_articulo 
			      where e_articulo.ide_articulo=n_variedad.ide_articulo
				  and n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0') 
				  and captacion.precio='0' and id_inc!='1'
				  and e_articulo.ide_articulo='".$ide_articulo."'
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab";
if($rol=='aut_p') 
{$sql1=$sql1." and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$sql1=$sql1." and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$sql1 .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}
if($sel_moneda!=0)
$sql1 .= " and b_variedad.id_mercado='".$sel_moneda."'"; 

				  //and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  //print $sql1."<br><br>";
				  $rs1 = $db->Execute($sql1)or die($db->ErrorMsg());
				  
				  $sql2 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, b_variedad, n_variedad, n_estab,n_dpa, e_articulo 
 				  where e_articulo.ide_articulo=n_variedad.ide_articulo
				  and n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')  
				  and captacion.precio='0' and id_obs='5' and id_inc='1'
				  and e_articulo.ide_articulo='".$ide_articulo."'
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab";
if($rol=='aut_p') 
{$sql2=$sql2." and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$sql2=$sql2." and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$sql2 .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}
if($sel_moneda!=0)
$sql2 .= " and b_variedad.id_mercado='".$sel_moneda."'"; 
				  //print $sql2;
				  $rs2 = $db->Execute($sql2)or die($db->ErrorMsg());//no observados en fecha
				  
				 
				  
				  $sql3 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, b_variedad, n_variedad, n_estab,n_dpa, e_articulo 
				  where e_articulo.ide_articulo=n_variedad.ide_articulo
				  and n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."'  
				  and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0') 
				  and captacion.precio='0' and id_obs='3' and id_inc='1'
				  and e_articulo.ide_articulo='".$ide_articulo."'
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab";
if($rol=='aut_p') 
{$sql3=$sql3." and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$sql3=$sql3." and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$sql3 .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}
if($sel_moneda!=0)
$sql3 .= " and b_variedad.id_mercado='".$sel_moneda."'"; 
				 // print $sql2;
				  $rs3 = $db->Execute($sql3)or die($db->ErrorMsg());
				  
				  $sql4 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, b_variedad, n_variedad, n_estab,n_dpa, e_articulo 
				  where e_articulo.ide_articulo=n_variedad.ide_articulo
				  and n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."'  
				  and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0') 
				  and captacion.precio='0' and id_obs='2' and id_inc='1'
				  and e_articulo.ide_articulo='".$ide_articulo."'
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab";
if($rol=='aut_p') 
{$sql4=$sql4." and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$sql4=$sql4." and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$sql4 .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}
if($sel_moneda!=0)
$sql4 .= " and b_variedad.id_mercado='".$sel_moneda."'"; 
				  //print $sql4;
				  $rs4 = $db->Execute($sql4)or die($db->ErrorMsg());
				  				  
                  $sql5 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, b_variedad, n_variedad, n_estab,n_dpa, e_articulo 
				  where e_articulo.ide_articulo=n_variedad.ide_articulo
				  and n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."'  
				  and captacion.precio='0' and id_obs='1' and id_inc='1'
				  and e_articulo.ide_articulo='".$ide_articulo."'
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab";
if($rol=='aut_p') 
{$sql5=$sql5." and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$sql5=$sql5." and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$sql5 .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}
if($sel_moneda!=0)
$sql5 .= " and b_variedad.id_mercado='".$sel_moneda."'"; 
				  //print $sql5;
				  $rs5 = $db->Execute($sql5)or die($db->ErrorMsg());

 ?>



  
                  <tr <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?> >
                    <td align="center" class="raya"><?php echo $a; ?></td> 
                    <td height="21" align="center" class="raya"><div align="left"><?php echo $rs->fields["earticulo"];?></div></td>
                    <td class="raya" align="center"><?php echo $rs->fields["count"];?></td>
                    <td class="raya" align="center"><?php echo $rs1->fields["count"];?></td>
                    <td class="raya" align="center"><?php echo $rs2->fields["count"];?></td>                    
                    <td class="raya" align="center"><?php print $rs3->fields["count"];?></td>                    
                    <td class="raya" align="center"><?php print $rs4->fields["count"];?></td>
                    <td class="raya" align="center"><?php echo $rs5->fields["count"];?></td> 
                  </tr>
                  
                  <?php 		
		

	  	$rs->MoveNext();
	  	}
  	}
  	
  		

  ?>
  


                  <?php }?>
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
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Grupo de IPC 2010</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</form>

</body>
</html>
