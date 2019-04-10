<?php
session_start();
$x="../../";
$tabla="captacion";
$campo="id_cap";
$location="l_datos.php";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_autor.php");
$mensaje = "";


$array_text=array("Domingos de la 1ra","Lunes de la 1ra","Martes de la 1ra","Miércoles de la 1ra","Jueves de la 1ra","Viernes de la 1ra","Sábado de la 1ra",
			 	  "Domingos de la 2da","Lunes de la 2da","Martes de la 2da","Miércoles de la 2da","Jueves de la 2da","Viernes de la 2da","Sábado de la 2da",
		    	  "Domingos de la 3ra","Lunes de la 3ra","Martes de la 3ra","Miércoles de la 3ra","Jueves de la 3ra","Viernes de la 3ra","Sábado de la 3ra",
			 	  "Domingos de la 4ta","Lunes de la 4ta","Martes de la 4ta","Miércoles de la 4ta","Jueves de la 4ta","Viernes de la 4ta","Sábado de la 4ta");


if ($_GET["var_aux_mod"]!="")
{	
	$query = " and id_cap = '".$_GET["var_aux_mod"]."' " ; 
}
if ($_POST["var_aux_mod"]!="")
{	
	$query = " and id_cap = '".$_POST["var_aux_mod"]."'"; 
}

$sql = "select va_a_calculo, fecha_captar, fecha_modif, captacion.id_cap,captacion.precio,captacion.fecha,captacion.id_obs,n_var_estab.id_var_estab,b_variedad.id_mercado,id_variedad,n_estab.id_estab,b_variedad.idb_variedad, captacion.id_inc
from captacion,n_var_estab,b_variedad,n_obs,n_estab ,n_inc
where  n_estab.id_estab=n_var_estab.id_estab and captacion.id_inc=n_inc.id_inc and n_var_estab.idb_variedad=b_variedad.idb_variedad and captacion.id_var_estab=n_var_estab.id_var_estab and captacion.id_obs=n_obs.id_obs".$query;
//print $sql;
$rs = $db->Execute($sql);

if ($_GET["curr_page"]!="")
{	
	$curr_page = $_GET["curr_page"]; 
	$regis_cant = $_GET["regis_cant"]; //print $curr_page." ".$regis_cant;	
}

$idb_variedad=$rs->fields["idb_variedad"];
$id_var_estab=$rs->fields["id_var_estab"];
$id_variedad=$rs->fields["id_variedad"];
$id_mercado=$rs->fields["id_mercado"];
$var_id=$rs->fields["id_cap"];
$fecha_modif=$rs->fields["fecha_modif"];

//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."'"; 
$sql_usuario = "select rol,id_usuario, cod_dpa from usuario".$query_usuario;		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$rol=$rs_usuario->Fields("rol");
$id_usuario=$rs_usuario->Fields("id_usuario");	
$id_usuario_aprueba=$rs_usuario->Fields("id_usuario");

