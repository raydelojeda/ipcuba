<?php
$x="../../../";
include("../../../adodb/adodb.inc.php");
include("../../../coneccion/conn.php");
include("../../../php/session/session_super.php");


$mensaje="";
if(isset($_POST['txt_mercado']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	
	$txt_mercado = $db->qstr($_POST['txt_mercado'], $magic_quotes);
	
	if($_POST['txt_mercado']!='')
	{
	  
		
		//---------------------------------------------------
		$tabla="n_mercado";
		$campo="mercado";
		$valor=$txt_mercado;		
		include("../../../php/insertar.php");
		//---------------------------------------------------
		
			if($rs->Fields(0)=='')
			{
		
 			 $sql="INSERT INTO n_mercado (mercado) VALUES ($txt_mercado)";

			 $rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg() ;//print "Ya existe la persona en la Base de Datos."
  	  
			 $mensaje="El mercado ha sido insertado correctamente.";
			}
			else
			$mensaje="Ya existe un mercado en la BD.";
		 		
		}
		else
		$mensaje="Existen campos vacíos.";
	
}


$mensaje1="";
if(isset($_POST['txt_unidad']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	
	$txt_unidad = $db->qstr($_POST['txt_unidad'], $magic_quotes);
	
	if($_POST['txt_unidad']!='')
	{
	  
		
		//---------------------------------------------------
		$tabla="n_unidad";
		$campo="unidad";
		$valor=$txt_unidad;		
		include("../../../php/insertar.php");
		//---------------------------------------------------
		
			if($rs->Fields(0)=='')
			{
		
 			 $sql="INSERT INTO n_unidad (unidad) VALUES ($txt_unidad)";

			 $rs=$db->Execute($sql) or $mensaje1=$db->ErrorMsg() ;//print "Ya existe la persona en la Base de Datos."
  	  
			 $mensaje1="La unidad ha sido insertada correctamente.";
			}
			else
			$mensaje1="Ya existe una unidad en la BD.";
		 		
		}
		else
		$mensaje1="Existen campos vacíos.";
	
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
<link href="../../../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../../../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../../../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../../../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../../../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../../../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../../../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../../javascript/cal2.js"></script>
<script language="javascript" src="../../../javascript/cal_conf2.js"></script>
<script language="javascript" src="../../../javascript/overlib_mini.js"></script>

<script src="../../../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../../../imagenes/banner.jpg" width="750" height="35"></td>
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
<script language="javascript"  src="../../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../../javascript/menu_invitado.js">	
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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../../imagenes/extrasmall/exit.gif">
			&nbsp; </a>
	</td>
</tr>
</table>
   
   
   
  </tr>
  <tr>
          <td align="center" valign="middle" bgcolor="#ffffff"><!-- InstanceBeginEditable name="Body" --> 
            <form  method="post" id="frm"  action="" name="frm" >
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/mediamanager.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          del mercado-unidad medida: <font size="2">Insertar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%"> <div align="center"> <a class="toolbar" href="l_mercado_unidad.php"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%"> <div align="center"><a class="toolbar" href="#" onclick="window.open('../../../help/n_mercado_unidad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table> 
              <p>&nbsp;</p>
              <table width="332"      class="cuadro">
                <tbody><tr> 
                    <td width="324"   align="center" valign="top" bordercolor="#F1F3F5"> 
<div  align="center">
<br>
                        <table width="280"  align="center" cellpadding="0" cellspacing="0" bordercolor="#F1F3F5"  >
<tbody>
                            <tr > 
                              <td width="12"  ><img src="../../../imagenes/esquina_ocultar_left.jpg" width="18" height="21"></td>
                              <td width="249" valign="middle" class="ocultar" ><img src="../../../imagenes/collapsebtn2.png" id="collapseb1" onclick="javascript: ocultar('tabla1','collapseb1');" class="cursor" height="16" width="18">&nbsp;Insertar 
                                Mercado</td>
                              <td width="17"  ><img src="../../../imagenes/esquina_ocultar_right.jpg" width="16" height="21"></td>
                            </tr>
                            <tr> 
                              <td colspan="3" > <table    class="tabla"  id="tabla1"  border="0" width="100%" align="center">
                                  <tbody>
                                    <tr> 
                                      <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr> 
                                      <td width="41%" align="right"> <div align="right">Mercado:</div></td>
                                      <td width="59%"> <div align="left"> 
                                          <input name="txt_mercado" class="combo" title="Mercado"  type="text" id="txt_mercado">
                                        </div></td>
                                    </tr>
                                    <tr align="center"> 
                                      <td   colspan="2"  class="mensaje"><br>
                                        <div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
				  <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script><br></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table>
					  
                    <hr size="1"  width="250px" class="hr">
                        <table width="280"  align="center" cellpadding="0" cellspacing="0" >
<tbody>
                            <tr > 
                              <td width="13" height="21"  ><img src="../../../imagenes/esquina_ocultar_left.jpg" width="18" height="21"></td>
                              <td width="249" class="ocultar"  ><img src="../../../imagenes/collapsebtn2.png" id="collapseb2" onClick="javascript: ocultar('tabla2','collapseb2');" class="cursor" height="16" width="18">&nbsp;Insertar 
                                Unidad Medida</td>
                              <td width="16"  ><img src="../../../imagenes/esquina_ocultar_right.jpg" width="16" height="21"></td>
                            </tr>
                            <tr> 
                              <td colspan="3" > <table  class="tabla"  id="tabla2"  border="0" width="100%" align="center">
                                  <tbody>
                                    <tr> 
                                      <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr> 
                                      <td width="41%" align="right"> <div align="right">Unidad Medida:</div></td>
                                      <td width="59%"> <div align="left"> 
                                          <input name="txt_unidad" class="combo" title="Unidad Medida"  type="text" id="txt_unidad">
                                        </div></td>
                                    </tr>
                                    <tr align="center"> 
                                      <td  class="mensaje" colspan="2"><br>
                                        <?php echo $mensaje1?><br></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table><br>
                      </div>
                     </td>
              </tr> 	</tbody>
            </table>
          
              <p >&nbsp;</p>
            </form>
            <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
