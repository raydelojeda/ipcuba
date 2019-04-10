<?php 
session_start();
require_once("../../adodb/adodb.inc.php");
require_once("../../coneccion/conn.php");

$nombre_archivo = "ejecutado.txt";
$gestor = fopen($nombre_archivo, "r");
$contenido = fread($gestor, filesize($nombre_archivo));
fclose($gestor);



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
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <table width="200" border="0">
              <tr>
                <td><table width="100%" border="0" cellpadding="0" cellspacing="0"  id="toolbar">
                  <tr>
                    <td width="49" align="center"><img src="../../imagenes/esquina_l_Up_main.jpg" alt="" width="49" height="59"></td>
                    <td width="191" align="center" bgcolor="#B3C4DD"><div align="right"><strong><font color="#5A697E" size="4"><img src="../../imagenes/admin/config.png" alt="" width="48" height="48"></font></strong></div></td>
                    <td width="285" valign="middle" bgcolor="#B3C4DD"><strong><font color="#5A697E" size="4"> C&aacute;lculo de &iacute;ndices </font></strong></td>
                    <td width="49" valign="bottom"><img src="../../imagenes/esquina_R_Up_main.jpg" alt="" width="49" height="59"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><table width="100%"  class="tabla_admin" id="menubar_principal" >
                  <tr class="login" >
                    <td width="20%"  align="center"><p>
                      <?php if($contenido=="0"){?>
                      C&aacute;lculo de &iacute;ndices a nivel de variedad en cada municipio usando media geom&eacute;trica</p>
                      <p><img src="../../imagenes/large/agt_update_misc.gif" alt="Usuarios"  width="48" height="48" border="0" >
                        <?php }?>
                      </p></td>
                    <td width="20%" align="center"><p>
                      <?php if($contenido=="1"){?>
                      C&aacute;lculo de &iacute;ndices a nivel de art&iacute;culo en cada municipio usando media geom&eacute;trica</p>
                      <p> <img   src="../../imagenes/large/agt_update_misc.gif" alt="Establecimientos" width="48" height="48" border="0">
                        <?php }?>
                      </p></td>
                    <td width="20%"align="center"><p>
                      <?php if($contenido=="2"){?>
                      C&aacute;lculo de &iacute;ndices a nivel de art&iacute;culo nacional usando media aritm&eacute;tica ponderada por el gasto en cada moneda</p>
                      <p><img   src="../../imagenes/large/agt_update_misc.gif" alt="Unidades de Medida" width="48" height="48" border="0">
                        <?php }?>
                      </p></td>
                    <td width="20%"align="center"><p>
                      <?php if($contenido=="3"){?>
                      C&aacute;lculo de &iacute;ndices a niveles superiores nacional usando media aritm&eacute;tica ponderada</p>
                      <p> <img src="../../imagenes/large/agt_update_misc.gif" alt="Observaciones" width="48" height="48" border="0">
                        <?php }?>
                      </p></td>
                    </tr>
                  <tr class="login" >
                    <td height="50" ><a  class="menubar_principal1" href="l_var_x_dpa.php"><img src="../../imagenes/large/run.gif" alt="" width="48" height="48"></a></td>
                    <td><a class="menubar_principal1" href="cal_indice_nivel_art_x_dpa.php"><img src="../../imagenes/large/run.gif" alt="" width="48" height="48"></a></td>
                    <td ><a  class="menubar_principal1" href="cal_indice_nivel_art.php"><img src="../../imagenes/large/run.gif" alt="" width="48" height="48"></a></td>
                    <td><a class="menubar_principal1" href="cal_indice_nivel_sup.php"><img src="../../imagenes/large/run.gif" alt="" width="48" height="48"></a></td>
                    </tr>
                </table></td>
              </tr>
            </table> 
           <br>
         <p><br>
                <br>
                </p>
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
