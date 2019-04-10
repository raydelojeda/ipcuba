<?php 
$x="../../../";
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
           <form method="post" name="frm" id="frm" onSubmit="MM_validateForm('sel_tipologia','','Escoger','sel_cod_dpa','','Escoger');return document.MM_returnValue">
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td height="56" align="right" class="menudottedline"><table width="99%" border="0" class="menubar"  id="toolbar">
                      <tr >
                        <td width="7%" height="50" valign="middle"  class="us"><img src="../../../imagenes/large/lists.gif" alt="" width="48" height="48" border="0"><strong><font color="#000000" size="1"> </font></strong></td>
                        <td width="85%" valign="middle"  class="us"><font color="#5A697E" size="4">Carta para el establecimiento</font></td>
                        <td width="8%"><div align="center"> <a class="toolbar" href="carta.php?tipologia=<?php print $_POST['sel_tipologia'];?>&mercado=<?php print $_POST['sel_mercado'];?>&cod_dpa=<?php print $_POST['sel_cod_dpa'];?>&cbx_listado=<?php print $_POST['cbx_listado'];?>"><img name="ver" src="../../../imagenes/admin/xml.png" alt="Ver formularios" width="32" height="32" border="0">
                          Carta</a> </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <br>
                <table  class="tabla" width="57%" align="center">
                  <tr>
                    <td height="19" colspan="2">&nbsp;</td>
                  </tr>
                  
                 
                 
                  <tr align="center">
                    <td height="16" align="right">DPA:</td>
                    <td align="left"><div align="left">
                       
                        <select name="sel_cod_dpa" title="Código DPA" id="sel_cod_dpa" onChange="document.frm.submit();" >
                          <option value="0">---------CUBA---------</option>
                          <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$_POST['sel_cod_dpa'];
						include($x."php/selected.php");
						?>
                        </select>
                        &nbsp;
                      </div></td>
                  </tr>
                  <tr align="center">
                    <td height="16" align="right">Mercado:</td>
                    <td align="left"><select name="sel_mercado" title="Mercado" onChange="javascript:document.frm.submit();"id="sel_mercado">
                      <option value="0">-----------------------</option>
                      <?php 
								$tabla="n_mercado";
								$campo0=mercado;
								$campo1="";
								$campo_id=id_mercado;
								$id=$_POST['sel_mercado'];
								include($x."php/selected.php");
								?>
                    </select></td>
                  </tr>
                  <tr align="center">
                    <td width="32%" align="right">Tipolog&iacute;a:</td>
                    <td width="68%" align="left"><div align="left">
                      <select name="sel_tipologia" title="Tipología" onChange="javascript:document.frm.submit();"id="sel_tipologia">
                        <option value="0">-----------------------</option>
                        <?php 
						$tabla="n_tipologia,n_estab,n_mercado where n_mercado.id_mercado=n_estab.id_mercado and n_tipologia.id_tipologia=n_estab.id_tipologia";
						
						if($_POST['sel_mercado']!=0)
						{$tabla=$tabla." and n_mercado.id_mercado='".$_POST['sel_mercado']."'";}
						
						if($_POST['sel_cod_dpa']!=0)
						{$tabla=$tabla." and n_estab.cod_dpa='".$_POST['sel_cod_dpa']."'";}
						
						
						
						$campo0=tipologia;
						$campo1="";
						$campo_id=id_tipologia;
						$id=$_POST['sel_tipologia'];
						
						$query_sel = "select distinct tipologia, n_tipologia.id_tipologia from $tabla order by $campo0";
						print $query_sel;
						$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs_selected->RecordCount();
							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs_selected->Fields($campo0);
								$rs_fields1=$rs_selected->Fields($campo1);
								$rs_fields_id=$rs_selected->Fields($campo_id);										 
								echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
								$rs_selected->MoveNext();
							}
						?>
                      </select>
                    </div></td>
                  </tr>
                  <tr align="center">
                    <td height="21" align="right">Solo el listado:</td>
                    <td align="left">
                      <input type="checkbox"<?php if($_POST['cbx_listado']=="on") print "checked";?>  name="cbx_listado" id="cbx_listado" onClick="document.frm.submit();">
                    </td>
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
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
