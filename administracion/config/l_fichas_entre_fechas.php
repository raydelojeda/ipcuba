<?php 
$x="../../";
session_start();
require_once($x."adodb/adodb.inc.php");
require_once($x."coneccion/conn.php");
include($x."php/session/session_autor.php");

//---------------------------------------------------
$sql_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol,id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$sql_usuario;	
//print 	$sql_usuario;
$rs_var_estab_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$id_usuario=$rs_var_estab_usuario->Fields("id_usuario");
$cod_dpa=$rs_var_estab_usuario->Fields("cod_dpa");
$prov_mun=$rs_var_estab_usuario->Fields("prov_mun");
$rol=$rs_var_estab_usuario->Fields("rol");
$cod_dpa2=substr($rs_var_estab_usuario->Fields("cod_dpa"),0,2)."%";


if ($_GET["sel_ano"]!="") $sel_ano = $_GET['sel_ano'];
if (isset($_POST["sel_ano"])) $sel_ano = $_POST['sel_ano'];
if($sel_ano=="")$sel_ano =date("Y");
//print $_POST['rb_dia'];
//----------------------------------------------------------------------------
//print $_POST['sel_cod_dpa'];
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
           <form method="post" name="frm" id="frm" onSubmit="MM_validateForm('sel_tipologia','','Escoger','sel_cod_dpa','','Escoger');return document.MM_returnValue">
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td height="56" align="right" class="menudottedline"><table width="99%" border="0" class="menubar"  id="toolbar">
                      <tr >
                        <td width="7%" height="50" valign="middle"  class="us"><img src="../../imagenes/large/easymoblog.gif" alt="" width="48" height="48" border="0"><strong><font color="#000000" size="1"> </font></strong></td>
                        <td width="85%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Formularios entre fechas
                          <?php if($rol!="admin" && $rol!="edito")echo "de ".$prov_mun; else {?>
                          y provincia.
                          <?php }?>
                        </font></strong></td>
                        <td width="8%"><div align="center"> <a class="toolbar" href="fichas.php?cod_dpa=<?php print $_POST['sel_cod_dpa'];?>&dia1=<?php print $_POST['sel_dia'];?>&dia2=<?php print $_POST['sel_dia2'];?>&sel_ano=<?php print $_POST['sel_ano'];?>&rbt_cuatri=<?php print $_POST['rbt_cuatri'];?>&chx_agro=<?php print $_POST['chx_agro'];?>"  ><img name="ver" src="../../imagenes/large/vcalendar.gif" alt="Ver formularios" width="32" height="32" border="0">
                          Modelo</a> </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <br>
                <table  class="tabla" width="80%" align="center">
                  <tr>
                    <td height="17" colspan="7">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="19"><div align="right">A&ntilde;o:</div></td>
                    <td height="19" colspan="6"><select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                      <option value="0">------</option>
                      <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--)
						  {
							  if($anno-$i>=2011)
							  {
							  
							  ?>
                      <option <?php if($sel_ano==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                      <?php   }					  
					 	  }					  
					  ?>
                      <option <?php if($sel_ano==$anno+1)print "selected";?>><?php print $anno+1;?></option>
                    </select></td>
                  </tr>
                  <?php $rbt_cuatri=$_POST['rbt_cuatri'];//print $rbt_cuatri;
				  $chx_agro=$_POST['chx_agro'];
				  if($rbt_cuatri=="")
				  {
				  $mes=date("m");//print $mes;
				  	if($mes<=04)
					{$rbt_cuatri=2;}
					elseif($mes>04 || $mes<=08)
					{$rbt_cuatri=3;}
					else
					{$rbt_cuatri=1;}
				  }
				  ?>
                  <tr align="center">
                    <td height="19" align="right">Cuatrimestre:</td>
                    <td width="4%" align="left"><div align="right">1ro</div></td>
                    <td width="5%" align="left"><input type="radio" <?php if($rbt_cuatri==1)print "checked";?>  name="rbt_cuatri" id="rbt_cuatri1" value="1"></td>
                    <td width="7%" align="left"><div align="right">2do</div></td>
                    <td width="4%" align="left"><input type="radio" <?php if($rbt_cuatri==2)print "checked";?> name="rbt_cuatri" id="rbt_cuatri2" value="2"></td>
                    <td width="6%" align="left"><div align="right">3ro</div></td>
                    <td width="49%" align="left"><input type="radio" <?php if($rbt_cuatri==3)print "checked";?> name="rbt_cuatri" id="rbt_cuatri3" value="3"></td>
                  </tr>
                  
                  <?php if($_SESSION["rol"]=="admin" || $_SESSION["rol"]=="super" || $rol=="edito"){?>
                  
                 
                  <tr align="center">
                    <td width="25%" align="right">DPA:</td>
                    <td colspan="6" align="left"><div align="left">
                      <select name="sel_cod_dpa" title="C&oacute;digo Producto" id="sel_cod_dpa" onChange="javascript:document.frm.submit();">
                        <option value="0">-----------------------</option>
                        <?php 
								$tabla="n_dpa where incluido='". 1 ."'";
								$campo0=prov_mun_nuevo;
								$campo1=cod_dpa_nueva;
								$campo_id=cod_dpa;
								$id=$_POST['sel_cod_dpa'];
								include($x."php/selected.php");
								?>
                      </select>
                    </div></td>
                  </tr>
                  <tr align="center">
                    <td height="20" align="right">No Agromercado:</td>
                    <td colspan="6" align="left"><input type="checkbox" name="chx_agro" onClick="javascript:document.frm.submit();"  <?php if($chx_agro==1)print "checked";?>  value="1" id="chx_agro">
                      <label for="chx_agro"></label></td>
                  </tr>
	     		<?php }?>
                  <tr>
                    <td height="20" align="right">Entre</td>
                    <td colspan="5" align="center"><label>
                      <div align="left">
                        <select name="sel_dia" id="sel_dia" onChange="javascript:document.frm.submit();">
                          <option value="0">------</option>
                          <option value="4" <?php if($_POST['sel_dia']=="4")print "selected";?>>Mi-1</option>
                          <option value="5"<?php if($_POST['sel_dia']=="5")print "selected";?>>J-1</option>
                          <option value="6"<?php if($_POST['sel_dia']=="6")print "selected";?>>V-1</option>
                          <option value="7"<?php if($_POST['sel_dia']=="7")print "selected";?>>S-1</option>
                          
                          <option value="9"<?php if($_POST['sel_dia']=="9")print "selected";?>>L-2</option>
                          <option value="10"<?php if($_POST['sel_dia']=="10")print "selected";?>>Ma-2</option>
                          <option value="11"<?php if($_POST['sel_dia']=="11")print "selected";?>>Mi-2</option>
                          <option value="12"<?php if($_POST['sel_dia']=="12")print "selected";?>>J-2</option>
                          <option value="13"<?php if($_POST['sel_dia']=="13")print "selected";?>>V-2</option>
                          <option value="14"<?php if($_POST['sel_dia']=="14")print "selected";?>>S-2</option>
                          
                          <option value="16"<?php if($_POST['sel_dia']=="16")print "selected";?>>L-3</option>
                          <option value="17"<?php if($_POST['sel_dia']=="17")print "selected";?>>Ma-3</option>
                          <option value="18"<?php if($_POST['sel_dia']=="18")print "selected";?>>Mi-3</option>
                          <option value="19"<?php if($_POST['sel_dia']=="19")print "selected";?>>J-3</option>
                          <option value="20"<?php if($_POST['sel_dia']=="20")print "selected";?>>V-3</option>
                          <option value="21"<?php if($_POST['sel_dia']=="21")print "selected";?>>S-3</option>
                          
                          <option value="23"<?php if($_POST['sel_dia']=="23")print "selected";?>>L-4</option>
                          <option value="24"<?php if($_POST['sel_dia']=="24")print "selected";?>>Ma-4</option>
                          <option value="25"<?php if($_POST['sel_dia']=="25")print "selected";?>>Mi-4</option>
                          <option value="26"<?php if($_POST['sel_dia']=="26")print "selected";?>>J-4</option>
                          <option value="27"<?php if($_POST['sel_dia']=="27")print "selected";?>>V-4</option>
                        </select>
                        </div>
                    </label></td>
                    <td width="49%" align="center"><div align="left">
                      <select name="sel_dia2" id="sel_dia2" onChange="javascript:document.frm.submit();">
                      	  <option value="0">------</option>
                          <option value="4"<?php if($_POST['sel_dia2']=="4")print "selected";?>>Mi-1</option>
                          <option value="5"<?php if($_POST['sel_dia2']=="5")print "selected";?>>J-1</option>
                          <option value="6"<?php if($_POST['sel_dia2']=="6")print "selected";?>>V-1</option>
                          <option value="7"<?php if($_POST['sel_dia2']=="7")print "selected";?>>S-1</option>
                          
                          <option value="9"<?php if($_POST['sel_dia2']=="9")print "selected";?>>L-2</option>
                          <option value="10"<?php if($_POST['sel_dia2']=="10")print "selected";?>>Ma-2</option>
                          <option value="11"<?php if($_POST['sel_dia2']=="11")print "selected";?>>Mi-2</option>
                          <option value="12"<?php if($_POST['sel_dia2']=="12")print "selected";?>>J-2</option>
                          <option value="13"<?php if($_POST['sel_dia2']=="13")print "selected";?>>V-2</option>
                          <option value="14"<?php if($_POST['sel_dia2']=="14")print "selected";?>>S-2</option>
                          
                          <option value="16"<?php if($_POST['sel_dia2']=="16")print "selected";?>>L-3</option>
                          <option value="17"<?php if($_POST['sel_dia2']=="17")print "selected";?>>Ma-3</option>
                          <option value="18"<?php if($_POST['sel_dia2']=="18")print "selected";?>>Mi-3</option>
                          <option value="19"<?php if($_POST['sel_dia2']=="19")print "selected";?>>J-3</option>
                          <option value="20"<?php if($_POST['sel_dia2']=="20")print "selected";?>>V-3</option>
                          <option value="21"<?php if($_POST['sel_dia2']=="21")print "selected";?>>S-3</option>
                          
                          <option value="23"<?php if($_POST['sel_dia2']=="23")print "selected";?>>L-4</option>
                          <option value="24"<?php if($_POST['sel_dia2']=="24")print "selected";?>>Ma-4</option>
                          <option value="25"<?php if($_POST['sel_dia2']=="25")print "selected";?>>Mi-4</option>
                          <option value="26"<?php if($_POST['sel_dia2']=="26")print "selected";?>>J-4</option>
                          <option value="27"<?php if($_POST['sel_dia2']=="27")print "selected";?>>V-4</option>
                      </select>
                    </div></td>
                  </tr>

                  <tr align="center">
                    <td colspan="7"><div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                        <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  
				  dia1=parseFloat(document.frm.sel_dia.value);
				  dia2=parseFloat(document.frm.sel_dia2.value);
				  if(dia1>dia2 && dia1!=0 && dia2!=0)
				  {alert("Error en el intervalo de fechas. La primera fecha debe ser menor que la segunda.");
				  document.frm.sel_dia.value=0;
				  document.frm.sel_dia2.value=0;
				  }			  
				  //alert(document.frm.sel_dia.value);alert(document.frm.sel_dia2.value);				  
				  </script>
                      &nbsp;</td>
                  </tr>
                  <tr>
                    <td height="6" colspan="7" align="right">&nbsp;</td>
                  </tr>
                </table>
               <br>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  
                </p>
              </div>
              </form>
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
