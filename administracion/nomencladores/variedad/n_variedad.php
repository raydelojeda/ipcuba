<?php
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");


$mensaje="";
if(isset($_POST['txt_cod_variedad']))
{

	$magic_quotes = get_magic_quotes_gpc();
	$sel_articulo = $db->qstr($_POST['sel_articulo'], $magic_quotes);
	$e_sel_articulo = $db->qstr($_POST['e_sel_articulo'], $magic_quotes);
	$txt_cod_variedad = trim($_POST['txt_cod_variedad']);
	$txt_cod_variedad_enigh = trim($_POST['txt_cod_variedad_enigh']);
	$txt_variedad = trim($_POST['txt_variedad']);
	$chec_ipc = $db->qstr($_POST['chec_ipc'], $magic_quotes);
	$chec_estac = $_POST['chec_estac'];
	if($chec_estac=="")
	$chec_estac="0";
	$rbt_central= $_POST['rbt_central'];
	
	copy($_FILES['file']['tmp_name'], 'fotos_catalogo/'.$_POST['txt_cod_variedad'].'.jpg');
	
	$txt_carac1 = $db->qstr($_POST['txt_carac1'], $magic_quotes);
	$txt_carac2 = $db->qstr($_POST['txt_carac2'], $magic_quotes);
	$txt_carac3 = $db->qstr($_POST['txt_carac3'], $magic_quotes);
	$txt_carac4 = $db->qstr($_POST['txt_carac4'], $magic_quotes);
	$txt_carac5 = $db->qstr($_POST['txt_carac5'], $magic_quotes);
	$txt_carac6 = $db->qstr($_POST['txt_carac6'], $magic_quotes);
	
	if( $_POST['txt_variedad']!='' && $_POST['sel_articulo']!='0') 
	{
	 //---------------------------------------------------
	/*	$valor=$txt_cod_variedad;//print $valor;
		$sql_cod = "select * from n_variedad where cod_var = '".$valor."'";//print $sql_cod;
		$rs_cod = $db->Execute($sql_cod) or $mensaje=$db->ErrorMsg();	print $rs_cod->fields[0];
		//---------------------------------------------------
		//print $rs_cod->Fields(0);$s=$rs_cod->Fields['cod_prod'];print $s;
		if(!$rs_cod->fields[0])
		{*/
			//---------------------------------------------------
			$valor=$txt_variedad;
			$sql_var = "select * from n_variedad where variedad = '".$valor."'";
			$rs_var = $db->Execute($sql_var) or $mensaje=$db->ErrorMsg();	
			//---------------------------------------------------
			if(!$rs_var->fields[0])
			{
			
			 
			 $sql="INSERT INTO n_variedad (ecod_var,cod_var,variedad,id_articulo,ide_articulo,carac1,carac2,carac3,carac4,carac5,carac6,indice,central,estacionalidad)  
			 VALUES ('".$txt_cod_variedad_enigh."','".$txt_cod_variedad."','".$txt_variedad."',$sel_articulo,$e_sel_articulo, $txt_carac1,$txt_carac2,$txt_carac3,$txt_carac4,$txt_carac5,$txt_carac6,$chec_ipc,$rbt_central,'$chec_estac')";
//print $sql;
				 $rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg();
				 //$mensaje="La variedad ha sido insertado satisfactoriamente.";
			
			}			
			 else
			 $mensaje="ERROR. Existe una variedad con el mismo nombre en la BD.";
		//}
		//else
		//$mensaje="ERROR. Existe una variedad con el mismo código en la BD.";
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
            <form  action=""  method="post" enctype="multipart/form-data" name="frm" id="frm" onSubmit="MM_validateForm('sel_articulo','','Escoger','txt_cod_variedad','','R','txt_variedad','','R');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de la variedad: <font size="2">Insertar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%"> <div align="center"> <a class="toolbar" href="l_variedad.php"> 
                            <img name="imageField2" src="../../../imagenes/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/n_variedad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table> <br>
              <table width="740" align="center" class="tabla">
                <tr>
                  <td align="right">&nbsp;</td>
                  <td><div align="left"></div></td>
                </tr>
                <tr> 
                  <td height="15"><div align="right">Art&iacute;culo de la ENIGH:</div></td>
                  <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <select name="e_sel_articulo" title="Articulo" id="sel_articulo" onChange="document.frm.submit();">
                      <option value="1" selected>----------------------------</option>
                      <?php 
                     				$x="../../../";
									$tabla=e_articulo;
									$campo0=earticulo;
									$campo1=ecod_articulo;
									$campo_id=ide_articulo;
									$id=$_POST['e_sel_articulo'];
									include("../../../php/selected.php");
								    ?>
                    </select>
                  </font></strong></div></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td align="right" width="215"> <div align="right">Artículo:</div></td>
                  <td width="513"><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <select name="sel_articulo" title="Articulo" id="sel_articulo" onChange="document.frm.submit();">
                      <option value="1" selected>----------------------------</option>
                      <?php 
                     				$x="../../../";
									$tabla=n_articulo;
									$campo0=articulo;
									$campo1=cod_articulo;
									$campo_id=id_articulo;
									$id=$_POST['sel_articulo'];
									include("../../../php/selected.php");
								    ?>
                    </select>
                  </font></strong></div></td>
                </tr>
                <tr > 
                  <td align="right"><div align="right">Código de la variedad:</div></td>
                  <td> 
                    <div align="left">
                      <input name="txt_cod_variedad"  type="text" id="txt_cod_cap"  title="Código de la variedad" size="50">
                    </div></td>
                </tr>
                <tr>
                  <td><div align="right">C&oacute;digo de ENIGH:</div></td>
                  <td><input name="txt_cod_variedad_enigh" type="text"  class="combo" id="txt_cod_variedad_enigh" title="C&oacute;digo de la variedad" size="50"></td>
                </tr>
                <tr align="center" > 
                  <td height="14"><div align="right">Variedad:</div></td>
                  <td height="14"> 
                    <div align="left">
                      <input name="txt_variedad"  type="text" id="txt_variedad"  title="variedad" size="50">
                    </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Variedad estacional:</td>
                  <td><div align="left">
                      <input  name="chec_estac" type="checkbox"  value="1">
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Variedad para el IPC:</td>
                  <td><div align="left">
                      <input  name="chec_ipc" type="checkbox"  value="1">
                    (seleccionar para el c&aacute;lculo) </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Centralizado nacionalmente: </td>
                  <td><div align="left">
                      <input  name="rbt_central" type="radio" value="1">
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Centralizado provincialmente: </td>
                  <td><div align="left">
                      <input  name="rbt_central" type="radio" value="2">
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">No 
                    Centralizado: </td>
                  <td><div align="left">
                      <input  name="rbt_central" type="radio" value="0">
                  </div></td>
                </tr>
                
                <tr align="center" > 
                  <td height="14"><div align="left"></div></td>
                  <td height="14"><div align="left"></div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #1:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac1" value="<?php echo $_POST['txt_carac1'];?>" type="text" id="txt_carac1"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #2:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac2" value="<?php echo $_POST['txt_carac2'];?>" type="text" id="txt_carac2"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #3:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac3" value="<?php echo $_POST['txt_carac3'];?>" type="text" id="txt_carac3"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #4:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac4" value="<?php echo $_POST['txt_carac4'];?>" type="text" id="txt_carac4"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #5:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac5" value="<?php echo $_POST['txt_carac5'];?>" type="text" id="txt_carac5"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #6:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac6" value="<?php echo $_POST['txt_carac6'];?>" type="text" id="txt_carac6"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
               
                <tr>
                  <td height="14"><div align="right">Foto:</div></td>
                  <td valign="middle" height="14">
                    <div align="left">
                      <input type="file" id="file" name="file">
                    </div></td>
                </tr>
                
                <tr align="center" > 
                  <td height="14"><div align="left"></div></td>
                  <td height="14"><div align="left"></div></td>
                </tr>
                <tr align="center" > 
                  <td height="20" colspan="2"><?php echo $mensaje;?><div id="id_msg" style="display:block">
                    <div align="center"></div>
                    <div align="center"></div></div>
                    <div align="left">
                      <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				    </script> 
                    &nbsp;</div></td>
                </tr>
              </table>
              <br>
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
