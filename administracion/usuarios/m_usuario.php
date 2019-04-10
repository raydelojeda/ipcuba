<?php
$x="../../";
$tabla="usuario";
$campo="id_usuario";
$location="l_usuario.php";
include($x."php/modificar.php");
include($x."php/session/session_super.php");
	//print $rs;
	$mensaje = "";
	if (isset($_POST['txt_nombre']))
	{
	   $magic_quotes = get_magic_quotes_gpc();
	   $txt_nombre=$_POST["txt_nombre"];
	   $txt_apellidos=$_POST["txt_apellidos"];
	   $txt_usuario=$_POST["txt_usuario"];
	   $txt_ci=$_POST["txt_ci"];
	   $sel_rol=$_POST["sel_rol"];
	   $txt_email=$_POST["txt_email"];
	   $txt_telef=$_POST["txt_telef"];//print $_POST["chk_user"];	   
	   $txt_clave = $db->qstr(md5($_POST['txt_clave']), $magic_quotes);
	   if($_POST["chk_user"]=="on")
	   $chk_user=0;
	   else
	   $chk_user=1;
	   
	  //if($txtNombre=="" || $txtEdad=="" || $txtDesc=="" || $txtSalario=="" || $Roll == "" || $Roll == "--- Elegir ---" || $txtEmail == "")
	  //$mensaje= "Llene todos los campos.";
	 // else
	//  {
if($_POST['txt_clave'])
	$sql = "UPDATE usuario SET  baja ='".$chk_user."',nombre ='".$_POST["txt_nombre"]."',apellidos = '".$_POST["txt_apellidos"]."',usuario = '".$_POST["txt_usuario"]."',ci = '".$_POST["txt_ci"]."',rol = '".$sel_rol."',email = '".$_POST["txt_email"]."',telef = '".$_POST["txt_telef"]."' ,cod_dpa = '".$_POST["sel_cod_dpa"]."',clave = $txt_clave WHERE id_usuario = '".$_POST["var_id"]."'";
else
$sql = "UPDATE usuario SET  baja ='".$chk_user."',nombre ='".$_POST["txt_nombre"]."',apellidos = '".$_POST["txt_apellidos"]."',usuario = '".$_POST["txt_usuario"]."',ci = '".$_POST["txt_ci"]."',rol = '".$sel_rol."',email = '".$_POST["txt_email"]."',telef = '".$_POST["txt_telef"]."' ,cod_dpa = '".$_POST["sel_cod_dpa"]."' WHERE id_usuario = '".$_POST["var_id"]."'";
	//print $sql;
	$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
	//print $rs->Fields(0);
	if($rs)
	{
					$gestor = @fopen("c:\usuario.txt", "a");
					if ($gestor) 
					{
					   
					   if (fwrite($gestor, $sql.";\r\n") === FALSE) 
						{
							echo "No se puede escribir al archivo.";
							exit;
						}
						fclose($gestor);
					}
	
	
	header("Location: l_usuario.php");
	$mensaje= "Se modificó satisfactoriamente en la BD.";
	}
	//else
	//$mensaje= "ERROR. No se pudo modificar en la BD.";
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
            <form name="frm"  id="frm" method="post" action="" onSubmit="Carnet();MM_validateForm('txt_nombre','','RLetras','txt_apellidos','','RLetras','txt_ci','','RisNum','txt_usuario','','R','txt_email','','RisEmail');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td height="56" align="right" class="menudottedline">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                <td width="7%" height="50" valign="middle"  class="us"><img src="../../imagenes/admin/user.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                  </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de usuarios: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                    <input type="image"   name="btn_save" id="btn_save"   src="../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="l_usuario.php"> 
                    <img name="imageField2" src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0">
                    <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/m_usuario.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                    <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <br>     
              <table width="80%" height="246" align="center"  class="tabla">
                <tr> 
                  <td height="28" colspan="2"><div align="center"></div></td>
                </tr>
                <tr> 
                  <td width="35%" height="17"  align="right">Nombre:</td>
                  <td width="65%"> 
                      <input name="txt_nombre" class="combo" title="Nombre" type="text" id="txt_nombre" value="<?php echo $rs->fields["nombre"]; ?>">
                    </td>
                </tr>
                <tr> 
                  <td height="17"  align="right">Apellidos:</td>
                  <td> 
                      <input name="txt_apellidos" class="combo" title="Apellidos" type="text" id="txt_apellidos" value="<?php echo $rs->fields["apellidos"]; ?>">
                    </td>
                </tr>
                <tr> 
                  <td height="17"  align="right">Usuario:</td>
                  <td> 
                      <input name="txt_usuario" class="combo" title="Usuario" type="text" id="txt_usuario" value="<?php echo $rs->fields["usuario"]; ?>">
                    </td>
                </tr>
                <tr> 
                  <td height="17"  align="right"> Carnet Id.:</td>
                  <td> 
                      <input   name="txt_ci" class="combo"  title="Carnet Id." type="text"  id="txt_ci" value="<?php echo $rs->fields["ci"]; ?>" maxlength="11">
                    </td>
                </tr>
                <tr> 
                  <td height="18" align="right">Código 
                    DPA:</td>
                  
                  <td>
                      <select name="sel_cod_dpa" title="DPA" id="sel_cod_dpa" >
                        <option value="0">-----------------------</option>  
                        <?php 
                     				
									$tabla="n_dpa where incluido='1'";
									$campo0=prov_mun_nuevo;
									$campo1=cod_dpa_nueva;
									$campo_id="cod_dpa";
									$id=$rs->fields["cod_dpa"];print $id;
									include($x."php/selected.php");
								?>
                    </select>
                      </td>
                </tr>
                <tr> 
                  <td height="18" align="right">Rol: 
                    </td>
                     <?php $rol=$rs->fields["rol"];?>
                  <td align="left">
                    <select class="combo" name="sel_rol" id="sel_rol">
                  	<option <?php if($rol=='super') print "selected";?> value="super">SA</option>
                    <option <?php if($rol=='admin') print "selected";?> value="admin">Administrador</option>
                    <option <?php if($rol=='autor') print "selected";?> value="autor">Autor Municipal</option>
                    <option <?php if($rol=='aut_p') print "selected";?> value="aut_p">Autor Provincial</option>
                    <option <?php if($rol=='edito') print "selected";?> value="edito">Editor</option>
                    <option <?php if($rol=="jefes") print "selected";?> value="jefes">Directivo</option>
                    <option <?php if($rol=='invit') print "selected";?> value="invit">Invitado</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td height="17" align="right">Teléfono:</td>
                  <td align="left"><input  class="combo" name="txt_telef"   title="Teléfono" type="text" id="txt_telef" value="<?php echo $rs->fields["telef"]; ?>"></td>
                </tr>
                <tr> 
                  <td height="19" align="right">E-Mail:</td>
                  <td align="left">
                      <input  class="combo" name="txt_email"   title="E-Mail" type="text" id="txt_email" value="<?php echo $rs->fields["email"]; ?>">
                      <input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_usuario"]?>">
                   </td>
                </tr>
                <tr>
                  <td height="22" align="right"><strong><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"> Clave</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">:</font></strong></td>
                  <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <input class="combo" name="txt_clave" type="password"  title="Clave"  id="txt_clave">
                  </font></strong></div></td>
                </tr>
                <tr>
                  <td height="20" align="right">Usuario activo:</td>
                  <td align="left">
                    <input type="checkbox" <?php if($rs->fields["baja"]!="1") print "checked";?> name="chk_user" id="chk_user">                  </td>
                </tr>
                <tr> 
                  <td colspan="2"><div align="center"> 
                      <?php if ($mensaje) print $mensaje; ?>
                    </div></td>
                </tr>
                <tr> 
                  <td colspan="2"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong></strong></font></div></td>
                </tr>
              </table>
            <br></form>
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
