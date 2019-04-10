<?php
$x="../../../";
$tabla="b_subclase";
$campo="idb_subclase";
$location="l_bsubclase.php";
include($x."php/modificar.php");
include($x."php/session/session_super.php");
	//print $rs->fields["id"];
	$mensaje = "";
	if (isset($_POST['txt_pond_r']))
	{
	    $magic_quotes = get_magic_quotes_gpc();	
	
	$sel_cod_art = $rs->fields["ide_subclase"];
	$sel_mercado = $rs->fields["id_mercado_nuevo"];	
		
	$txt_pond_r= $db->qstr($_POST['txt_pond_r'], $magic_quotes);
	$txt_fecha = $db->qstr($_POST['txt_fecha'], $magic_quotes);
	//print $sel_cod_art;print $sel_mercado;print $txt_valor;
	
	if($txt_pond_r!='') 
	{	
				
 				$sql_upd_art = "UPDATE b_subclase SET  r_peso =$txt_pond_r WHERE ide_subclase = $sel_cod_art and id_mercado_nuevo = $sel_mercado";//print $sql_upd_art;
				$rs=$db->Execute($sql_upd_art) or die($db->ErrorMsg());
				if($rs)	
				header("Location: l_bsubclase.php?curr_page=".$curr_page."&regis_cant=".$regis_cant."");
				else
				$mensaje= "ERROR. No se pudo modificar en la BD.";
		
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
          <script language="javascript"  >
		  setTimeout("document.frm.txt_pond_r.focus()",1);	
		</script> 
		    <form name="frm"  id="frm" method="post" action="" onSubmit="MM_validateForm('txt_pond_g','','RisNum','txt_pond_r','','RisNum');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/folder_green.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Pesos por subclase y moneda:<font size="2">Modificar</font></font></strong> 
                        <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <label>Guardar</label>
                            </a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="l_bsubclase.php?curr_page= <?php print $current_page."&regis_cant=".$regis_cant;?>"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/m_bsubclase.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <p>&nbsp;</p>     
              <table width="70%"  align="center"  class="tabla">
                <tr> 
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td width="38%" align="right">
                    Subclase:</td>
                  <td width="62%"> 
                    <div align="left">
                      <?php 
                     				$tabla=e_subclase;
									$campo=ide_subclase;
									$valor=$rs->fields["ide_subclase"];
									include($x."php/listar_simple.php");
									echo $rs_simple->fields["cod_subclase"].". ".$rs_simple->fields["subclase"];
								    ?>
                    </div></td>
                </tr>
                <tr> 
                  <td height="22" align="right">Moneda:</td>
                  <td> 
                    <div align="left">
                      <?php 
                     				$tabla=n_mercado;
									$campo=id_mercado_nuevo;
									$valor=$rs->fields["id_mercado_nuevo"];
									include($x."php/listar_simple.php");
									echo $rs_simple->fields["mercado_nuevo"];
								    ?>
                    </div></td>
                </tr>
                
                <tr>
                  <td height="19" align="right">Peso respecto al rubro:</td>
                  <td><div align="left">
                      <input  name="txt_pond_r" type="text" title="Peso" value="<?php print $rs->fields["r_peso"]?>"   id="txt_pond_r">
                    (*)</div></td>
                </tr>
                
                <tr align="center"> 
                  <td align="right">Fecha:</td>
                  <td align="left"><div align="left">
                    <input  name="txt_fecha" type="text"   id="txt_fecha" title="Fecha"  onClick="javascript:showCal('Calendar1')" onKeyPress="window.event.keyCode=0;javascript:showCal('Calendar1')" value="<?php echo $rs->fields["fecha"];?>"    size="10" maxlength="10" tabindex="1"> 
                    <strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">(*)</font></strong> 
                    yyyy-mm-dd </div></td>
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
            <p>&nbsp;</p></form>
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
