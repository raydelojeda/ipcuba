<?php
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");

$mensaje="";
if(isset($_POST['sel_unidad_p']))
{

$magic_quotes = get_magic_quotes_gpc();
$sel_unidad_g = $_POST['sel_unidad_g'];
$sel_unidad_p = $_POST['sel_unidad_p'];
$txt_cantidad = $_POST['txt_cantidad'];

if($_POST['sel_unidad_p']!=0 && $_POST['sel_unidad_p']!=0 && $txt_cantidad!=0) 
{
$sql="INSERT INTO n_correlacionador (id_unidad_g,id_unidad_p,factor) 
VALUES ('$sel_unidad_g','$sel_unidad_p','$txt_cantidad')";
//print $sql;
$rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg();
$mensaje="Datos guardados correctamente.";
	if($rs)
		{
		$gestor = @fopen($camino, "a");
			if ($gestor) 
			{
			   
			   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
				{
					echo "No se puede escribir al archivo.";
					exit;
				}
				fclose($gestor);
			}
		}		
	
}
else
$mensaje="Debe escoger las unidades de medida y escribir el factor de conversión";	 
	
	
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
            <form  method="post" id="frm"  action="" name="frm" onSubmit="MM_validateForm('','','Escoger','','','R','txt_unidad','','R');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/vcalendar.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Correlacionador de unidades de medidas</font></strong>
                          <div align="center"></div></td>
                        <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%"> <div align="center"> <a class="toolbar" href="l_correlacionador.php"> 
                            <img name="imageField2" src="../../../imagenes/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/n_unidad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table> <p>&nbsp;</p>
              <table width="485" height="176" class="cuadro">
                <tr> 
                  <td width="550" height="170"> 
<table width="406" align="center" class="tabla">
                      <tr> 
                        <td colspan="2">&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="center" > 
                        <td height="14" colspan="2"><div align="center">U/M:</div></td>
                        <td width="87" height="14"><div align="right">Factor:</div></td>
                        <td width="170"><div align="left">&nbsp;&nbsp;U/M:</div></td>
                      </tr>
                      <tr align="center" >
                        <td height="13" colspan="2">                          
                          <div align="right">
                            1
                            <select name="sel_unidad_g" title="Unidades de Medida" id="sel_unidad_g">
                              
                              <?php                      
						$tabla=n_unidad;
						$campo0=unidad;
						$campo_id=id_unidad;
						$id=$rs->fields["id_unidad"];
						include($x."php/selected.php");
						?>
                                   </select>
                        =                        </div></td>
                        <td height="13">                          
                          <div align="right">
                            <input name="txt_cantidad"  type="text" id="txt_cantidad"  title="Cantidad" size="5" maxlength="10">
                      </div></td><td height="13"><div align="left">
                             &nbsp; <select name="sel_unidad_p" title="Unidades de Medida" id="sel_unidad_p">
                                <?php                      
						$tabla=n_unidad;
						$campo0=unidad;
						$campo_id=id_unidad;
						$id=$rs->fields["id_unidad"];
						include($x."php/selected.php");
						?>
                              </select>
                            </div></td>
                      </tr>
                      <tr align="center" >
                        <td height="31" colspan="4" valign="bottom">Ejemplo:</td>
                      </tr>
                      <tr align="center" >
                        <td width="108" height="13"><div align="right">1kg</div></td>
                        <td width="21"><div align="right">=</div></td>
                        <td height="13"><div align="right">1000</div></td>
                        <td height="13"><div align="left">&nbsp;&nbsp;g</div></td>
                      </tr>
                      <tr align="center" > 
                        <td height="37" colspan="4"><div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                          <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script> &nbsp;</td>
                      </tr>
                    </table>
                    
                  </td>
                </tr>
              </table>
              <p align="center">&nbsp;</p>
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

