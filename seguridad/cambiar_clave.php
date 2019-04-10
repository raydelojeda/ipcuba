<?php 
session_start();
require_once("../adodb/adodb.inc.php");
require_once("../coneccion/conn.php");

   

if (isset($_POST['txt_usuario'])) 
{
	$mensaje = "";
	$txt_user = $_POST['txt_usuario'];
	$txt_pass = $_POST['txt_pass'];
	$txt_nclave = $_POST['txt_nclave'];
	$txt_nclave1 = $_POST['txt_nclave1'];	
	
		if($txt_user == "" || $txt_pass == "" || $txt_nclave == "" || $txt_nclave1 == "" )
   		 $mensaje="Debe llenar todos los campos";
		else
		{		 
			$md5_password = md5($_POST['txt_pass']);
			$md5_user = md5($_POST['txt_usuario']);
			$md5_clave = md5($_POST['txt_nclave']);
			$md5_clave1 = md5($_POST['txt_nclave1']);
			if($md5_clave==$md5_clave1)
			{
		
				if (!get_magic_quotes_gpc()) 
				  $txt_user = addslashes($_POST['txt_usuario']);
				else 
				  $txt_user = $_POST['txt_usuario'];

			$sql="select id_usuario from usuario where usuario='$txt_user' and clave='$md5_password'";
			$rs=$db->Execute($sql) or die($db->ErrorMsg());
		
				if($rs->fields["id_usuario"]!="")	
				{ 
				 $sql = "UPDATE usuario SET  clave = '".$md5_clave."' WHERE id_usuario = '".$rs->fields["id_usuario"]."'";//print $sql;	
				 $rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;	
				 $mensaje = "Su contraseña ha sido cambiada con éxito.";
				 
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
				 header("Location:autenticacion.php");
				 
				} 
				else
					{$mensaje = "Nombre de usuario o clave incorrecto.";}
			}
			else
			{$mensaje = "Los campos Nueva  y Repetir Clave deben ser iguales.";}	
		
	 	}
		  	
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
            <p align="center"><br>
            </p>
            <div align="center">
              <table width="368" height="248" border="0" align="center"cellpadding="0" cellspacing="0"  class="login_change" >
<tr>
                  <td width="34%" align="center" valign="middle"  class="intro_sup"><img src="../imagenes/connected_data_big.jpg" width="131" height="155"></td>
                  <td width="66%" height="240" align="center" valign="middle"  class="intro_sup"> 
                    <div align="center"> 
                      <p>Cambiar Contrase&ntilde;a</p>
                      </div>
                    <table width="77%" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                      <tr> 
                        <td height="148"> 
<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                            <form action="" method="post" name="frm">
                              <tr> 
                                <td height="18" align="right">&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr> 
                                <td width="42%" height="22" align="right"class="filtro">Usuario:</td>
                                <td width="58%"> 
                                  <input tabindex="1" name="txt_usuario" type="text"  class="combo" id="txt_usuario"></td>
                              </tr>
                              <tr> 
                                <td height="22" align="right"class="filtro">Clave:</td>
                                <td> <input name="txt_pass" type="password" class="combo" id="txt_pass" tabindex="2"></td>
                              </tr>
                              <tr> 
                                <td height="22" align="right" class="filtro">Nueva Clave:</td>
                                <td> <input name="txt_nclave" type="password" class="combo" id="txt_nclave" tabindex="3"></td>
                              </tr>
                              <tr> 
                                <td height="22" align="right" class="filtro">Verificar 
                                  Clave:</td>
                                <td> <input name="txt_nclave1" type="password" class="combo" id="txt_nclave1" tabindex="4"></td>
                              </tr>
                              <tr align="center"> 
                                <td height="18" colspan="2"  class="mensaje"> 
                                  <?php print $mensaje; $mensaje="";?> </td>
                              </tr>
                              <tr align="center"> 
                                <td height="22" colspan="2" class="style1"> <div align="center"></div>
                                  <div align="center"><span class="style4"> </span> 
                                    <input   class="boton" name="btn_aceptar" type="submit" value="Aceptar"  width="97" height="22" border="0">
                                  </div>
                                  <div align="center"><span class="style4"> </span></div>
                                  <div align="right"><span class="style4"> </span></div></td>
                              </tr>
                            </form>
                          </table></td>
                      </tr>
                    </table><p>&nbsp;</p></td>
                </tr>
              </table>
            <p align="center">&nbsp; </p>
              <p>&nbsp;</p>
            </div>
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
