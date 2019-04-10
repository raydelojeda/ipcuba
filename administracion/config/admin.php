<?php 
$x="../../";
session_start();
require_once($x."adodb/adodb.inc.php");
require_once($x."coneccion/conn.php");
include($x."php/session/session_admin.php");
?>

<html>
<script language="JavaScript" src="../../javascript/overlib_mini.js" type="text/javascript"></script>
<head>
<!--  
*** Plataforma en Software Libre
*** Realizado por Ing. Raydel Ojeda Figueroa
   -->
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/azul.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../imagenes/flecha.ico"/> 
</head>
<script language="JavaScript" src="../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="JavaScript" src="../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript"   src="../../javascript/cal2.js"></script>
<script language="javascript"   src="../../javascript/cal_conf2.js"></script>
<script language="JavaScript" src="../../javascript/funciones.js" type="text/javascript">
var cabecera=window.screenTop
 
if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<tbody>
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td> <table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
        <tr> 
          <td><img src="../../imagenes/banner.jpg" width="750" height="35"></td>
        </tr>
        <tr> 
          <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
            <tr> 
              <td class="menubackgr" style="padding-left:5px;"> <div id="myMenuID"></div>
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
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../javascript/menu_jefes.js">	
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
?> </td>
              <td class="menubar"  valign="middle" align="right" > <a href="../../php/logout.php" style="color: #333333; font-weight: bold"> 
                Salir:&nbsp; <?php print $_SESSION["user"];?></a> </td>
            </tr>
          </table>
        </tr>
        <tr> 
          <td align="center" valign="middle" bgcolor="#FFFFFF"> <p>&nbsp;</p>
            <table width="625"  border="0"cellpadding="0" cellspacing="0"   >
              <tr> 
                <td ><img src="../../imagenes/esquina_l_Up.jpg" width="20" height="20" ></td>
                <td  class="cuadro_up" align="center">&nbsp;</td>
                <td  align="center"><img src="../../imagenes/esquina_R_Up.jpg" width="20" height="20"></td>
              </tr>
              <tr> 
                <td width="12" class="cuadro_left" align="center">&nbsp;</td>
                <td width="659"  class="cuadro_main" height="418"  > <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                    <tr> 
                      <td height="378"  align="right" valign="top"> <div align="center"> 
                          <table width="470" border="0" align="center" cellpadding="0" cellspacing="0">
<tr> 
                              <td width="470" height="378"> <table width="470" border="0" cellpadding="0" cellspacing="0"  id="toolbar">
