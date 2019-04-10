<?php
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------


$mensaje="";
if(isset($_POST['txt_fecha']))
{	
	$magic_quotes = get_magic_quotes_gpc();	
	
	$sel_cod_var = $db->qstr($_POST['sel_variedad'], $magic_quotes);
	$sel_mercado = $db->qstr($_POST['sel_mercado'], $magic_quotes);
	
	$txt_fecha = $db->qstr($_POST['txt_fecha'], $magic_quotes);

	//print $rbt_central;
	
	if($sel_cod_var!='' && $sel_mercado!='' &&  $txt_fecha!='') 
	{	
		//---------------------------------------------------
		$query = " where id_mercado = $sel_mercado and id_variedad = $sel_cod_var and fecha=$txt_fecha "; 
		$sql = "select idb_variedad from b_variedad".$query;		
		$rs = $db->Execute($sql)or $mensaje=$db->ErrorMsg() ;
		//---------------------------------------------------		
			if($rs->Fields(0)=="")
			{//print "max".$txt_precio_max;print " min".$txt_precio_min;print " pre".$txt_precio;
			//print $txt_precio_max.">=".$txt_precio_min. "&&" .$txt_precio_max.">=".$txt_precio. "&&" .$txt_precio.">=".$txt_precio_min;
					
 				 $sql="INSERT INTO b_variedad (id_mercado,id_variedad,fecha) 
				 VALUES ($sel_mercado,$sel_cod_var,$txt_fecha)";
				 $rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
				//print $sql;
				 $mensaje="Los datos han sido insertados satisfactoriamente.";
				
			}
			else
			$mensaje="Ya existe ese variedad en ese mercado en la canasta básica.";
			
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
               <form action="" method="post" name="frm" onSubmit="MM_validateForm('sel_variedad','','Escoger','sel_mercado','','Escoger','','Escoger','txt_fecha','','R','txt_precio','','RisNum','txt_precio_min','','RisNum','txt_precio_max','','RisNum');return document.MM_returnValue">
              <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="4%" valign="middle"  class="us"><img src="../../../imagenes/admin/news.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td width="71%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Variedades 
                          del a&ntilde;o base: <font size="2">Insertar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="9%"> 
                          <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label>
                            </a> </div></td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" href="l_bvariedad.php"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="7%"> 
                          <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/n_variedad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
              <br>
            
              <table  class="tabla" width="99%" align="center">
                <tr> 
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td width="33%" align="right"> 
                    Variedad:</td>
                  <td width="67%"> 
                    <div align="left">
                      <select name="sel_variedad" title="variedad" id="sel_variedad" >
                        <option value="0">-----------------------</option>
                        <?php 
                     				$tabla=n_variedad;
									$campo0="";
									$campo1="variedad";//cod_var
									$value=id_variedad;
									include($x."php/select.php");
								    ?>
                      </select>
                      (*) </font></strong></div></td>
                </tr>
                <tr> 
                  <td height="20" align="right">Mercado:</td>
                  <td><div align="left">
                      <select name="sel_mercado" title="Mercado" id="sel_mercado" >
                        <option value="0">-----------------------</option>
                        <?php 
									$x="../../../";
                     				$tabla=n_mercado;
									$campo0=mercado;
									$campo1="";
									$value=id_mercado;
									include("../../../php/select.php");
								    ?>
                      </select>
                      (*) </font></strong></div></td>
                </tr>
                
                <tr align="center"> 
                  <td align="right">Fecha:</td>
                  <td align="left"><div align="left">
                    <input  name="txt_fecha" value="<?php if($fecha_base)print $fecha_base; else echo $_POST['txt_fecha'];?>" type="text" title="Fecha"   id="txt_fecha"  onClick="javascript:showCal('Calendar1')" onKeyPress="window.event.keyCode=0;javascript:showCal('Calendar1')"    size="10" maxlength="10"> 
                    <strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">(*)</font></strong> 
                    yyyy-mm-dd </div></td>
                </tr>
                <tr> 
                  <td height="19" colspan="2" align="right"><strong></strong><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                    </font></strong>
                    <div id="id_msg" style="display:block"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                      <div align="center"><?php echo $mensaje;?></div>
                      </font></strong>
                      <div align="left"></div>
                    </div>
                    <strong>
                    <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",5000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				    </script>                    </td>
                </tr>
                <tr align="center"> 
                  <td height="14" colspan="2"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">(*)</font></strong> 
                    Campo requerido</td>
                </tr>
                <tr align="center"> 
                  <td colspan="2"></td>
                </tr>
                <tr> 
                  <td height="14" colspan="2" align="right">&nbsp; </td>
                </tr>
              </table>
              <br>
		    </form >
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
