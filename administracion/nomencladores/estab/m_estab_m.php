<?php
$x="../../../";
$tabla="n_estab";
$campo="id_estab";
$location="l_estab.php";
include($x."php/modificar.php");
include($x."php/session/session_autor.php");

$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$cod_dpa=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$rol=$rs_usuario->Fields("rol");

$mensaje = "";

if ($_GET["var_aux_mod"]!="")
{	
$query = " where id_estab= '".$_GET["var_aux_mod"]."'and n_estab.id_mercado=n_mercado.id_mercado and n_estab.id_tipologia=n_tipologia.id_tipologia and n_estab.cod_dpa=n_dpa.cod_dpa"; 
}
if ($_POST["var_aux_mod"]!="")
{	
$query = " where id_estab = '".$_POST["var_aux_mod"]."'and n_estab.id_mercado=n_mercado.id_mercadoand n_estab.id_tipologia=n_tipologia.id_tipologia and n_estab.cod_dpa=n_dpa.cod_dpa"; 
}
$sql = "select estab, n_tipologia.id_tipologia, tipologia, cod_estab,n_mercado.id_mercado, mercado ,n_dpa.cod_dpa,dir, org_sup
from n_estab,n_mercado,n_tipologia,n_dpa".$query;
 //print $sql;

	
if (isset($_POST['txt_contacto']))	
{	
	$txt_contacto=$_POST["txt_contacto"];	 
		 
	$sql = "UPDATE n_estab SET  contacto = '$txt_contacto' WHERE id_estab = '".$_POST["var_id"]."'";
	$rs = $db->Execute($sql) or $mensaje=$db->ErrorMsg();//print $sql;
	//print $rs;
	if($rs)
	{
		$gestor = @fopen("c:\wamp\datos.txt", "a");
		 if ($gestor) 
		 {
								   
		  if (fwrite($gestor, $sql.";\r\n") === FALSE) 
			{
			echo "No se puede escribir al archivo.";
			exit;
			}
			fclose($gestor);
		 }
		header("Location: l_estab_m.php?curr_page=".$curr_page."&regis_cant=".$regis_cant."");
	}
	else
	$mensaje="No se puede modificar el establecimiento.";
	
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
            <form name="frm"  id="frm" method="post" action="" onSubmit="MM_validateForm('txt_dir','','R','txt_estab','','R');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/frontpage.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                  </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de establecimiento: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                    <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="../estab/l_estab.php"> 
                    <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0">
                    <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/m_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                    <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <p>&nbsp;</p>     
              <table width="80%" height="261" align="center"  class="tabla">
                
                <tr>
                  <td height="19">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td width="39%" height="20"> 
<div align="right">Mercado:</div></td>
                  <td width="61%"> <div align="left"> <strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      <select name="sel_mercado" disabled title="Mercado" id="sel_mercado">
                        <option value="0">-----------------------</option>
                        <?php 
                                    $tabla=n_mercado;
									$campo1=id_mercado;
									$campo0=mercado;
									$campo_id=id_mercado;
									$id=$rs->fields["id_mercado"];
									include($x."php/selected.php");
								    ?>
							</select>
							
                      </font></strong> </div></td>
                </tr>
                <tr> 
                  <td height="20">
<div align="right">Tipolog&iacute;a:</div></td>
                  <td><div align="left">
                      <select name="sel_tipologia"disabled title="Tipologia" id="sel_tipologia">
                        <option value="0">-----------------------</option>
                        <?php 
						     	    $tabla=n_tipologia;
									$campo1=id_tipologia_nueva;
									$campo0=tipologia;
									$campo_id=id_tipologia;
									$id=$rs->fields["id_tipologia"];
									include($x."php/selected.php");
									?>  
                      </select>
                       </div></td>
                </tr>
                <tr> 
                  <td height="20">
<div align="right">C&oacute;digo DPA:</div></td>
                  <td><div align="left">
                      <select name="sel_cod_dpa"disabled title="Código DPA" id="sel_cod_dpa">
                        <option value="0">-----------------------</option>
                        <?php 
                     				$tabla="n_dpa where incluido='1'";	
									$campo1=cod_dpa;								
									$campo0=prov_mun;
									$campo_id=cod_dpa;
									$id=$rs->fields["cod_dpa"];
									//if($rol=="aut_p")	
									//include($x."php/selected2.php");
									//else
									include($x."php/selected.php");
								?>
                      </select>
                  </div></td>
                </tr>
                
                 <?php 
				/*print $_POST['sel_cod_dpa'];
					print $_POST['sel_mercado'];
					print $_POST['sel_tipologia']."dfe";*/
				
				 ?>
                
                
                <tr> 
                  <td height="19"> 
<div align="right">C&oacute;digo de establecimiento:</div></td>
                  <td><div align="left"> 
                      <?php echo $rs->fields["cod_estab"];?>
                    <input name="txt_cod_estab"disabled value="<?php print $cod;?>" class="combo" title="Código establecimiento"  type="hidden" id="txt_cod_estab" >
                    </div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Direcci&oacute;n:</td>
                  <td><div align="left">
                      <input name="txt_dir" class="combo"disabled title="Dirección" type="text" id="txt_dir" value="<?php echo $rs->fields["dir"]; ?>">
                      </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Organismo superior:</td>
                  <td align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <select name="sel_org"disabled title="Organismo al que pertenece" id="sel_org" >
                      <option value="0">-----------------------</option>
                      <option value="CIMEX">CIMEX</option>
                      <option value="TRD">TRD</option>
                      <option value="Havaguanex">Havaguanex</option>
                      <option value="Caracol">Caracol</option>
                      <option value="MINAGRI">MINAGRI</option>
                      <option value="Palmares">Palmares</option>
                      <option value="P. Popular">P. Popular</option>
                      <option value="TRIMAGEN">TRIMAGEN</option>
                      <option value="Islazul">Islazul</option>
                      <option value="EPESE">EPESE</option>
                      <option value="Copextel">Copextel</option>
                      <option value="Artex">Artex</option>
                      <option value="Otros">Otros</option>
                    </select>
                  </font></strong></td>
                </tr>
                <tr>
                  <td height="19" align="right">Persona de contacto:</td>
                  <td align="left"><input   name="txt_contacto" class="combo"  title="Persona de contacto" type="text"  id="txt_contacto" value="<?php echo $rs->fields["contacto"];?>"></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Establecimiento: 
<div align="right"></div></td>
                  <td align="left"><div align="left"> 
                      <input   name="txt_estab" class="combo" disabled title="Establecimiento" type="text"  id="txt_estab" value="<?php echo $rs->fields["estab"]; ?>" >
                    </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" colspan="2" align="right"><div align="center">C&oacute;digo del Establecimiento=C&oacute;digo DPA+Mercado+Tipolog&iacute;a+Consecutivo</div></td>
                </tr>
                
                <tr> 
                  <td height="21" colspan="2" align="right"> 
                    <div align="center">
                      <input  type="hidden" name="var_id" value="<?php echo $rs->fields["id_estab"];?>">
                      <?php if ($mensaje) print $mensaje; ?>
                      </div></td>
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
