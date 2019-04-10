<?php
$x="../../../";
$tabla="n_variedad";
$campo="id_variedad";
$location="l_variedad.php";
include($x."php/modificar.php");
include($x."php/session/session_admin.php");
//include($x."php/clases/modificar.php");
	//print $rs;
	$mensaje="";
	if(isset($_POST['txt_cod_variedad']))
	{
	
		$magic_quotes = get_magic_quotes_gpc();
		$sel_articulo = $db->qstr($_POST['sel_articulo'], $magic_quotes);
		$e_sel_articulo = $db->qstr($_POST['sel_articulo'], $magic_quotes);
		$txt_cod_variedad = trim($_POST['txt_cod_variedad']);
		$txt_variedad = trim($_POST['txt_variedad']);
		$chec_ipc = $db->qstr($_POST['chec_ipc'], $magic_quotes);
		$chec_estac = $_POST['chec_estac'];
		if($chec_estac=="")
		$chec_estac="0";
		$rbt_central= $_POST['rbt_central'];
		$txt_cod_variedad_enigh = trim($_POST['txt_cod_variedad_enigh']);
		
		copy($_FILES['file']['tmp_name'], 'fotos_catalogo/'.$_POST['txt_cod_variedad_enigh'].'_1.jpg');
		copy($_FILES['file1']['tmp_name'], 'fotos_catalogo/'.$_POST['txt_cod_variedad_enigh'].'_2.jpg');
		copy($_FILES['file2']['tmp_name'], 'fotos_catalogo/'.$_POST['txt_cod_variedad_enigh'].'_3.jpg');
		
		//---------------------------------------------------
		/*$valor=$txt_cod_variedad;
		$id_valor=$_GET["var_aux_mod"];	
		$sql_cod = "select * from n_variedad where cod_var = '".$valor."' and id_variedad != '".$id_valor."'" ;
		$rs_cod = $db->Execute($sql_cod) or $mensaje=$db->ErrorMsg();	
		//---------------------------------------------------
		//print $rs_cod->Fields(0);
		if($rs_cod->Fields(0)=="")
		{*/
			//---------------------------------------------------
			$valor=$txt_variedad;
			$id_valor=$_GET["var_aux_mod"];	
			$sql_var = "select * from n_variedad where variedad = '".$valor."' and id_variedad != '".$id_valor."'" ;
			//print $sql_var;
			$rs_var = $db->Execute($sql_var) or $mensaje=$db->ErrorMsg();	
			//---------------------------------------------------
			if($rs_var->Fields(0)=="")
			{
				$sql = "UPDATE n_variedad SET  id_articulo ='".$_POST["sel_articulo"]."'
				,ide_articulo ='".$_POST["e_sel_articulo"]."'
				,cod_var ='".$_POST["txt_cod_variedad"]."'
				,ecod_var ='".$_POST["txt_cod_variedad_enigh"]."'
				,variedad = '".$_POST["txt_variedad"]."'	
				,carac1 = '".$_POST["txt_carac1"]."',carac2 = '".$_POST["txt_carac2"]."'
				,carac3 = '".$_POST["txt_carac3"]."',carac4 = '".$_POST["txt_carac4"]."'
				,carac5 = '".$_POST["txt_carac5"]."',carac6 = '".$_POST["txt_carac6"]."'	
				,central=".$rbt_central.", 	indice ='".$_POST['chec_ipc']."',estacionalidad='".$chec_estac."'
				WHERE id_variedad = '".$_POST["var_id"]."'";//print $sql;			
				$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
				if($rs)	
				header("Location: l_variedad.php?curr_page=".$curr_page."&regis_cant=".$regis_cant."");
			}
			else
			$mensaje= "ERROR. No se pudo modificar en la BD. Existe una variedad con el mismo nombre.";
		//}		
		//else
		//$mensaje= "ERROR. No se pudo modificar en la BD. Existe una variedad con el mismo código.";
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
            <form action="" method="post" enctype="multipart/form-data" name="frm"  id="frm" onSubmit="MM_validateForm('txt_variedad','','R');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de variedad: <font size="2">Modificar</font></font></strong> 
                        <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="../variedad/l_variedad.php?curr_page=<?php print $curr_page."&regis_cant=".$regis_cant;?>"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#"  onclick="window.open('../../../help/m_variedad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <p>&nbsp;</p>     
              <table  class="tabla" width="95%" align="center">
                <tr> 
                  <td height="18" colspan="2">
<div align="center"></div></td>
                </tr>
                <tr> 
                  <td align="right"> <div align="right">Artículo EIGH:</div></td>
                  <td><div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <select name="e_sel_articulo" title="Art&iacute;culo" id="e_sel_articulo" onChange="document.frm.submit();">
                    <option value="1" selected>No pertenece a la encuesta</option>
                    <?php 
                     				$tabla=e_articulo;
									$campo0=earticulo;
									$campo1=ecod_articulo;
									$campo_id=ide_articulo;
									$id=$rs->fields["ide_articulo"];
									include($x."php/selected.php");
								    ?>
                  </select>
                  </font></strong></div></td>
                </tr>
                <tr>
                  <td><div align="right">Art&iacute;culo:</div></td>
                  <td><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <select name="sel_articulo" title="Artículo" id="sel_articulo" onChange="document.frm.submit();" >
                      <option value="1" selected>----------------------------</option>
                      <?php 
                     				$tabla=n_articulo;
									$campo0=articulo;
									$campo1=cod_articulo;
									$campo_id=id_articulo;
									$id=$rs->fields["id_articulo"];
									include($x."php/selected.php");
								    ?>
                    </select>
                  </font></strong></td>
                </tr>
                <tr>
                  <td height="15"><div align="right">C&oacute;digo de variedad:</div></td>
                  <td><input name="txt_cod_variedad" type="text"  class="combo" id="txt_cod_variedad" title="C&oacute;digo de la variedad" value="<?php echo $rs->fields["cod_var"]; ?>" size="50"></td>
                </tr>
                <tr> 
                  <td width="31%"> 
<div align="right">Código de ENIGH:</div></td>
                  <td width="69%"><input name="txt_cod_variedad_enigh" type="text"  class="combo" id="txt_cod_variedad_enigh" title="C&oacute;digo de la variedad" value="<?php echo $rs->fields["ecod_var"]; ?>" size="50"></td>
                </tr>
                <tr> 
                  <td><div align="right">Variedad:</div></td>
                  <td><div align="left"> 
                      <input name="txt_variedad" type="text"  class="combo" id="txt_variedad" title="Variedad" value="<?php echo $rs->fields["variedad"]; ?>" size="50">
                    </div>
                    <input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_variedad"]?>"></td>
                </tr>
                <tr>
                  <td height="19" align="right">Variedad estacional:</td>
                  <td><div align="left">
                      <input  name="chec_estac" type="checkbox"  <?php if ($rs->fields["estacionalidad"]==1) print "checked"; ?> value="1">
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Variedad para el IPC:</td>
                  <td><div align="left">
                      <input  name="chec_ipc" type="checkbox"  <?php if ($rs->fields["indice"]==1) print "checked"; ?> value="1">
                    (seleccionar para el c&aacute;lculo) </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Centralizado nacionalmente: </td>
                  <td><div align="left">
                      <input  name="rbt_central" type="radio" <?php if ($rs->fields["central"]==1){ ?> checked="checked"<?php }?>value="1">
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Centralizado provincialmente: </td>
                  <td><div align="left">
                      <input  name="rbt_central" type="radio" <?php if ($rs->fields["central"]==2){ ?> checked="checked"<?php }?>value="2">
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">No 
                    Centralizado: </td>
                  <td><div align="left">
                      <input  name="rbt_central" type="radio"  <?php if ($rs->fields["central"]==0){ ?> checked="checked"<?php }?>value="0">
                  </div></td>
                </tr>
                
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #1:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac1" value="<?php echo $rs->fields["carac1"]?>" type="text" id="txt_carac1"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #2:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac2" value="<?php echo $rs->fields["carac2"]?>" type="text" id="txt_carac2"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #3:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac3" value="<?php echo $rs->fields["carac3"]?>" type="text" id="txt_carac3"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #4:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac4" value="<?php echo $rs->fields["carac4"]?>" type="text" id="txt_carac4"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #5:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac5" value="<?php echo $rs->fields["carac5"]?>" type="text" id="txt_carac5"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td height="14"><div align="right">Caracter&iacute;stica #6:</div></td>
                  <td valign="middle" height="14"><div align="left">
                      <input name="txt_carac6" value="<?php echo $rs->fields["carac6"]?>" type="text" id="txt_carac6"  title="Caracter&iacute;stica" size="50">
                  </div></td>
                </tr>
                <?php 
				/*if($rs->fields["id_articulo"]!="1")
				{ 
				$sql_n_variedad = "select * from n_articulo where id_articulo='".$rs->fields["id_articulo"]."'";		
				$rs_n_variedad = $db->Execute($sql_n_variedad) or die($db->ErrorMsg()) ;
				$carac1=$rs_n_variedad->Fields('carac1');
				$carac2=$rs_n_variedad->Fields('carac2');
				$carac3=$rs_n_variedad->Fields('carac3');
				$carac4=$rs_n_variedad->Fields('carac4');
				$carac5=$rs_n_variedad->Fields('carac5');
				$carac6=$rs_n_variedad->Fields('carac6');
				$carac7=$rs_n_variedad->Fields('carac7');
				$carac8=$rs_n_variedad->Fields('carac8');
				$carac9=$rs_n_variedad->Fields('carac9');
				$carac10=$rs_n_variedad->Fields('carac10');
				$carac11=$rs_n_variedad->Fields('carac11');
				$carac12=$rs_n_variedad->Fields('carac12');
				$carac13=$rs_n_variedad->Fields('carac13');
				$carac14=$rs_n_variedad->Fields('carac14');
				$carac15=$rs_n_variedad->Fields('carac15');
				
				
				}	
				
				
				if($rs->fields["ide_articulo"]!="1")
				{
				$sql_n_variedad = "select * from e_articulo where ide_articulo='".$rs->fields["ide_articulo"]."'";		//print $sql_n_variedad;
				$rs_n_variedad = $db->Execute($sql_n_variedad)or die($db->ErrorMsg()) ;
				$carac1=$rs_n_variedad->Fields('ecarac1');
				$carac2=$rs_n_variedad->Fields('ecarac2');
				$carac3=$rs_n_variedad->Fields('ecarac3');
				$carac4=$rs_n_variedad->Fields('ecarac4');
				$carac5=$rs_n_variedad->Fields('ecarac5');
				$carac6=$rs_n_variedad->Fields('ecarac6');
				$carac7=$rs_n_variedad->Fields('ecarac7');
				$carac8=$rs_n_variedad->Fields('ecarac8');
				$carac9=$rs_n_variedad->Fields('ecarac9');
				$carac10=$rs_n_variedad->Fields('ecarac10');
				$carac11=$rs_n_variedad->Fields('ecarac11');
				$carac12=$rs_n_variedad->Fields('ecarac12');
				$carac13=$rs_n_variedad->Fields('ecarac13');
				$carac14=$rs_n_variedad->Fields('ecarac14');
				$carac15=$rs_n_variedad->Fields('ecarac15');
				}			
					
				 if($carac1){?>
                <tr> 
                  <td height="14">&nbsp;</td>
                  <td valign="middle" height="14">&nbsp;</td>
                </tr>
                <?php } if($carac2){?>
                <?php } if($carac3){?>
                <?php } if($carac4){?>
                <?php } if($carac5){?>
                <?php } if($carac6){?>
                <?php } if($carac7){?>
                <?php } if($carac8){?>
                <?php } if($carac9){?>
                <?php } if($carac10){?>
               <?php } if($carac11){?>
                <?php } if($carac12){?>
                <?php } if($carac13){?>
                <?php } if($carac14){?>
                <?php } if($carac15){?>
                 <?php } */?>
                <tr>
                  <td height="20"><div align="right">Foto:</div></td>
                  <td valign="middle" height="20"><label>
                    <input type="file" name="file2" id="file2">
                  </label></td>
                </tr>
                <tr>
                  <td height="20"><div align="right">Foto:</div></td>
                  <td valign="middle" height="20"><label>
                    <input type="file" name="file1" id="file1">
                  </label></td>
                </tr>
                <tr>
                  <td height="20"><div align="right">Foto:</div></td>
                  <td valign="middle" height="20"><label>
                    <input type="file" name="file" id="file">
                  </label></td>
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
              <p>&nbsp;</p>
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
