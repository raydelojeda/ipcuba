<?php
$x="../../../";
$tabla="n_var_estab";
$campo="id_var_estab";
$location="l_var_estab.php";
include($x."php/modificar.php");
include($x."php/session/session_autor.php");
$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-4","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);

	//print $rs->fields["id"];
	$mensaje = "";
	
if ($_GET["cerrar"]!="")
{$cerrar=$_GET["cerrar"];}
	
	
if ($_GET["var_aux_mod"]!="")
{	
	$query = " where id_var_estab = '".$_GET["var_aux_mod"]."'
	and b_variedad.id_mercado=n_mercado.id_mercado and 
	b_variedad.id_variedad=n_variedad.id_variedad and 
	n_estab.id_estab=n_var_estab.id_estab and 
	b_variedad.idb_variedad=n_var_estab.idb_variedad 
	and n_unidad.id_unidad=n_var_estab.id_unidad"; 
}
if ($_POST["var_aux_mod"]!="")
{	
	$query = " where id_var_estab = '".$_POST["var_aux_mod"]."' 
	and b_variedad.id_mercado=n_mercado.id_mercado and 
	b_variedad.id_variedad=n_variedad.id_variedad and 
	n_estab.id_estab=n_var_estab.id_estab and 
	b_variedad.idb_variedad=n_var_estab.idb_variedad"; 
}

$sql = "select * from n_var_estab,b_variedad,n_mercado, n_variedad, n_estab,n_unidad".$query;
//print $sql;
$rs = $db->Execute($sql);
$idb_variedad=$rs->fields["idb_variedad"];
$id_mercado=$rs->fields["id_mercado"];
$fecha_base = $rs->Fields('fecha');
$id_estab=$rs->fields["id_estab"];


$carac1=$rs->Fields('carac1');
$carac2=$rs->Fields('carac2');
$carac3=$rs->Fields('carac3');
$carac4=$rs->Fields('carac4');
$carac5=$rs->Fields('carac5');

