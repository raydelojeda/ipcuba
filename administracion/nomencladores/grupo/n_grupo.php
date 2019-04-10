<?php
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");


$mensaje="";
if(isset($_POST['txt_cod_grupo']))
{

	$magic_quotes = get_magic_quotes_gpc();
	$sel_division =$db->qstr($_POST['sel_division'], $magic_quotes);
	$txt_cod_grupo = $db->qstr($_POST['txt_cod_grupo'], $magic_quotes);
	$txt_grupo = $db->qstr($_POST['txt_grupo'], $magic_quotes);
	
	
	if($_POST['txt_cod_grupo']!='' && $_POST['txt_grupo']!='' && $_POST['sel_grupo']!='0') 
	{
	  //print $txt_cod_division; print $txt_division;print $sel_capitulo;
		//---------------------------------------------------
		$tabla="n_grupo";
		$campo="cod_grupo";
		$valor=$txt_cod_grupo;		
		include("../../../php/insertar.php");
		//---------------------------------------------------
		if($rs->Fields(0)=='')
		{
			
			//---------------------------------------------------
			$tabla="n_grupo";
			$campo="grupo";
			$valor=$txt_grupo;		
			include("../../../php/insertar.php");
			//---------------------------------------------------
			if($rs->Fields(0)=='')
			{
				//-----------------------------------------------------------seccion para capturar el combobox---------------------------
 /*				$tabla="n_division";
				$campo="grupo";
				$valor=$sel_division;//print $valor;		
				include("../../../php/listar_simple.php");//print $query;			
				if($rs->Fields('id_capitulo')!='')
				
				//-----------------------------------------------------------seccion para capturar el combobox---------------------------
			 	{
			 	 $id=$rs->Fields('id_division');//print $id;		
			 */
				 $sql="INSERT INTO n_grupo (cod_grupo,grupo,id_division) VALUES ($txt_cod_grupo,$txt_grupo,$sel_division)";
//print $sql;
				 $rs=$db->Execute($sql) or $die=$db->ErrorMsg() ;//print "Ya existe la persona en la Base de Datos."
  	  
				 $mensaje="El grupo ha sido insertada satisfactoriamente.";
			//	}
			}			
			 else
			 $mensaje="Ya existe un grupo en la BD.";
		}
		else
		$mensaje="Ya existe un código de grupo en la BD.";
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
            <form  method="post" id="frm"  action="" name="frm" onSubmit="MM_validateForm('sel_division','','Escoger','txt_cod_grupo','','R','txt_grupo','','RLetras');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          del grupo: <font size="2">Insertar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%"> <div align="center"> <a class="toolbar" href="l_grupo.php"> 
                            <img name="imageField2" src="../../../imagenes/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/n_división.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table> <p>&nbsp;</p>
              <table width="710" align="center" class="tabla">
                <tr>
                  <td width="147">&nbsp;</td>
                  <td width="530">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">Divisi&oacute;n:</td>
                  <td><div align="left">
                    <select name="sel_division" title="Divisi&oacute;n" id="sel_division" >
                      <option value="0" selected>----------------------------</option>
                      <?php 
                     				$x="../../../";
									$tabla=n_division;
									$campo0=division;
									$campo1=cod_division;
									$value=id_division;
									include("../../../php/select.php");
								    ?>
                    </select>
                  </div></td>
                </tr>
                <tr >
                  <td align="right"><div align="right"> C&oacute;digo del 
                    grupo:</div></td>
                  <td><div align="left">
                      <input name="txt_cod_grupo"  type="text" id="txt_cod_cap"  title="C&oacute;digo del grupo" size="50">
                  </div></td>
                </tr>
                <tr align="center" >
                  <td height="14"><div align="right">Grupo:</div></td>
                  <td height="14"><div align="left">
                      <input name="txt_grupo"  type="text" id="txt_grupo"  title="Grupo" size="50">
                  </div></td>
                </tr>
                <tr align="center" >
                  <td height="37" colspan="2"><div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                      <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script>
                    &nbsp;</td>
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
