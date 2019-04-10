<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 
include($x."php/camino.php");
include($x."php/session/session_super.php");


$mensaje="";
if(isset($_POST['txt_nombre']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	$txt_nombre = $db->qstr($_POST['txt_nombre'], $magic_quotes);
	$txt_apellidos = $db->qstr($_POST['txt_apellidos'], $magic_quotes);
	$txt_ci = $db->qstr($_POST['txt_ci'], $magic_quotes);
	$sel_rol= $_POST['sel_rol'];
	$txt_email= $db->qstr($_POST['txt_email'], $magic_quotes);
	$txt_telef= $db->qstr($_POST['txt_telef'], $magic_quotes);
	$txt_usuario= $db->qstr($_POST['txt_usuario'], $magic_quotes);
	$sel_cod_dpa= $db->qstr($_POST['sel_cod_dpa'], $magic_quotes);
	$txt_clave = $db->qstr(md5($_POST['txt_clave']), $magic_quotes);
	$txt_confirmar = $db->qstr(md5($_POST['txt_confirmar']), $magic_quotes);
	
	if( $_POST['txt_nombre']!='' && $_POST['txt_apellidos']!='' && $_POST['txt_ci']!='' && $_POST['txt_telef']!='' && $_POST['txt_email']!='' && $_POST['txt_usuario']!='' && $_POST['txt_clave']!='' && $_POST['txt_confirmar']!='' && $_POST['sel_cod_dpa']!='') 
	{
	
	   
	  
	  
	if($txt_clave == $txt_confirmar)
	{
		//---------------------------------------------------
		$tabla="usuario";
		$campo="ci";
		$valor=$txt_ci;		
		include($x."php/insertar.php");
		//---------------------------------------------------
		
		//if(!$rs)
		//{
		//---------------------------------------------------
		//$tabla="usuario";
		//$campo="usuario";
		//$valor=$txt_usuario;		
		//include($x."php/insertar.php");
		//---------------------------------------------------
		
			//if(!$rs)
			//{
		 
 			 $sql="INSERT INTO usuario (nombre,apellidos,ci,rol,email,telef,usuario,clave,cod_dpa) VALUES ($txt_nombre ,$txt_apellidos,$txt_ci,'".$sel_rol."',$txt_email,$txt_telef,$txt_usuario,$txt_clave,$sel_cod_dpa)";
//print $sql;
			 $rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg() ;//print "Ya existe la persona en la Base de Datos."
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
					}
			 $mensaje="El usuario ha sido insertado satisfactoriamente.";
			//}
			//else
			//$mensaje="Ya existe un trabajador con ese usuario en la BD.";
		 	
		//}	 
		//else
		//$mensaje="Ya existe un usuario con ese Carnet Id. en la BD.";
		
	}
		else				
		$mensaje="Confirme correctamente su contraseña.";
	}
	else				
		$mensaje="Existen campos vacíos.";
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
            <form  method="post" id="frm"  action="" name="frm" onSubmit="Carnet();MM_validateForm('txt_nombre','','RLetras','txt_apellidos','','RLetras','txt_ci','','RisNum','txt_telef','','R','txt_email','','RisEmail','txt_usuario','','R','txt_clave','','R','txt_confirmar','','R');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" rowspan="2" valign="middle"  class="us"><img src="../../imagenes/admin/user.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td height="38" valign="bottom"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de usuarios: <font size="2">Insertar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="1%" rowspan="2"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%" rowspan="2"> <div align="center"> <a class="toolbar" href="l_usuario.php"> 
                            <img name="imageField2" src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%" rowspan="2"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/n_usuario.php', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      <tr > 
                        <td height="21" valign="middle"  class="us">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <br> 
              <table width="527"  border="0"cellpadding="0" cellspacing="0"   class="cuadro">
                <tr> 
                    
                  <td width="519" height="365"  align="center"> 
<br>
                    <table  class="tabla" width="88%" align="center">
                      <tr> 
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="36%" align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Nombre:</font></strong></td>
                        <td width="64%"> <div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input name="txt_nombre" class="combo" title="Nombre" type="text"   id="txt_nombre">
                            </font></strong></div></td>
                      </tr>
                      <tr> 
                        <td align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Apellidos:</font></strong></td>
                        <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input name="txt_apellidos" class="combo" title="Apellidos"  type="text" id="txt_apellidos">
                            </font></strong></div></td>
                      </tr>
                      <tr> 
                        <td height="24" align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Carnet 
                          Id.:</font></strong></td>
                        <td> <div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input name="txt_ci" class="combo" title="Carnet Id." type="text" id="txt_ci"  maxlength="11"   >
                            </font></strong></div></td>
                      </tr>
                      <tr align="center"> 
                        <td align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Rol:</font></strong></td>
                        <td align="left"><div align="left"> 
                            <select  class="combo" name="sel_rol" id="sel_rol">
                              <option value="invit">Invitado</option>
                              <option value="autor">Autor Municipal</option>
                              <option value="aut_p">Autor Provincial</option>
                              <option value="edito">Editor</option>
                              <option value="jefes">Directivo</option>
                              <option value="admin">Administrador</option>
                              <option value="super">SA</option>
                            </select>
                          </div></td>
                      </tr>
                      <tr align="center"> 
                        <td height="19" align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Tel&eacute;fono:</font></strong></td>
                        <td align="left"><div align="left"> 
                            <input  class="combo" name="txt_telef"  title="Teléfono"type="text" id="txt_telef">
                          </div></td>
                      </tr>
                      <tr align="center"> 
                        <td align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">E-Mail:</font></strong></td>
                        <td align="left"><div align="left"> 
                            <input  class="combo" name="txt_email"  title="E-Mail"type="text" id="txt_email">
                          </div></td>
                      </tr>
                      <tr> 
                        <td height="22" align="right"><strong><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif">Usuario</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">:</font></strong></td>
                        <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input  name="txt_usuario"  title="Usuario" type="text" id="txt_usuario" maxlength="20">
                            </font></strong></div></td>
                      </tr>
                      <tr> 
                        <td height="22" align="right"><strong><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif">Código 
                          DPA</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">:</font></strong></td>
                        <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <select name="sel_cod_dpa" title="Código Producto" id="sel_cod_dpa" >
                              <option value="0">-----------------------</option>
                              <?php 
                     				$tabla="n_dpa where incluido='1'";
									$campo0=prov_mun;
									$campo1=cod_dpa;
									$value=cod_dpa;
									include($x."php/select.php");
								    ?>
                            </select>
                            </font></strong></div></td>
                      </tr>
                      <tr> 
                        <td height="22" align="right"><strong><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                          Clave</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">:</font></strong></td>
                        <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input class="combo" name="txt_clave" type="password"  title="Clave"  id="txt_clave">
                            </font></strong></div></td>
                      </tr>
                      <tr> 
                        <td height="22" align="right"><strong><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif">Confirmar 
                          Clave</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">:</font></strong></td>
                        <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input class="combo" name="txt_confirmar"  title="Confirmar Clave" type="password" id="txt_confirmar">
                            </font></strong></div></td>
                      </tr>
                      <tr align="center"> 
                        <td height="14" colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="center"> 
                        <td colspan="2"><div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
				  <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="14" colspan="2" align="right">&nbsp; </td>
                      </tr>
                    </table>
              <br></td></tr></table>
              <p align="center">&nbsp;</p>
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
