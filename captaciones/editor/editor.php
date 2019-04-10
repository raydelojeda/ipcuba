<?php 
session_start();
$x="../../";
require_once($x."adodb/adodb.inc.php");
require_once($x."coneccion/conn.php");
include($x."php/session/session_autor.php");

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
<link rel="stylesheet" href="../../css/theme.css" type="text/css" /></head>

<html>
<head>

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
                <?php      if ($_SESSION["rol"] == 'autor')//autor municipal 
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
} else
{
?>
<script language="javascript"  src="../../javascript/menu_invitado.js">	
		</script>
<?php
} 
?> </td>
              <td class="menubar"  valign="middle" align="right" ><a class="intro_sup" onMouseOver="return overlib('<?php if($_SESSION["rol"]=="admin")print "Administrador";
																elseif($_SESSION["rol"]=="edito")print "Editor-ONE";
																elseif($_SESSION["rol"]=="autor")print "Autor Municipal";
																elseif($_SESSION["rol"]=="aut_p")print "Autor Provincial";										
																elseif($_SESSION["rol"]=="invit")print "Invitado";
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../imagenes/extrasmall/exit.gif">
			&nbsp; </a></td>
            </tr>
          </table>
        </tr>
        <tr> 
          <td align="center" valign="middle" bgcolor="#FFFFFF"> 
          <br>
            <table width="625"  border="0"cellpadding="0" cellspacing="0"   >
              <tr> 
                <td ><img src="../../imagenes/esquina_l_Up.jpg" width="20" height="20" ></td>
                <td  class="cuadro_up" align="center">&nbsp;</td>
                <td  align="center"><img src="../../imagenes/esquina_R_Up.jpg" width="20" height="20"></td>
              </tr>
              <tr> 
                <td width="12" class="cuadro_left" align="center">&nbsp;</td>
                <td width="659"  class="cuadro_main" height="418"  > 
                <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                    <tr> 
                      <td height="321" valign="top"> 
                          <table width="478" height="321" border="0" align="center" cellpadding="0" cellspacing="0">
<tr> 
                              <td width="478"  height="321"> 
                              <table width="468" border="0"  cellpadding="0" cellspacing="0"  id="toolbar">
<tr> 
                                    <td width="49" align="center" bgcolor="#B3C4DD"><img src="../../imagenes/esquina_l_Up_main.jpg" width="49" height="59"></td>
                                    <td width="130" align="center" bgcolor="#B3C4DD"><div align="right"><strong><font color="#5A697E" size="4"><img src="../../imagenes/large/exec.gif" width="48" height="48"></font></strong></div></td>
                                  <td width="232" valign="middle" bgcolor="#B3C4DD"><strong><font color="#5A697E" size="5">Portal Editor</font></strong></td>
                                  <td width="49" valign="bottom"><img src="../../imagenes/esquina_R_Up_main.jpg" width="49" height="59"></td>
                                </tr>
                                </table>
                                <table width="467"  class="tabla_admin" id="menubar_principal" >
                                  <tr > 
                                    <td width="117" height="70"  > <a class="menubar_principal"  href="../../administracion/config/l_fichas.php"><img src="../../imagenes/admin/query.png" alt="Formularios"  width="48" height="48" border="0"  ><br>
                                      Formularios
                                   </a>                                    </td>
                            <td width="117" >  <a  class="menubar_principal"  href="l_datos_m.php"> 
                                        <img   src="../../imagenes/admin/news.png" alt="Captaciones" width="48" height="48" border="0"> 
                                    <br>
                                    Captaciones  </a> </td>
                                  <td width="117" ><a   class="menubar_principal" href="n_captaciones.php"><img   src="../../imagenes/admin/install.png" alt="Precios Faltantes" width="48" height="48" border="0"> 
                                    <br>
                                      Precios Faltantes
                                    </a> </td>
                                  <td width="117" >  <a class="menubar_principal" href="fuera_rango.php"> 
                                        <img src="../../imagenes/large/agt_announcements.gif" alt="Precios fuera de rangos" width="48" height="48" border="0"> 
                                      <br>
                                  Fuera de rangos</a> </td>
                                  </tr>
                                  <tr > 
                                    <td ><a  class="menubar_principal" href="../../administracion/nomencladores/general/catalogo.php"><img src="../../imagenes/admin/folder_violet.png" alt="Catálogo de variedades"  width="48" height="48" border="0" ><br>
                                    Cat&aacute;logo</a>                                    </td>
                              <td width="117">  <a class="menubar_principal" href="../../administracion/nomencladores/general/l_canasta.php"> 
                                        <img  src="../../imagenes/admin/sections.png" alt="Cesta de compra" width="48" height="48" border="0"> 
                                        <br>
                              Canasta</a> </td>
                                <td ><a  class="menubar_principal" href="../../administracion/nomencladores/estab/l_estab_m.php"><img src="../../imagenes/admin/frontpage.png" alt="Establecimientos"  width="48" height="48" border="0" ><br>
                                Establecimientos</a>                                    </td>
                                    <td> <a class="menubar_principal" href="../listados/inc.php"> 
                                        <img src="../../imagenes/large/agt_stop.gif" alt="Establecimientos con incidencias y observaciones." width="48" height="48" border="0"> 
                                        <br>
                                    Errores</a> </td>
                                  </tr>
                            </table>
                            <div id="id_msg" class="mensaje_negro"style="display:block"><?php 
					if($_GET["mostrar"]!="")
					{
					print $_GET["mostrar"];
					}
					?></div>
					 <script language="JavaScript" type="text/javascript">
					  setTimeout("des()",7000);
					  function des(){document.getElementById('id_msg').style.display="none";}
				     </script></td>
                            </tr>
                        </table>                      </td>
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
            <br>           </td>
        </tr>
      </table></td>
  </tr>
</table>
<div align="center"></div>
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B"> <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Dir. Estadísticas Sociales® 2010</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
<!-- ******** BEGIN ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
<!--<img name='awmMenuPathImg-LE_submenu_title_cursor' id='awmMenuPathImg-LE_submenu_title_cursor' src='../../javascript/LE_submenu_title_cursor/awmmenupath.gif' alt=''>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [2]', awmBN='450'; awmAltUrl='';</script>
<script  src='../../javascript/LE_submenu_title_cursor/LE_submenu_title_cursor.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
</tbody>
</html>

