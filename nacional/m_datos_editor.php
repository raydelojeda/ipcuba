<?php
session_start();
$x="../";
$tabla="captacion";
$campo="id_captacion";
$location="l_datos.php";


include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_autor_p.php");
$mensaje = "";

if ($_GET["var_aux_mod"]!="")
{	
	$query = " where id_captacion = '".$_GET["var_aux_mod"]."' and captacion.id_var_estab=n_var_estab.id_var_estab and captacion.id_obs=n_obs.id_obs"; 
}
if ($_POST["var_aux_mod"]!="")
{	
	$query = " where id_captacion = '".$_POST["var_aux_mod"]."'  and captacion.id_var_estab=n_var_estab.id_var_estab and captacion.id_obs=n_obs.id_obs"; 
}

$sql = "select id_captacion,captacion.precio,captacion.fecha,imputado,captacion.id_obs,captacion.id_var_estab,b_variedad.id_mercado,id_variedad,n_var_estab.id_estab,n_var_estab.idb_variedad from captacion,n_var_estab,b_variedad,n_obs,n_estab".$query;
//print $sql;
$rs = $db->Execute($sql);
include($x."php/session/session_autor_p.php");


$idb_variedad=$rs->fields["idb_variedad"];
$id_var_estab=$rs->fields["id_var_estab"];
$id_variedad=$rs->fields["id_variedad"];
$id_mercado=$rs->fields["id_mercado"];

//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."'"; 
$sql_usuario = "select id_usuario, cod_dpa from usuario".$query_usuario;		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$id_usuario=$rs_usuario->Fields("id_usuario");	if (isset($_POST['txt_precio']))
	if (isset($_POST['txt_precio']))
	{
	$txt_precio= $db->qstr($_POST['txt_precio'], $magic_quotes);	
	$sel_obs= $db->qstr($_POST['sel_obs'], $magic_quotes);
	$rbt_imp= $db->qstr($_POST['rbt_imp'], $magic_quotes);	
    $fecha_dig=date("Y/m/d");

//---------------------------------------------------
	
	$mensaje = "";

		
		if($_POST['txt_precio']!='') 
	{
	
	$sql = "UPDATE captacion SET  precio=$txt_precio, id_usuario = '".$id_usuario."',id_obs = $sel_obs, imputado=$rbt_imp,fecha='".$fecha_dig."' WHERE id_captacion = '".$_POST["var_id"]."'";
	//print $sql;
	$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
	//print $rs;print $mensaje;
	if($rs)
	{
	//header("Location: l_datos.php");
	$mensaje= "Se modificó satisfactoriamente en la BD.";
	}
	}
	else
	$mensaje= "Datos Vacíos.";
	}
	//}
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
<link href="../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../javascript/cal2.js"></script>
<script language="javascript" src="../javascript/cal_conf2.js"></script>
<script language="javascript" src="../javascript/overlib_mini.js"></script>

<script src="../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../imagenes/banner.jpg" width="750" height="35"></td>
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
<script language="javascript"  src="../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../javascript/menu_invitado.js">	
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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../imagenes/extrasmall/exit.gif">
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
                        <td width="7%" valign="middle"  class="us"><img src="../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Dato 
                          nacional: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="l_datos_editor.php"> 
                            <img name="imageField2" src="../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../help/m_provincial_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <p>&nbsp;</p>     
              <table width="71%" height="293" align="center"  class="tabla">
                <tr>
                  <td height="16" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td width="33%" height="22" align="right">Mercado:</td>
                  <td colspan="2"><div align="left">
                      <input name="sel_mercado"  type="text" disabled id="sel_mercado" title="Mercado"
                        value="<?php 
									$query_mer = "select mercado FROM n_mercado, b_variedad WHERE b_variedad.id_mercado=n_mercado.id_mercado and b_variedad.idb_variedad=$idb_variedad";
									$rs_mer=$db->Execute($query_mer) or $mensaje=$db->ErrorMsg() ;//print $query_mer;
									//--------------------------
                     				print $rs_mer->fields["mercado"];
								    ?>" 
                      size="35">
                    (*) </div></td>
                </tr>
                <tr>
                  <td height="22" align="right">Variedad:</td>
                  <td colspan="2"><div align="left">
  <input name="sel_cod_var" type="text"  disabled id="sel_cod_var" title="C&oacute;digo Variedad"
                        value="<?php 						
                    	 $query_pro = "select cod_var,variedad FROM n_variedad, b_variedad WHERE b_variedad.id_variedad=n_variedad.id_variedad and b_variedad.idb_variedad=$idb_variedad";
						 $rs_pro=$db->Execute($query_pro) or $mensaje=$db->ErrorMsg() ;			     
						 print $rs_pro->Fields("cod_var").". ".$rs_pro->Fields("variedad");//print $query_sel;?>" size="35">
  &nbsp;(*)</div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Establecimiento:</td>
                  <td colspan="2"><div align="left">
                      <input name="sel_estab" type="text"  disabled id="sel_estab" title="Establecimiento"
                        value="<?php 						
                    	 $query_estab = "select cod_estab,estab FROM n_estab, n_var_estab WHERE n_var_estab.id_estab=n_estab.id_estab and n_var_estab.id_var_estab=$id_var_estab";
						 $rs_estab=$db->Execute($query_estab) or $mensaje=$db->ErrorMsg() ;			     
						 print $rs_estab->Fields("cod_estab").". ".$rs_estab->Fields("estab");//print $query_sel;?>" size="35">
                    (*) </div></td>
                </tr>
                <tr>
                  <td height="20"  align="right">Precio m&iacute;nimo:</td>
                  <td width="44%"><div align="left">
                      <input name="txt_min"   disabled id="txt_min" title="Precio M&iacute;nimo" value="<?php 
									$query_mer = "select   from b_variedad,captacion,n_var_estab where captacion.id_var_estab=$id_var_estab
