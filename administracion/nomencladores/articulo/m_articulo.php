<?php
$x="../../../";
$tabla="n_articulo";
$campo="id_articulo";
$location="l_articulo.php";
include($x."php/modificar.php");
include($x."php/session/session_super.php");
	//print $rs->fields["id"];
	$mensaje = "";
	if (isset($_POST['txt_cod_articulo']))
	{
	   $sel_subclase = $_POST["sel_subclase"];
	   $txt_cod_articulo=$_POST["txt_cod_articulo"];
	   $txt_articulo=$_POST["txt_articulo"];
		  //print $txt_cod_dpa; print $txt_prov_mun;print $sel_articulo; 
	   
		  if($sel_subclase=="" || $txt_cod_articulo=="" || $txt_articulo=="")
		  $mensaje= "Llene todos los campos.";
		  else
		  {
		$sql = "UPDATE n_articulo SET  id_subclase ='".$_POST["sel_subclase"]."',cod_articulo ='".$_POST["txt_cod_articulo"]."',articulo = '".$_POST["txt_articulo"]."'
		,carac1 = '".$_POST["txt_carac1"]."',carac2 = '".$_POST["txt_carac2"]."'
		,carac3 = '".$_POST["txt_carac3"]."',carac4 = '".$_POST["txt_carac4"]."'
		,carac5 = '".$_POST["txt_carac5"]."',carac6 = '".$_POST["txt_carac6"]."'
		,carac7 = '".$_POST["txt_carac7"]."',carac8 = '".$_POST["txt_carac8"]."'
		,carac9 = '".$_POST["txt_carac9"]."',carac10 = '".$_POST["txt_carac10"]."'
		,carac11 = '".$_POST["txt_carac11"]."',carac12 = '".$_POST["txt_carac12"]."'
		,carac13 = '".$_POST["txt_carac13"]."',carac14 = '".$_POST["txt_carac14"]."'
		,carac15 = '".$_POST["txt_carac15"]."'
		 WHERE id_articulo = '".$_POST["var_id"]."'";
		print $sql;
		$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
		//print $rs->Fields(0);
		if($rs)	
		header("Location: l_articulo.php?curr_page=".$current_page."&regis_cant=".$regis_cant."");
		//else
		//$mensaje= "ERROR. No se pudo modificar en la BD.";
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
            <form name="frm"  id="frm" method="post" action="" onSubmit="MM_validateForm('sel_subclase','','Escoger','txt_cod_articulo','','R','txt_articulo','','RLetras');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          del artículo: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="l_articulo.php?curr_page= <?php print $current_page."&regis_cant=".$regis_cant;?>"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/m_artículo.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <p>&nbsp;</p>     
              <table  class="tabla" width="100%" align="center">
                <tr> 
                  <td height="16"> <div align="center"></div></td>
                  <td height="16">&nbsp;</td>
                </tr>
                <tr> 
                  <td align="right"> <div align="right">Subclase</div></td>
                  <td><div align="left">  
                    <select name="sel_subclase" title="Subclase" id="sel_subclase" >
                      <option value="0" selected>----------------------------</option>
                      <?php 
                     				$x="../../../";
									$tabla=n_subclase;
									$campo0=subclase;
									$campo1=cod_subclase;
									$campo_id=id_subclase;
									$id=$rs->fields["id_subclase"];
									include("../../../php/selected.php");
								    ?>
                    </select>
                  </font></strong></div></td>
                </tr>
                <tr> 
                  <td width="18%"> <div align="right">Código del artículo:</div></td>
                  <td width="82%"> <div align="left"> 
                      <input name="txt_cod_articulo" type="text"  class="combo" id="txt_cod_articulo" title="Código del Artículo" value="<?php echo $rs->fields["cod_articulo"]; ?>" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td><div align="right">Artículo:</div></td>
                  <td><div align="left"> 
                      <input name="txt_articulo" type="text"  class="combo" id="txt_articulo" title="Artículo" value="<?php echo $rs->fields["articulo"]; ?>" size="50">
                    </div>
                    <input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_articulo"]?>"></td>
                </tr>
                <tr> 
                  <td height="14">&nbsp;</td>
                  <td valign="middle" height="14">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #1:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac1" value="<?php echo $rs->fields["carac1"]?>" type="text" id="txt_carac1"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #2:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac2" value="<?php echo $rs->fields["carac2"]?>" type="text" id="txt_carac2"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #3:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac3" value="<?php echo $rs->fields["carac3"]?>" type="text" id="txt_carac3"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #4:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac4" value="<?php echo $rs->fields["carac4"]?>" type="text" id="txt_carac4"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #5:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac5" value="<?php echo $rs->fields["carac5"]?>" type="text" id="txt_carac5"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #6:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac6" value="<?php echo $rs->fields["carac6"]?>" type="text" id="txt_carac6"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #7:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac7" value="<?php echo $rs->fields["carac7"]?>" type="text" id="txt_carac7"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #8:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac8" value="<?php echo $rs->fields["carac8"]?>" type="text" id="txt_carac8"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #9:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac9" value="<?php echo $rs->fields["carac9"]?>" type="text" id="txt_carac9"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #10:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac10" value="<?php echo $rs->fields["carac10"]?>" type="text" id="txt_carac10"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #11:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac11" value="<?php echo $rs->fields["carac11"]?>" type="text" id="txt_carac11"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #12:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac12" value="<?php echo $rs->fields["carac12"]?>" type="text" id="txt_carac12"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #13:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac13" value="<?php echo $rs->fields["carac13"]?>" type="text" id="txt_carac13"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #14:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac14" value="<?php echo $rs->fields["carac14"]?>" type="text" id="txt_carac14"  title="Característica" size="50">
                    </div></td>
                </tr>
                <tr> 
                  <td height="14"><div align="right">Caracter&iacute;stica #15:</div></td>
                  <td valign="middle" height="14"><div align="left"> 
                      <input name="txt_carac15" value="<?php echo $rs->fields["carac15"]?>" type="text" id="txt_carac15"  title="Característica" size="50">
                    </div>
                    <div align="left"></div></td>
                </tr>
                <tr> 
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2"><div   align="center"> 
                      <?php if ($mensaje) print $mensaje; ?>
                    </div></td>
                </tr>
                <tr> 
                  <td colspan="2"></td>
                </tr>
              </table>
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
