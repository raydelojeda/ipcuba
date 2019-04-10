<?php 
$x="../../";
session_start();
require_once($x."adodb/adodb.inc.php");
require_once($x."coneccion/conn.php");
include($x."php/session/session_autor.php");

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_var_estab_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg();
$fecha_base = $rs_var_estab_fecha->Fields('max');
//---------------------------------------------------

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

if ($_GET["sel_mes"]!="") $sel_mes = $_GET['sel_mes'];
if (isset($_POST["sel_mes"])) $sel_mes = $_POST['sel_mes'];

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
                        <td width="7%" height="50" valign="middle"  class="us"><img src="../../imagenes/admin/restoredb.png" alt="" width="48" height="48" border="0"><strong><font color="#000000" size="1"> </font></strong></td>
                        <td width="85%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Imputaci&oacute;n de precios para un mes.</font></strong></td>
                        <td width="8%"><div align="center"> <a class="toolbar" href="imputacion.php?&sel_mes=<?php print $_POST['sel_mes'];?>&sel_ano=<?php print $_POST['sel_ano'];?>"  ><img name="ver" src="../../imagenes/admin/restore_f2.png" alt="Imputar" width="32" height="32" border="0">
                          Imputar</a> </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <br>
                <table  class="tabla" width="38%" align="center">
                  <?php $rbt_cuatri=$_POST['rbt_cuatri'];//print $rbt_cuatri;
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
                  <?php if($_SESSION["rol"]=="admin" || $_SESSION["rol"]=="super" || $rol=="edito"){?>
	     		<?php }?>
                  <tr>
                    <td height="14" align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="37%" height="22" align="right">A&ntilde;o:</td>
                    <td width="63%"><div align="left">
                      <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                              <option value="0">------</option>
                              <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){
							  if($anno-$i>=2011)
							  {
							  
							  ?>
                              <option <?php if($sel_ano==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                              <?php }}?>
                            </select>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="22" align="right">Mes:</td>
                    <td><select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                      <option value="0">---------------</option>
                      <option <?php if($sel_mes=="01")print "selected";?> value="01">Enero</option>
                      <option <?php if($sel_mes=="02")print "selected";?> value="02">Febrero</option>
                      <option <?php if($sel_mes=="03")print "selected";?> value="03">Marzo</option>
                      <option <?php if($sel_mes=="04")print "selected";?> value="04">Abril</option>
                      <option <?php if($sel_mes=="05")print "selected";?> value="05">Mayo</option>
                      <option <?php if($sel_mes=="06")print "selected";?> value="06">Junio</option>
                      <option <?php if($sel_mes=="07")print "selected";?> value="07">Julio</option>
                      <option <?php if($sel_mes=="08")print "selected";?> value="08">Agosto</option>
                      <option <?php if($sel_mes=="09")print "selected";?> value="09">Septiembre</option>
                      <option <?php if($sel_mes=="10")print "selected";?> value="10">Octubre</option>
                      <option <?php if($sel_mes=="11")print "selected";?> value="11">Noviembre</option>
                      <option <?php if($sel_mes=="12")print "selected";?> value="12">Diciembre</option>
                    </select></td>
                  </tr>
                  

                  <tr align="center">
                    <td colspan="2"><div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                        <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script>
                      &nbsp;</td>
                  </tr>
                  <tr>
                    <td height="6" colspan="2" align="right">&nbsp;</td>
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