if(isset($_POST['var_id']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	
	$txt_cantidad = $_POST['txt_cantidad'];
	$sel_unidad = $_POST['sel_unidad'];
	//$txt_cantidad = $db->qstr($_POST['txt_cantidad'], $magic_quotes);
	if($sel_unidad=="")
	$sel_unidad=$rs->fields["id_unidad"];//print $sel_unidad;}
	if($txt_cantidad=="")
	$txt_cantidad=$rs->fields["cantidad"];
	/*$txt_carac_m1 = $db->qstr($_POST['txt_carac_m1'], $magic_quotes);
	$txt_carac_m2 = $db->qstr($_POST['txt_carac_m2'], $magic_quotes);
	$txt_carac_m3 = $db->qstr($_POST['txt_carac_m3'], $magic_quotes);
	$txt_carac_m4 = $db->qstr($_POST['txt_carac_m4'], $magic_quotes);
	$txt_carac_m5 = $db->qstr($_POST['txt_carac_m5'], $magic_quotes);*/
	$txt_valor1 = $_POST['txt_valor1'];
	$txt_valor2 = $_POST['txt_valor2'];
	$txt_valor3 = $_POST['txt_valor3'];
	$txt_valor4 = $_POST['txt_valor4'];
	$txt_valor5 = $_POST['txt_valor5'];
	$txt_valor6 = $_POST['txt_valor6'];
	
	
	if($txt_valor1=="")
	{$txt_valor1=$rs->Fields("valor1");}//print $txt_valor1;
	
	if($txt_valor2=="")
	$txt_valor2=$rs->fields["valor2"];
	
	if($txt_valor3=="")
	$txt_valor3=$rs->fields["valor3"];
	
	if($txt_valor4=="")
	$txt_valor4=$rs->fields["valor4"];
	
	if($txt_valor5=="")
	$txt_valor5=$rs->fields["valor5"];
	
	if($txt_valor6=="")
	$txt_valor6=$rs->fields["valor6"];
	
		     
	  //if($txtNombre=="" || $txtEdad=="" || $txtDesc=="" || $txtSalario=="" || $Roll == "" || $Roll == "--- Elegir ---" || $txtEmail == "")
	  //$mensaje= "Llene todos los campos.";
	 // else
	//  {
		
	$sql = "UPDATE n_var_estab SET cantidad='$txt_cantidad',id_unidad='$sel_unidad',
	valor1='$txt_valor1', valor2='$txt_valor2', valor3='$txt_valor3', 
	valor4='$txt_valor4', valor5='$txt_valor5', valor6='$txt_valor6'
	WHERE id_var_estab = '".$_POST["var_id"]."'";
	//print $sql;
	$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
	
	
	$sql = "UPDATE n_var_estab SET cantidad='$txt_cantidad',id_unidad='$sel_unidad',
	valor1='$txt_valor1', valor2='$txt_valor2', valor3='$txt_valor3', 
	valor4='$txt_valor4', valor5='$txt_valor5', valor6='$txt_valor6'
	WHERE id_estab = '".$id_estab."' and idb_variedad = '".$idb_variedad."'";
	//print $sql;
	$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
	
	
	//print $rs;
	if($rs)
	{
	
	if($rs)
		{
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
		}
		
		if($cerrar==1)
		{
		?>
		<script language="JavaScript">
		window.close();//alert("sdfdsf");
		</script>
		<?php
		}
		else	
		header("Location: l_var_estab_m.php?curr_page=".$curr_page."&regis_cant=".$regis_cant."");
	//$mensaje= "Se modificó satisfactoriamente en la BD.";
	}
	else
	$mensaje= "ERROR. No se pudo modificar en la BD.";
	}
	//}
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
            <form name="frm"  id="frm" method="post" action="" onSubmit="MM_validateForm('sel_unidad','','Escoger','txt_cantidad','','RisNum');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/demo.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                  </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de especificaciones: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                    <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="l_var_estab_m.php"> 
                    <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0">
                    <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/m_var_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                    <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <br>     
              <table width="70%"  align="center"  class="tabla">
                <tr> 
                  <td height="17" colspan="3">&nbsp; </td>
                </tr>
                
                <tr> 
                  <td width="35%" height="19"> <div align="right">Variedad:</div></td>
                  <td width="65%"><div align="left">
				  <input name="txt_cod_var" type="text"  disabled id="txt_cod_var" title="Código Variedad" value="<?php print $rs->Fields("ecod_var").". ".$rs->Fields("variedad");//print $query_txt;?>" size="35">
				 
                      </div></td>
                </tr>
                <tr> 
                  <td height="19"> <div align="right">Establecimiento:</div></td>
                  <td><div align="left">
                    <input name="txt_estab" type="text"  disabled id="txt_estab" title="C&oacute;digo Establecimiento"
                        value="<?php print $rs->Fields("cod_estab").". ".$rs->Fields("estab");//print $query_txt;?>" size="35"></div></td>
                </tr>
                
                
                
                <tr>
                  <td height="19" align="right">D&iacute;a a captar:</td>
                  <td align="left"><div align="left">
                    <select name="txt_fecha" disabled>
                      <?php for ($k=0;$k<28;$k++){?>
                      <option value="<?php print $k+1;?>" <?php if($k==substr($rs->fields["fecha_captar"],8,2)-1)print "selected";?>><?php echo $array2[$k];?></option>
                      <?php }?>
                    </select>
                    &nbsp;</div></td>
                </tr>
                
                <tr>
                  <td height="19" align="right">Unidad de medida:</td>
                  <td align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <select name="sel_unidad" <?php if($rs->fields["id_unidad"]!=22) print "disabled";?> title="Unidad de Medida" id="sel_unidad" >
                      
                      <?php 
                     				$tabla=n_unidad;
									$campo0=unidad;
									$campo1="";									
									$campo_id=id_unidad;
									$id=$rs->fields["id_unidad"];
									include($x."php/selected.php");
								    ?>
                    </select>
                  </font></strong></td>
                </tr>
                <tr>
                  <td height="19" align="right">Cantidad:</td>
                  <td align="left"><input name="txt_cantidad" <?php if($rs->fields["cantidad"]!="") print "disabled";?> type="text"   id="txt_cantidad" title="Cantidad"value="<?php print $rs->Fields("cantidad");//print $query_txt;?>" ></td>
                </tr>
                <?php if($carac1!=""){?>
                <tr>
                  <td height="19"><div align="right"><?php print $carac1;?>:</div></td>
                  <td align="left"><input name="txt_valor1" type="text"   id="txt_valor1" title="Valor 1"
                        value="<?php print $rs->Fields("valor1");?>" size="50" maxlength="50" <?php if($rs->fields["valor1"]!="") print "disabled";?>></td>
                </tr>
                <?php }if($carac2!=""){?>
                <tr>
                  <td height="19"><div align="right"><?php print $carac2;?>:</div></td>
                  <td align="left"><input name="txt_valor2" type="text"   id="txt_valor2" title="Valor 2"
                        value="<?php print $rs->Fields("valor2");?>" size="50" maxlength="50" <?php if($rs->fields["valor2"]!="") print "disabled";?>></td>
                </tr>
                <?php }if($carac3!=""){?>
                <tr>
                  <td height="19"><div align="right"><?php print $carac3;?>:</div></td>
                  <td align="left"><input name="txt_valor3" type="text"   id="txt_valor3" title="Valor 3"
                        value="<?php print $rs->Fields("valor3");?>" size="50" maxlength="50" <?php if($rs->fields["valor3"]!="") print "disabled";?>></td>
                </tr>
                <?php }if($carac4!=""){?>
                <tr>
                  <td height="19"><div align="right"><?php print $carac4;?>:</div></td>
                  <td align="left"><input name="txt_valor4" type="text"   id="txt_valor4" title="Valor 4"
                        value="<?php print $rs->Fields("valor4");?>" size="50" maxlength="50" <?php if($rs->fields["valor4"]!="") print "disabled";?>></td>
                </tr>
                <?php }if($carac5!=""){?>
                <tr>
                  <td height="19"><div align="right"><?php print $carac5;?>:</div></td>
                  <td align="left"><input name="txt_valor5" type="text"   id="txt_valor5" title="Valor 5"
                        value="<?php print $rs->Fields("valor5");?>" size="50" maxlength="50" <?php if($rs->fields["valor5"]!="") print "disabled";?>></td>
                </tr>
                <?php }if($carac6!=""){?>
               <tr>
                  <td height="19"><div align="right"><?php print $carac6;?>:</div></td>
                  <td align="left"><input name="txt_valor6" type="text"   id="txt_valor6" title="Valor 6"
                        value="<?php print $rs->Fields("valor6");?>" size="50" maxlength="50" <?php if($rs->fields["valor6"]!="") print "disabled";?>></td>
                </tr>
				<?php }?>
               <tr>
                 <td height="19">&nbsp;</td>
                 <td align="left">&nbsp;</td>
               </tr>
                
              </table>
             <br> 
                <input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_var_estab"];?>">
                <?php if ($mensaje) print $mensaje; ?>
              
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
