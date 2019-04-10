<?php 
$locat="l_datos_p.php";
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");




if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}


if($_POST['txt_ir'])
{//print "sds";
header("Location:l_datos_p.php?curr_page=".$_POST['txt_ir']."&order=".$order."&type=".$ordtype."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa."&sel_mes=".$sel_mes."&sel_ano=".$sel_ano."&porc=".$porc);
}
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="captacion.fecha";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=desc;
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
$dia=date("d");
$fecha_act=$ano."-".$mes."-".$dia;
//print $fecha_cal_inicio_sem1." ".$fecha_act;
if($sel_mes && $sel_ano)
{
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


//print $fecha_cal_inicio_sem1_aux."  ".$fecha_act."  ".$fecha_cal_cierre_sem4;

//print $mes_actual;
$query = "select fecha_cal,fecha_desuso, n_var_estab.fecha_captar,captacion.id_var_estab,id_cap, variedad, obs,cod_var,ecod_var,  n_variedad.id_variedad, id_estab_sustituido,fecha_sus,
unidad, tipologia,
cod_estab,dir,n_estab.cod_dpa,cod_dpa_nueva,prov_mun_nuevo, estab, prov_mun, inc,captacion.id_inc,cantidad,
mercado, n_mercado.id_mercado, captacion.precio, captacion.fecha, captacion.id_usuario,
nombre, usuario, apellidos, ci, rol as rol_cap, telef, email,
captacion.valor1,captacion.valor2,captacion.valor3,captacion.valor4,captacion.valor5,captacion.valor6,
carac1,carac2,carac3,carac4,carac5,carac6, cont_imp

from captacion, usuario,n_dpa, n_obs, n_var_estab, b_variedad,n_variedad,n_mercado, n_estab,e_articulo, n_unidad, n_inc,n_tipologia, calendario

where 
calendario.fecha_captar=n_var_estab.fecha_captar and fecha_cal>='".$fecha_01_ini3."' and fecha_cal<'".$fecha_01_fin3."' and
e_articulo.ide_articulo=n_variedad.ide_articulo and
usuario.id_usuario=captacion.id_usuario and captacion.id_obs=n_obs.id_obs and 
captacion.id_var_estab=n_var_estab.id_var_estab and b_variedad.idb_variedad=n_var_estab.idb_variedad and 
n_var_estab.id_unidad=n_unidad.id_unidad and
captacion.id_inc=n_inc.id_inc and
n_variedad.id_variedad=b_variedad.id_variedad and n_mercado.id_mercado=b_variedad.id_mercado and 
n_var_estab.id_estab=n_estab.id_estab and 
n_estab.cod_dpa=n_dpa.cod_dpa 
AND n_tipologia.id_tipologia=n_estab.id_tipologia 
and  captacion.fecha>='".$fecha_cal_inicio_sem1_actual."' and captacion.fecha<'".$fecha_cal_inicio_sem1_next."' and central='0' and incluido='1' and n_variedad.ide_articulo!='1' ";
//and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')
//and captacion.precio!='0'and n_var_estab.fecha_captar>='2008-12-04' and n_var_estab.fecha_captar<='2008-12-07'
 
   if($rol=='aut_p' && $sel_cod_dpa==0) 
   {$query=$query."  and n_estab.cod_dpa like '".$cod_dpa2."'";}
   elseif($rol=='autor')
   {$query=$query."  and n_estab.cod_dpa='".$cod_dpa."'";}
   elseif($rol=='admin' || $rol=='super' || $rol=='edito'|| $rol=='aut_p')
   {if($sel_cod_dpa!=0)
    $query .= "and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
   }



if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=30;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;

}
//print $rs;
$id_estab_sustituido=$rs->fields["id_estab_sustituido"];

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
                          <td width="6%" valign="middle"  class="us"><img src="../../imagenes/admin/news.png" width="48" height="48" border="0"></td>
                          <td width="90%" valign="middle"  class="us"><strong><font color="#5A697E" size="2">Listado
                                 de captaciones no centralizadas 
                                 <?php if($rol=="autor")echo "de ".$prov_mun;?> en
                                 el mes de <?php echo $fecha_text;?></font></strong></td>
                          <td > 
                         <div align="center"><a class="toolbar" href="n_datos.php?locat=<?php print $locat; ?>"><img src="../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td> 
                            
                          <td > 
<div align="center"> <a  onClick="modif('../autor/m_datos.php');" class="toolbar" href="#"> 
                              <img   src="../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <?php if($rol=="admin" || $rol=="edito") {?>
                          <td > 
                             <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../php/eliminar.php');" src="../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
						<?php }?>
                          <td > 
                            <div align="center"><a class="toolbar" href="../autor/n_captaciones.php?locat=<?php print $locat; ?>">
                              <img   src="../../imagenes/admin/switch_f2.png" alt="Captaciones faltantes" width="32" height="32" border="0"> 
                              <br>
                          Faltantes</a> </div></td>
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
                <table width="99%" height="100"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<tr align="center" valign="middle"> 
                    <td height="60" colspan="21"  > 
                      <table width="735" height="55" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                      <tr>
                          <td  colspan="5">
                       <?php if($rol=='admin' || $rol=='super' || $rol=='edito' || $rol=='aut_p'){?> 
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
					   <?php }?>               </td> </tr>

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
                    <td class="intro" width="17" height="20">No</td>
                    <td width="20" class="intro" ><a href="l_datos_p.php?order=<?php echo "fecha_desuso";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">-</a></td>
                    <td width="22" class="intro" ><a href="l_datos_p.php?order=<?php echo "fecha".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">-</a></td>
                    <td width="22" class="intro" ><a href="l_datos_p.php?order=<?php echo "mercado";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">M</a></td>
                    <td width="28" class="intro" ><a href="l_datos_p.php?order=<?php echo "obs";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">I/O</a></td>
                    <td width="201" class="intro" ><a href="l_datos_p.php?order=<?php echo  "variedad";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Variedad</a></td>
                    <td width="190" class="intro" ><a href="l_datos_p.php?order=<?php echo "estab";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Establecimiento</a></td>
                    <td width="72" class="intro" ><div align="right"><a href="l_datos_p.php?order=<?php echo "captacion.precio";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Precio</a></div></td>
                    <?php if($rol!="autor") {?> <td width="64" class="intro" ><a href="l_datos_p.php?order=<?php echo "cod_dpa";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Cod DPA</a></td>
                    <?php }?>
                    <td width="52" class="intro" ><a href="l_datos_p.php?order=<?php echo "usuario";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Usuario</a></td>
                    <td width="41" class="intro" ><a href="l_datos_p.php?order=<?php echo "fecha_captar";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Fecha
                        </a></td>
                    <td width="21" class="intro" >
                      <?php if($rol=="admin") {?> <input name="checkbox" onClick="marcar();" type="checkbox">
                   <?php }else print "&nbsp;";?> </td>
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
		 
			
		  $inc=$rs->fields["inc"];
		  $id_inc=$rs->fields["id_inc"];
		  $obs=$rs->fields["obs"];
		  
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
			//$dia_dig=substr($rs->fields["fecha"],8,9);
		 // print $dia_dig."  ".$dia_cal_cierre;
		 