if(isset($_POST['txt_precio']))
{   

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_var_estab_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg();
$fecha_base = $rs_var_estab_fecha->Fields('max');
//---------------------------------------------------

$sel_mes=date("m");
$sel_ano=date("Y");
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
	
	$mensaje = "";
		
	$txt_precio= $_POST['txt_precio'];
	$sel_obs=$_POST['sel_obs'];
	$sel_inc=$_POST['sel_inc'];
	$chec_bool_aprob=$_POST['chec_bool_aprob'];
	$fecha_modif=date("Y-m-d");
	
	if($sel_inc!=1)
	{
		$txt_precio=0;$sel_obs=1;$va_a_calculo=0;$id_usuario_aprueba=0;
	}
	elseif($sel_obs==2 || $sel_obs==3 || $sel_obs==5)
	{
		$txt_precio=0;$sel_inc=1;$va_a_calculo=0;$id_usuario_aprueba=0;
	}	
	elseif($txt_precio!=0)
	{
		$sql_cap_ant="select precio from captacion where id_var_estab='$id_var_estab' 
		and fecha>='$fecha_cal_inicio_sem1_pasada' and fecha<'$fecha_cal_inicio_sem1_actual'";
		$rs_cap_ant=$db->Execute($sql_cap_ant) or die($db->ErrorMsg());//print $sql_cap_ant;
		
		$precio_ant=$rs_cap_ant->fields["precio"];
		if($precio_ant!=0)
		$rel=$txt_precio/$precio_ant;//print $rel." = ".$txt_precio." / ".$precio_ant;
		
		$va_a_calculo=0;
		
		if($rel>0.5 && $rel<1.5)
		$va_a_calculo=1;
		
		if($chec_bool_aprob==1)
		$va_a_calculo=1;
		else
		$va_a_calculo=0;	
	}
	
	
	$sql = "UPDATE captacion SET  precio='$txt_precio', id_obs='$sel_obs', id_usuario='".$id_usuario."', id_inc='$sel_inc',
	va_a_calculo='$va_a_calculo', id_usuario_aprueba='$id_usuario_aprueba', fecha_modif='$fecha_modif' WHERE id_cap='$var_id'";
	//print $sql;die();
	$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;	
	if($rs)
		{
			$gestor = @fopen($camino, "a");
			if ($gestor) 
			{			   
			   if (fwrite($gestor, $sql.";\r\n") === FALSE) 
				{
					echo "No se puede escribir al archivo.";
					exit;
				}
				fclose($gestor);
			}
		}
		header("Location: l_datos_m.php?curr_page=".$curr_page."&regis_cant=".$regis_cant."");
}
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
            <form name="frm"  id="frm" method="post" action="" onSubmit="MM_validateForm('txt_precio','','RisNum');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../imagenes/admin/news.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td width="80%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Dato 
                          municipal: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="2%"> 
                          <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   onClick="validar_obs_m('incid','obser')"  name="btn_save" id="btn_save"   src="../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                        <td width="5%"> 
                          <div align="center"> <a class="toolbar" href="l_datos_m.php?curr_page=<?php print $curr_page."&regis_cant=".$regis_cant;?>"> 
                            <img name="imageField2" src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                    Cancelar</a> </div></td>
                        <td width="6%"> 
                          <div align="center"><a class="toolbar" href="#" onClick="window.open('../help/m_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
             <br>  
              <table width="96%" height="298" align="center"  class="tabla">
                <tr> 
                  <td height="16" colspan="2">&nbsp; </td>
                </tr>
                <tr> 
                  <td width="30%" height="22" align="right">Mercado:</td>
                  <td width="70%"> <div align="left">
                      <input name="sel_mercado"  type="text" disabled id="sel_mercado" title="Mercado"
                        value="<?php 
									$query_mer = "select mercado FROM n_mercado, b_variedad WHERE b_variedad.id_mercado=n_mercado.id_mercado and b_variedad.idb_variedad=$idb_variedad";
									$rs_mer=$db->Execute($query_mer) or $mensaje=$db->ErrorMsg() ;//print $query_mer;
									//--------------------------
                     				print $rs_mer->fields["mercado"];
								    ?>" 
                      size="35">
                  </div></td>
                </tr>
                <tr> 
                  <td height="22" align="right">Variedad:</td>
                  <td><div align="left">
  <input name="sel_cod_var" type="text"  disabled id="sel_cod_var" title="Código Variedad"
                        value="<?php 						
                    	 $query_pro = "select ecod_var,variedad FROM n_variedad, b_variedad WHERE b_variedad.id_variedad=n_variedad.id_variedad and b_variedad.idb_variedad=$idb_variedad";
						 $rs_pro=$db->Execute($query_pro) or $mensaje=$db->ErrorMsg() ;			     					//print $query_pro;
						 print $rs_pro->Fields("ecod_var").". ".$rs_pro->Fields("variedad");//print $query_sel;?>" size="60">
                  </div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Establecimiento:</td>
                  <td><div align="left">
                      <input name="sel_estab" type="text"  disabled id="sel_estab" title="Establecimiento"
                        value="<?php 						
                    	 $query_estab = "select cod_estab,estab FROM n_estab, n_var_estab WHERE n_var_estab.id_estab=n_estab.id_estab and n_var_estab.id_var_estab=$id_var_estab";
						 $rs_estab=$db->Execute($query_estab) or $mensaje=$db->ErrorMsg() ;			     
						 print $rs_estab->Fields("cod_estab").". ".$rs_estab->Fields("estab");//print $query_sel;?>" size="60">
                  </div></td>
                </tr>
                
                <tr> 
                  <td height="18" align="right">Precio:</td>
                  <td><div align="left">
                    <input name="txt_precio"       id="txt_precio"  title="precio" value="<?php echo $rs->fields["precio"];?>" size="10">
                  (*)</div></td>
                </tr>
                
                
                <tr align="center"> 
                  <td height="19" align="right">Fecha a captar:</td>
                  <td align="left"> 
                    <div align="left">
                      <?php 
     				   $fecha_captar=$rs->fields["fecha_captar"];
					   $dia_text=substr($fecha_captar,8,2);if($fecha_captar){print "El ".$array_text[$dia_text-1]." semana.";}?>
                    &nbsp; </div>                    </td>
                </tr>
                <tr>
                  <td height="19" align="right">Fecha digitada:</td>
                  <td><?php echo $rs->fields["fecha"]; ?></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Fecha de la última modificación: </td>
                  <td><?php echo $rs->fields["fecha_modif"]; ?></td>
                </tr>
                <tr id="incid">
                  <td height="22" align="right">Incidencia:</td>
                  <td><div align="left">
                      <select name="sel_inc" title="Incidencia" id="sel_inc"  onChange="validar_obs_m('incid','obser')">
                     	<option <?php if($rs->fields["id_inc"]==1) print "selected";?> value="1">E0: Establecimiento visitado</option>
                        <option <?php if($rs->fields["id_inc"]==2) print "selected";?> value="2">E1: Cierre temporal del establecimiento</option>
                        <option <?php if($rs->fields["id_inc"]==3) print "selected";?> value="3">E2: Cierre definitivo del establecimiento</option>
                        <option <?php if($rs->fields["id_inc"]==4) print "selected";?> value="4">E3: Establecimiento no visitado</option>
                        <option <?php if($rs->fields["id_inc"]==5) print "selected";?> value="5">E4: Negativa</option>
                        <?php /*                     
						$tabla=n_inc;
						$campo0=inc;
						$campo_id=id_inc;
						$id=$rs->fields["id_inc"];
						include($x."php/selected.php");*/
						?>
                     </select>
                    (*)</div></td>
                </tr>
             
                <tr id="obser"> 
                  <td height="22" align="right">Observación:</td>
                  <td><div align="left">
                    <select name="sel_obs" title="Observación" id="sel_obs" onChange="validar_obs_m('incid','obser')">
                     	<option <?php if($rs->fields["id_obs"]==6) print "selected";?> value="6">PN: Precio normal</option>
                        <option <?php if($rs->fields["id_obs"]==9) print "selected";?> value="9">C: Comparable</option>
                        <option <?php if($rs->fields["id_obs"]==8) print "selected";?> value="8">R: Rebaja</option>
                        <option <?php if($rs->fields["id_obs"]==2) print "selected";?> value="2">FE: Falta estacional</option>
                        <option <?php if($rs->fields["id_obs"]==3) print "selected";?> value="3">FD: Falta definitiva</option>
                        <option <?php if($rs->fields["id_obs"]==4) print "selected";?> value="4">O: En oferta</option>
                        <option <?php if($rs->fields["id_obs"]==5) print "selected";?> value="5">FO: Falta ocasional</option>
                      <?php /*
					  if(sel_inc!="1")
					  {
					     $query = "select * from n_obs order by id_obs";
						$rs=$db->Execute($query) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs->RecordCount();
							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs->Fields("obs");
								$rs_fields2=substr($rs_fields0,0,50);
								$rs_fields0=$rs->Fields("obs");
								$rs_fields3=substr($rs_fields0,3,50);
								print $rs_fields3;
								$rs_fields1="";
								$rs_fields_id=$rs->Fields("id_obs");										 
								echo"<option title=\"";echo $rs_fields3; echo"\" value=";echo $rs_fields_id; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields2; echo "</option>";
								$rs->MoveNext();
							}                   
						}
						*/?>
                    </select>
                    (*)</div></td>
                </tr>
               
                <tr> 
                  <td height="14"  align="right">DPA:</td>
                  <td><div align="left">
                    <input name="sel_estab2" type="text"  disabled id="sel_estab2" title="Establecimiento"
                        value="<?php 						
                    	 $query_estab = "select cod_dpa_nueva,prov_mun_nuevo FROM n_dpa,n_estab, n_var_estab 
						 WHERE n_dpa.cod_dpa=n_estab.cod_dpa and n_var_estab.id_estab=n_estab.id_estab and n_var_estab.id_var_estab=$id_var_estab";
						 $rs_estab=$db->Execute($query_estab) or $mensaje=$db->ErrorMsg() ;			     
						 print $rs_estab->Fields("cod_dpa_nueva").". ".$rs_estab->Fields("prov_mun_nuevo");//print $query_sel;?>" size="60">
                  </div></td>
                </tr>
                <?php if($rol=='admin' || $rol=='super' || $rol=='edito' || $rol=='aut_p'){?> 
                <tr>
                  <td height="14"  align="right">Aprobado:</td>
                  <td><input  name="chec_bool_aprob" <?php if($rs->fields["va_a_calculo"]==1) print "checked";?>  type="checkbox"  value="1"></td>
                </tr>
                <?php }?> 
                <tr> 
                  <td height="19" colspan="2"><div align="center"> 
                      <input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_cap"];?>">
                      <?php if ($mensaje) print $mensaje; ?>
                    </div></td>
                </tr>
                <tr> 
                  <td colspan="2"></td>
                </tr>
              </table>
              <input  type="hidden" name="p_min" value="<?php echo $rs_precio->fields["p_min"];?>">
              <input  type="hidden" name="p_max" value="<?php echo $rs_precio->fields["p_max"];?>">
             </form><br>
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