and n_var_estab.idb_variedad=$idb_variedad";
									$rs_mer=$db->Execute($query_mer) or $mensaje=$db->ErrorMsg() ;//print $query_mer;
									//--------------------------
                     				print $rs_mer->fields[" "];
								    ?>" size="10">
                  (*)                  </div></td>
                  <td width="23%">&nbsp;</td>
                </tr>
                <tr>
                  <td height="18" align="right">Precio:</td>
                  <td colspan="2"><div align="left">
                    <input name="txt_precio"    id="txt_precio"  title="precio" value="<?php echo $rs->fields["precio"];?>" size="10">
                  </div></td>
                </tr>
                <tr align="center">
                  <td height="19" align="right">Precio m&aacute;ximo: </td>
                  <td colspan="2" align="left"><div align="left">
                    <input name="txt_max"   disabled id="txt_max" title="Precio Maximo" value="<?php 
									$query_mer = "select p_max from b_variedad,captacion,n_var_estab where captacion.id_var_estab=$id_var_estab
and n_var_estab.idb_variedad=$idb_variedad";
									$rs_mer=$db->Execute($query_mer) or $mensaje=$db->ErrorMsg() ;//print $query_mer;
									//--------------------------
                     				print $rs_mer->fields["p_max"];
								    ?>" size="10">
                  </div></td>
                </tr>
                <tr align="center">
                  <td align="right">Imputado:</td>
                  <td height="19" colspan="2" align="left"> <div align="left">S&iacute;
                    <input  name="rbt_imp" type="radio" value="1" <?php if($rs->fields["imputado"]>0)print "checked"; ?>>
  &nbsp; No
  <input  name="rbt_central" type="radio" value="0" <?php if($rs->fields["imputado"]==0)print "checked"; ?> >
                  </div>
                </tr>
                <tr align="center">
                  <td height="19" align="right">Fecha a Captar:</td>
                  <td colspan="2" align="left"><?php 
									$query_fecha = "select fecha_captar FROM n_var_estab,captacion WHERE captacion.id_var_estab=n_var_estab.id_var_estab";
									$rs_fecha=$db->Execute($query_fecha) or $mensaje=$db->ErrorMsg() ;//print $query_mer;
									//--------------------------
                     				print $rs_fecha->fields["fecha_captar"];
								    ?>
                    <div align="left"></div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Fecha digitaci&oacute;n: </td>
                  <td colspan="2"><?php echo $rs->fields["fecha"]; ?>
                  <div align="left"></div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Observaciones:</td>
                  <td colspan="2"><div align="left">
                    <select name="sel_obs" title="Observasion" id="sel_obs" >
                      <option value="0">-----------------------</option>
                      <?php                      
									$tabla=n_obs;
									$campo0=obs;
									$campo_id=id_obs;
									$id=$rs->fields["id_obs"];
									include("../php/selected.php");
									?>
                    </select>
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">&nbsp;</td>
                  <td colspan="2"><input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_captacion"]?>">
                      <label></label></td>
                </tr>
                <tr>
                  <td height="19" colspan="3"><div align="center">
                      <?php if ($mensaje) print $mensaje; ?>
                  </div></td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                </tr>
              </table>
              <input  type="hidden" name=" " value="<?php echo $rs_precio->fields[" "];?>">
              <input  type="hidden" name="p_max" value="<?php echo $rs_precio->fields["p_max"];?>">
              <p>&nbsp;</p></form>
            <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