$cont_imp=$rs->fields["cont_imp"];
		  
  ?>
                  <tr  height="50" <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                    <td align="center" class="raya"><a  class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"> 
                      <?php  echo $a; ?>
                      </a></td>
                    <td  class="raya" align="center"><?php if($rs->fields["fecha_desuso"]){?>
                      <a onMouseOver="return overlib('<?php echo "Variedad dada de baja en el establecimiento el día ".$rs->fields["fecha_desuso"].".";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><p><img border="0" src="../../imagenes/extrasmall/deletecell.gif"></p></a>
                      
                    <?php }?></td>
                    <td  class="raya" align="center"> <p>
                      <?php if($fecha_dig<$fecha_cierre_sem){?>
                      <a onMouseOver="return overlib('<?php echo "Precio digitado en fecha.<br><b>Fecha de digitación:</b> ".$fecha_dig;print"<br><b>Fecha de cierre de semana:</b> ".$fecha_cierre_sem;?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><img border="0" src="../../imagenes/tick.png"></a>
                      <?php }else {?>
                    </p>
                      <p>                        <a onMouseOver="return overlib('<?php echo "Precio digitado fuera de fecha.<br><b>Fecha de digitación:</b> ".$fecha_dig;print"<br><b>Fecha de cierre de semana:</b> ".$fecha_cierre_sem;?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><img border="0" src="../../imagenes/publish_x.png"></a></p>
                    <?php }?></td>
                    <td  class="raya" align="center"><?php echo substr($rs->fields["mercado"],0,1);?></td>
                    <td  class="raya" align="center"><a onMouseOver="return overlib('<?php if($id_inc!=1)echo $inc;else print $obs;print "<br>";echo $rs->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php if($id_inc!=1)echo substr($inc,0,2);else print substr($obs,0,2);?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$rs->fields["ecod_var"];
					  echo "<br><b> UM: </b>".$rs->fields["cantidad"]." ".$rs->fields["unidad"];
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$rs->fields["valor1"];}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$rs->fields["valor2"];}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$rs->fields["valor3"];}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$rs->fields["valor4"];}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$rs->fields["valor5"];}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$rs->fields["valor6"];}
					  if($rs->fields["fecha_desuso"]){echo "<br><b>Fecha de baja:</b>".$rs->fields["fecha_desuso"];}
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" 
                      
                      target="_blank"
                      <?php if($rol=="admin" || $rol=="edito") {
                      $href="../../administracion/base/var_estab/m_var_estab.php?cerrar=1&var_aux_mod=".$rs->fields["id_var_estab"]; } 
					  else { 
                      $href="../../administracion/base/var_estab/m_var_estab_m.php?cerrar=1&var_aux_mod=".$rs->fields["id_var_estab"]; }?>
                      href="<?php print $href;?>"
                      >
					  <?php echo $rs->fields["variedad"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Código establecimiento: ".$rs->fields["cod_estab"]."<br>Código DPA: ".$rs->fields["cod_dpa"]." - ".$rs->fields["prov_mun"]."<br>Direción: ".$rs->fields["dir"]."<br>Tipología: ".$rs->fields["tipologia"];
					$fecha_sus=$rs_var_estab->fields["fecha_sus"];
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
					}
					?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["estab"];?></a></td>
                    <td align="right"  class="raya"><a onMouseOver="return overlib('<?php echo "<b> UM: </b>".$rs->fields["cantidad"]." ".$rs->fields["unidad"];if($cont_imp)print "<br><b>Precio imputado</b>";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><div align="right"><?php echo number_format($rs->fields["precio"], 2, ',', ' ');?></div></a></td>
                     
					 <?php if($rol!="autor") {?>
                     <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "DPA: ".$rs->fields["prov_mun_nuevo"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["cod_dpa_nueva"];?></a></td>
                     <?php }
					 
					 //print $rol;?>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php 
					$rol_cap=$rs->fields["rol_cap"];
					if($rol_cap=="edito") 
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
					elseif($rol_cap=="aut_p")
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Provincial";}
					elseif($rol_cap=="autor")
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Municipal";} 
					elseif($rol_cap=="admin")
					{$telef_rol=$rs->fields["telef"]."<br>Rol: Administrador";}

echo $rs->fields["nombre"]." ".$rs->fields["apellidos"]."<br>E-mail: ".$rs->fields["email"]."<br>Teléfono: ".$telef_rol;?>', ABOVE, RIGHT);"onMouseOut="return nd();" class="toolbar1"href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["usuario"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "<b>Fecha a captar:</b> ".$rs->fields["fecha_cal"]."<br><b>Fecha de digitación:</b> ".$fecha_dig;print"<br><b>Fecha de cierre de semana:</b> ".$fecha_cierre_sem."<br><b>Día a captar:</b> ";$d=substr($rs->fields["fecha_captar"],8,9);print $array[$d-1];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php print $array2[$d-1];//print $fecha_text;?></a></td>
                    <td  align="center" class="raya" > <input name="checkbox_<?php echo $rs->fields["id_cap"];?>" type="checkbox"  value="checkbox">                    </td>
                  </tr>
                  <?php 
					
     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_cap"];
		       	 }
				 elseif($rs->fields["id_cap"]!='')
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_cap"];
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
                  <input type="hidden" name="tabla" value="<?php echo "captacion";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_cap";?>">
                  <input type="hidden" name="location" value="<?php echo "../captaciones/autor/l_datos_p.php";?>">
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
