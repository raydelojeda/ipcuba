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
           <form method="post" name="frm" id="frm" onSubmit="MM_validateForm('sel_estab','','Escoger','sel_cod_dpa','','Escoger','sel_art','','Escoger');return document.MM_returnValue">
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td height="56" align="right" class="menudottedline"><table width="99%" border="0" class="menubar"  id="toolbar">
                      <tr >
                        <td width="7%" height="50" valign="middle"  class="us"><img src="../../imagenes/admin/mediamanager.png" alt="" width="48" height="48" border="0"><strong><font color="#000000" size="1"> </font></strong></td>
                        <td width="85%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Precios por variedad entre fechas
                          <?php if($rol!="admin" && $rol!="edito")echo "de ".$prov_mun; else {?>
                          y provincia.
                          <?php }?>
                        </font></strong></td>
                        <td width="8%"><div align="center"> <a class="toolbar" href="g_precios_x_var.php?id_estab=<?php print $_POST['sel_estab'];?>&id_var=<?php print $_POST['sel_var'];?>&dia1=<?php print $_POST['txt_fecha'];?>&dia2=<?php print $_POST['txt_fecha2'];?>"  ><img name="ver" src="../../imagenes/admin/html_f2.png" alt="Ver formularios" width="32" height="32" border="0">
                          Gráfica</a> </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <br>
                <table  class="tabla" width="96%" align="center">
                  <tr>
                    <td height="17" colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="22%" height="20" align="right">Entre:</td>
                    <td width="12%" align="center"><div align="left">
                      <input name="txt_fecha" type="text" class="combo"  id="txt_fecha"  value="<?php print $_POST['txt_fecha'];?>"  onClick="javascript:showCal('Calendar1')" onKeyPress="window.event.keyCode=0;javascript:showCal('Calendar1')" size="8" maxlength="8"   >
                    </div></td>
                    <td width="66%" align="center"><div align="left">
                      <input name="txt_fecha2" type="text" class="combo"  id="txt_fecha2" value="<?php print $_POST['txt_fecha2'];?>"  onClick="javascript:showCal('Calendar2')" onKeyPress="window.event.keyCode=0;javascript:showCal('Calendar2')" size="8" maxlength="8"   >
                    </div></td>
                  </tr>
                  
                  <?php if($_SESSION["rol"]=="admin" || $_SESSION["rol"]=="super" || $rol=="edito"){?>
                  
                  <tr align="center">
                    <td align="right">&nbsp;</td>
                    <td colspan="2" align="left">&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td height="18" align="right">DPA:</td>
                    <td colspan="2" align="left"><div align="left">
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
                   <?php $sel_cod_dpa=$_POST['sel_cod_dpa'];?>
                  <tr align="center">
                    <td height="32" align="right">Establecimiento:</td>
                    <td colspan="2" align="left"><select name="sel_estab" title="Establecimiento" id="sel_estab" onChange="document.frm.submit();">
                      <option value="0">-----------------------</option>
                      <?php 
						//print $sel_mercado;
						
                   if($sel_cod_dpa!=0)
				   {	 
				     //$cod_dpa =$sel_estab;
					 //$id_tipologia =$sel_tipologia;
					 //$id_mercado =$sel_mercado;							 
					 $query_estab = "select distinct cod_estab, estab, n_estab.id_estab from n_estab, n_tipologia, n_mercado, n_dpa, n_var_estab
					 where n_var_estab.id_estab=n_estab.id_estab and n_var_estab.desuso='0' and
					 n_dpa.cod_dpa=n_estab.cod_dpa and incluido='1' and
					 n_estab.id_mercado=n_mercado.id_mercado and 
					 n_estab.id_tipologia=n_tipologia.id_tipologia ";
					 if($sel_cod_dpa!=0)
					 {$query_estab.=" and n_estab.cod_dpa = '$sel_cod_dpa' ";}
					 //$query_estab.="and n_estab.id_tipologia='$id_tipologia' and n_estab.id_mercado='$id_mercado'
					 $query_estab.=" order by cod_estab";//print  $query;
					 
					 $rs_estab=$db->Execute($query_estab) or die($db->ErrorMsg()) ;
					 // print	$query_sel;
					 $cant_rs=$rs_estab->RecordCount();
					 
						for ($i = 0; $i < $cant_rs;$i++)
						{
						$rs_fields0=$rs_estab->Fields("estab");
						$rs_fields1=$rs_estab->Fields("cod_estab");
						$rs_fields_id=$rs_estab->Fields("id_estab");print $rs_fields_id;
						$id_cod_estab=$_POST['sel_estab'];									                             /*if($_POST['sel_cod_var']!="")
						$id_espec=$_POST['sel_espec'];*/
						echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_cod_estab){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
						$rs_estab->MoveNext();
						}
					}					
					 ?>
                    </select></td>
                  </tr>
                  <tr align="center">
                    <td height="21" align="right">Variedad:</td>
                     
                    <td colspan="2" align="left"><select name="sel_var" title="Variedad" id="sel_var" onChange="document.frm.submit();" >
                        <option value="0">-----------------------</option> 
                        <?php 
						//print $sel_mercado;
						$dia1 = $_POST['txt_fecha'];
  						$dia2 = $_POST['txt_fecha2'];
						
						
                    	  if($_POST['sel_estab']!=0)
				  {	 $id_estab =$_POST['sel_estab'];
					 //$id_tipologia =$sel_tipologia;
					 //$id_mercado =$sel_mercado;							 
					 $query_estab = "select distinct ecod_var,variedad,n_variedad.id_variedad
					 FROM n_estab, n_var_estab, b_variedad, n_variedad, captacion 
						
						WHERE captacion.fecha>='$dia1' and captacion.fecha<'$dia2' 
						and captacion.id_var_estab=n_var_estab.id_var_estab 
						and b_variedad.idb_variedad=n_var_estab.idb_variedad 
						and n_variedad.id_variedad=b_variedad.id_variedad 
						and captacion.precio!=0
						and n_var_estab.id_estab=n_estab.id_estab 
						
						and n_estab.id_estab='$id_estab'";
					 //$query_estab.="and n_estab.id_tipologia='$id_tipologia' and n_estab.id_mercado='$id_mercado'
					 //$query_estab.=" order by cod_estab";//print  $query;
					 
					 $rs_estab=$db->Execute($query_estab) or die($db->ErrorMsg()) ;
					  //print	$query_estab;
					 $cant_rs=$rs_estab->RecordCount();
					
						for ($i = 0; $i < $cant_rs;$i++)
						{
						$rs_fields0=$rs_estab->Fields("variedad");
						$rs_fields1=$rs_estab->Fields("ecod_var");
						$rs_fields_id=$rs_estab->Fields("id_variedad");print $rs_fields_id;
						$id_cod_estab=$_POST['sel_var'];										                             
						echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_cod_estab){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
						$rs_estab->MoveNext();
						}
					}					
					 ?>
                     </select> 
                                       </td>
                  </tr>
                  <?php }?>
                  <tr align="center">
                    <td colspan="3"><div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                        <script language="JavaScript" type="text/javascript">
			/*	  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  
				  dia1=parseFloat(document.frm.sel_dia.value);
				  dia2=parseFloat(document.frm.sel_dia2.value);
				  if(dia1>dia2 && dia1!=0 && dia2!=0)
				  {alert("Error en el intervalo de fechas. La primera fecha debe ser menor que la segunda.");
				  document.frm.sel_dia.value=0;
				  document.frm.sel_dia2.value=0;
				  }		*/	  
				  //alert(document.frm.sel_dia.value);alert(document.frm.sel_dia2.value);				  
				  </script>
                      &nbsp;</td>
                  </tr>
                  <tr>
                    <td height="6" colspan="3" align="right">&nbsp;</td>
                  </tr>
                </table>
               <br>
               
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
