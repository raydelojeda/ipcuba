<?php 
session_start();
require_once("../adodb/adodb.inc.php");
require_once("../coneccion/conn.php");

$_SESSION["estilo"]=$_POST['rbt_estilo'];

if($_SESSION["estilo"]=="")$_SESSION["estilo"]=a;

if (isset($_POST['txt_usuario'])) 
{
	$mensaje = "";
	$txt_user = $_POST['txt_usuario'];
	$txt_pass = $_POST['txt_pass'];	
	
		if($txt_user == "" || $txt_pass == "" )
   		 $mensaje="Debe llenar todos los campos";
		else
		{		 
			$md5_password = md5($_POST['txt_pass']);
			$md5_user = md5($_POST['txt_usuario']);
		
		
			if (!get_magic_quotes_gpc()) 
		  	  $txt_user = addslashes($_POST['txt_usuario']);
			else 
		   	  $txt_user = $_POST['txt_usuario'];

			$sql="select nombre,rol,baja from usuario where usuario='$txt_user' and clave='$md5_password'";
			$rs=$db->Execute($sql) or die($db->ErrorMsg());
		if($rs->fields["baja"]!=1)
		{	
			
			$nombre=$rs->fields["nombre"];
			if($rs->fields["rol"]=="invit")	
			{ 
			 $_SESSION["rol"] = 'invit';
			 $_SESSION["user"] = $txt_user;
			 $_SESSION["md5_pass"] = $md5_password;
			 if($md5_password=="202cb962ac59075b964b07152d234b70")
			 header("Location:../invitado.php?msg=".$nombre.", Ud. se ha autenticado como Invitado.<br><b>Debe cambiar su contraseña.</b>");
			 else
			 header("Location:../invitado.php?msg=".$nombre.", Ud. se ha autenticado como Invitado.");
			} 
			else if($rs->fields["rol"]=="admin")
			{	 
				$_SESSION["rol"] = 'admin';
				$_SESSION["user"] = $txt_user;
				$_SESSION["md5_pass"] = $md5_password;
				//$mensaje = "Ud se ha autenticado como Administrador.";
				if($md5_password=="202cb962ac59075b964b07152d234b70")
				header("Location:../administracion/config/admin.php?msg=".$nombre.", Ud. se ha autenticado como Administrador.<br><b>Debe cambiar su contraseña.</b>");
				else
				header("Location:../administracion/config/admin.php?msg=".$nombre.", Ud. se ha autenticado como Administrador.");
			}
			else if($rs->fields["rol"]=="super")
			{	 
				$_SESSION["rol"] = 'super';
				$_SESSION["user"] = $txt_user;
				$_SESSION["md5_pass"] = $md5_password;
				//$mensaje = "Ud se ha autenticado como Administrador.";
				if($md5_password=="202cb962ac59075b964b07152d234b70")
				header("Location:../administracion/config/admin.php?msg=".$nombre.", Ud. se ha autenticado como SA.<br><b>Debe cambiar su contraseña.</b>");
				else
				header("Location:../administracion/config/admin.php?msg=".$nombre.", Ud. se ha autenticado como SA.");
			}
			else if($rs->fields["rol"]=="jefes")
			{	 
				$_SESSION["rol"] = 'jefes';
				$_SESSION["user"] = $txt_user;
				$_SESSION["md5_pass"] = $md5_password;
				//$mensaje = "Ud se ha autenticado como Administrador.";
				if($md5_password=="202cb962ac59075b964b07152d234b70")
				header("Location:../administracion/config/admin.php?msg=".$nombre.", Ud. se ha autenticado como Directivo.<br><b>Debe cambiar su contraseña.</b>");
				else
				header("Location:../administracion/config/admin.php?msg=".$nombre.", Ud. se ha autenticado como Directivo.");
			}
			else if($rs->fields["rol"]=="autor")
			{	 
				$_SESSION["rol"] = 'autor';
				$_SESSION["user"] = $txt_user;
				$_SESSION["md5_pass"] = $md5_password;
				//$mensaje = "Ud se ha autenticado como Autor.";
				if($md5_password=="202cb962ac59075b964b07152d234b70")
				header("Location:../captaciones/autor/autor.php?msg=".$nombre.", Ud. se ha autenticado como Autor Municipal.<br><b>Debe cambiar su contraseña.</b>");
				else
				header("Location:../captaciones/autor/autor.php?msg=".$nombre.", Ud. se ha autenticado como Autor Municipal.");
			}
			else if($rs->fields["rol"]=="edito")
			{	 
				$_SESSION["rol"] = 'edito';
				$_SESSION["user"] = $txt_user;
				$_SESSION["md5_pass"] = $md5_password;
				//$mensaje = "Ud se ha autenticado como Editor.";
				if($md5_password=="202cb962ac59075b964b07152d234b70")
				header("Location:../captaciones/editor/editor.php?msg=".$nombre.", Ud. se ha autenticado como Editor-ONE.<br><b>Debe cambiar su contraseña.</b>");
				else
				header("Location:../captaciones/editor/editor.php?msg=".$nombre.", Ud. se ha autenticado como Editor-ONE.");
			}
			else if($rs->fields["rol"]=="aut_p")
			{	 
				$_SESSION["rol"] = 'aut_p';
				$_SESSION["user"] = $txt_user;
				$_SESSION["md5_pass"] = $md5_password;
				//$mensaje = "Ud se ha autenticado como Editor.";
				if($md5_password=="202cb962ac59075b964b07152d234b70")
				header("Location:../captaciones/aut_p/autor_p.php?msg=".$nombre.", Ud. se ha autenticado como Autor Provincial.<br><b>Debe cambiar su contraseña.</b>");
				else
				header("Location:../captaciones/aut_p/autor_p.php?msg=".$nombre.", Ud. se ha autenticado como Autor Provincial.");
			}
			else
			{$mensaje = "Nombre de usuario o clave incorrecto.";}
		}
		else
		{$mensaje = "El usuario con que intenta autenticarse fue dado de baja.";}
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
<script language="javascript" type="text/javascript">			
//window.open('../help/informacion.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=380,directories=no,location=no');
function Cambio(id_imagen)
{ 
  if (document.getElementById)
  {	imagen1=new Image
    imagen1.src="../imagenes/admin.gif";
    imagen2=new Image
    imagen2.src="../imagenes/admin1.gif";
	imagen3=new Image
    imagen3.src="../imagenes/admin2.gif";
	imagen4=new Image
    imagen4.src="../imagenes/admin3.gif";
	//alert(id_imagen);
	 if(document.images[id_imagen].src == imagen1.src)
		document.images[id_imagen].src = imagen2.src;
	 else if(document.images[id_imagen].src == imagen2.src)
	 	document.images[id_imagen].src = imagen3.src;
	 else if(document.images[id_imagen].src == imagen3.src)
	 	document.images[id_imagen].src = imagen4.src;
	 else 
	 	document.images[id_imagen].src = imagen1.src;

  }
}


function valida_pass()
{
	if(document.frm.txt_pass.value.length<=4)
	{
		alert("Debe cambiar la contraseña para que contenga al menos 5 caracteres.");
		document.frm.action="cambiar_clave.php";
		document.frm.submit();
	}
}
</script>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --> 
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<!-- InstanceEndEditable --> 

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
           <form name="frm" method="post" action="" onSubmit="javascript:valida_pass();"><br>
            <table width="43%" height="198" border="0"cellpadding="0" cellspacing="0"  class="login">
<tr> 
                  <td width="51%" align="center" valign="middle"  > 
<div class="login-text">Bienvenido a IPCuba! 
                      <p>Tiene que usar un Nombre de Usuario y Contrase&ntilde;a 
                        válidos para acceder al sistema.</p>
                    <p align="center"><a onMouseOver="return overlib('Según su Usuario y Clave tendrá diferentes niveles de acceso.', ABOVE, RIGHT);"onMouseOut="return nd();"> <img src="../imagenes/menu/help.png" width="16" height="16"></a></p>
                    <p align="center">&nbsp;</p>
                    <p align="center">&nbsp;</p>
                    <p align="center">Estilos:</p>
                    
                    <p align="center">
                      <input type="radio" name="rbt_estilo" value="a" <?php if($_SESSION["estilo"]=="a"){?>checked="checked"<?php }?> onClick="javascript:document.frm.submit();">
                      azul
                      <input type="radio" name="rbt_estilo" value="g" <?php if($_SESSION["estilo"]=="g"){?>checked="checked"<?php }?> onClick="javascript:document.frm.submit();">
                      gris 
                      <input type="radio" name="rbt_estilo" value="v" <?php if($_SESSION["estilo"]=="v"){?>checked="checked"<?php }?> onClick="javascript:document.frm.submit();">
                      verde
                      
                    </p>
                    
                    </div></td>
                  <td width="49%" height="190" align="center" valign="middle"  class="intro_sup"> 
                    <div align="center"><img id="cambio" src="../imagenes/admin/security_f2.png" width="32" height="32"> 
                      Acceder al Sistema </div>
                    <table width="83%" border="1" align="center" cellpadding="0" cellspacing="0" class="tabla">
                      <tr> 
                        <td height="102"> 
<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <script language="javascript"  >
		  //setTimeout("document.frm.txt_usuario.focus()",1);	
		  
		</script>  
						
                              <tr> 
                                <td width="33%" height="22" align="right"class="filtro">Usuario:</td>
                                <td width="67%"> <input onKeyPress="javascript:Cambio('cambio');" tabindex="1" name="txt_usuario" type="text"  class="combo" id="txt_usuario"></td>
                              </tr>
                              <tr> 
                                <td height="22" align="right"class="filtro">Clave:</td>
                                <td> <input name="txt_pass" onKeyPress="javascript:Cambio('cambio');" type="password" class="combo" id="Contrase&ntilde;a2" tabindex="2"></td>
                              </tr>
                              <tr align="center"> 
                                <td height="18" colspan="2"  class="mensaje"> 
                                  <?php print $mensaje; $mensaje="";?> </td>
                              </tr>
                              <tr align="center"> 
                                <td height="22" colspan="2" class="style1"> <div align="center"></div>
                                  <div align="center">
                                    <input   class="boton" name="btn_aceptar" type="submit" value="Entrar"  width="97" height="22" border="0">
                                  </div>
                                </td>
                              </tr>
                            
                          </table></td>
                      </tr>
                    </table>
                  </td>
              </tr>
				
            </table>
              <p>&nbsp;</p>
           
              <p><br>
                <br>
                </p></form>
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