<tr> 
                                    <td width="49" align="center"><img src="../../imagenes/esquina_l_Up_main.jpg" width="49" height="59"></td>
                                    <td width="150" align="center" bgcolor="#B3C4DD"><div align="right"><strong><font color="#5A697E" size="4"><img src="../../imagenes/admin/config.png" width="48" height="48"></font></strong></div></td>
                                    <td width="240" valign="middle" bgcolor="#B3C4DD"><strong><font color="#5A697E" size="4"> 
                                      Administraci&oacute;n </font></strong></td>
                                    <td width="49" valign="bottom"><img src="../../imagenes/esquina_R_Up_main.jpg" width="49" height="59"></td>
                                  </tr>
                                  
                                </table>
                                <table  class="tabla_admin" id="menubar_principal" >
                                  <tr > 
                                    <td > <a class="menubar_principal"  href="../usuarios/l_usuario.php"><img src="../../imagenes/icon_users1.PNG" alt="Usuarios"  width="48" height="48" border="0" ><br>
                                          Usuarios</a>
                                    </td>
                                    <td width="36%">  <a  class="menubar_principal"  href="../nomencladores/estab/l_estab.php"> 
                                        <img   src="../../imagenes/admin/frontpage.png" alt="Establecimientos" width="48" height="48" border="0"> 
                                        <br>
                                    Establecimientos</a> </td>
                                    <td width="33%"><a   class="menubar_principal" href="../nomencladores/unidad/l_unidad.php"><img   src="../../imagenes/admin/folder_violet.png" alt="Unidades de Medida" width="48" height="48" border="0"> 
                                      <br>
                                    Unidades Medida</a> </td>
                                    <td width="33%">  <a class="menubar_principal" href="../nomencladores/obs/l_obs.php"> 
                                        <img src="../../imagenes/admin/credits.png" alt="Observaciones" width="48" height="48" border="0"> 
                                      <br>
                                        Observaciones</a> </td>
                                  </tr>
                                  <tr > 
                                    <td ><a  class="menubar_principal" href="../nomencladores/mercado/l_mercado.php"><img src="../../imagenes/admin/templatemanager.png" alt="Mercados"  width="48" height="48" border="0" ><br>
                                          Mercados</a>
                                    </td>
                                    <td>  <a class="menubar_principal" href="../nomencladores/tipologia/l_tipologia.php"> 
                                        <img  src="../../imagenes/admin/module.png" alt="Tipologías" width="48" height="48" border="0"> 
                                        <br>
                                    Tipologías</a> </td>
                                    <td ><a  class="menubar_principal" href="../nomencladores/dpa/l_dpa.php"><img src="../../imagenes/admin/browser.png" alt="DPA"  width="48" height="48" border="0" ><br>
                                          DPA</a>
                                    </td>
                                  <td> <a class="menubar_principal" href="../base/var_estab/l_var_estab.php"> 
                                        <img src="../../imagenes/admin/menu.png" alt="Variedad-Establecimiento" width="48" height="48" border="0"> 
                                        <br>
                                    Variedad-Estab.</a> </td>
                                  </tr>
                                  <tr > 
                                    <td ><a   class="menubar_principal" href="../nomencladores/general/l_canasta.php"><img src="../../imagenes/admin/sections.png" alt="Nomenclador"  width="48" height="48" border="0" ><br>
                                    Nomenclador</a></td>
                                    <td><a   class="menubar_principal" href="../nomencladores/general/catalogo.php"> 
                                      <img   src="../../imagenes/admin/mediamanager.png" alt="Catálogo" width="48" height="48" border="0"> 
                                      <br>
                                    Catálogo</a></td>
                                    <td><a   class="menubar_principal" href="../nomencladores/division/l_division.php"><img   src="../../imagenes/large/folder_yellow.gif" alt="Divisiones" width="48" height="48" border="0"> 
                                      <br>
                                    Divisiones</a></td>
                                    <td><a   class="menubar_principal" href="../nomencladores/grupo/l_grupo.php"><img   src="../../imagenes/large/folder.gif" alt="Grupos" width="48" height="48" border="0"> 
                                      <br>
                                    Grupos</a></td>
                                  </tr>
                                  <tr >
                                    <td ><a  class="menubar_principal" href="../nomencladores/clase/l_clase.php"><img src="../../imagenes/large/folder_green.gif" alt="Clases"  width="48" height="48" border="0" ><br>
                                          Clases</a>
                                    </td>
                                    <td> <a   class="menubar_principal" href="../nomencladores/subclase/l_subclase.php"> 
                                      <img   src="../../imagenes/large/folder_blue.gif" alt="Subclases" width="48" height="48" border="0"> 
                                      <br>
                                    Subclases</a> </td>
                                    <td><a  class="menubar_principal" href="../nomencladores/articulo/l_articulo.php"><img   src="../../imagenes/large/folder_grey.gif" alt="Artículos" width="48" height="48" border="0"> 
                                      <br>
                                    Art&iacute;culos</a></td>
                                    <td><a class="menubar_principal" href="../nomencladores/variedad/l_variedad.php"> 
                                      <img src="../../imagenes/large/mydocuments.gif" alt="Variedades" width="48" height="48" border="0"> 
                                      <br>
                                    Variedades</a> </td>
                                  </tr>
                                  
                              </table>
                              <p><div id="id_msg" style="display:block" class="mensaje_negro"><?php if($_GET["msg"])echo $_GET["msg"];//if($_POST["msg"])
							  echo $_POST["msg"];?></div>
				  <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",25000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script></p></td>
                            </tr>
                          </table>
                        </div></td>
                    </tr>
                  </table></td>
                <td width="13" class="cuadro_right" align="center">&nbsp;</td>
              </tr>
              <tr> 
                <td  align="center"><img src="../../imagenes/esquina_l_Down.jpg" width="20" height="18"></td>
                <td height="23" class="cuadro_down" align="center">&nbsp;</td>
                <td  align="center"><img src="../../imagenes/esquina_R_Down.jpg" width="20" height="18"></td>
              </tr>
            </table>
            <p>&nbsp; </p></td>
        </tr>
      </table></td>
  </tr>
</table>
<div align="center"></div>
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B"> <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Grupo de IPC 2011</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
<!-- ******** BEGIN ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
<!--<img name='awmMenuPathImg-LE_submenu_title_cursor' id='awmMenuPathImg-LE_submenu_title_cursor' src='../javascript/LE_submenu_title_cursor/awmmenupath.gif' alt=''>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [2]', awmBN='450'; awmAltUrl='';</script>
<script  src='../javascript/LE_submenu_title_cursor/LE_submenu_title_cursor.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
</tbody>
</html>
