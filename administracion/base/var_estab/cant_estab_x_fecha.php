<?php 

$x="../../../";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."/php/session/session_autor.php");

$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-1","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);

$var_estab="select distinct fecha_captar,n_estab.cod_dpa, prov_mun from n_var_estab, n_estab, n_dpa, n_variedad,b_variedad 
where
n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa and n_var_estab.id_estab=n_estab.id_estab and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'";

if($_POST['sel_cod_dpa']!="todo")
{$var_estab .= " and n_estab.cod_dpa='".$_POST['sel_cod_dpa']."'";}

$var_estab .= " order by n_estab.cod_dpa, fecha_captar";
//print $var_estab; 
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab;

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
           <form method="post" name="frm" id="frm" >
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                        <tr > 
                          <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/folder_home.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
</font></strong></td>
                          <td width="77%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Cantidad de establecimientos por d&iacute;as a captar</font></strong></td>
                       
                          <td width="8%"> <div align="center"> <a  class="toolbar" href="../../nomencladores/jhgfjyit/imp_grupo.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?> " target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Imprimir</a> </div></td>
                          <td width="8%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_grupo.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                          Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="79%"   align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
                  <thead>
                    <tr align="center" valign="middle"> 
                      <td height="39"  colspan="10"  >DPA: <strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></font></strong>
                        <select name="sel_cod_dpa" title="C&oacute;digo Producto" id="sel_cod_dpa" onChange="document.frm.submit();" >
                        <option value="0">-----------------------</option>
                        <option value="todo"<?php if($_POST['sel_cod_dpa']=="todo")print "selected";?>>----------Total Cuba-----------</option>
                        <?php 
						$x="../../../";
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$_POST['sel_cod_dpa'];
						include($x."php/selected.php");
						?>
                      </select></td>
                    </tr>
                    
                 
                 
                    <tr align="center" valign="center"  > 
                      
                      <td width="15%" class="intro" >D&iacute;a a Captar </td>
                      <td width="29%"  class="intro">Cantidad de Establecimientos </td>
                      <td class="intro" width="31%"><?php if($_POST['sel_cod_dpa']!="todo") 
					  print "Zona";else print "DPA"; ?></td>
                      <td class="intro" width="25%">Cantidad de Variedades </td>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       for($a=1;$a<=$cant_var_estab;$a++){
					   $estab="select  distinct estab, zona from n_estab, n_var_estab, n_variedad,b_variedad, n_dpa
					   where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
					   and n_estab.cod_dpa=n_dpa.cod_dpa
					   and n_var_estab.id_estab=n_estab.id_estab and fecha_captar='".$rs_var_estab->Fields("fecha_captar")."' and n_dpa.cod_dpa='".$rs_var_estab->Fields("cod_dpa")."' and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'";//print $estab;
					   if($_POST['sel_cod_dpa']!="todo")
					   {$estab .= "and n_dpa.cod_dpa='".$_POST['sel_cod_dpa']."'";}
					   
					   $rs_estab= $db->Execute($estab)or $mensaje=$db->ErrorMsg() ;
                       $cant_estab=$rs_estab->RecordCount();
					   $vari="select  estab from n_estab, n_var_estab, n_variedad,b_variedad, n_dpa
					   where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
					   and n_estab.cod_dpa=n_dpa.cod_dpa
					   and n_var_estab.id_estab=n_estab.id_estab and fecha_captar='".$rs_var_estab->Fields("fecha_captar")."' and n_dpa.cod_dpa='".$rs_var_estab->Fields("cod_dpa")."' and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'";
					   if($_POST['sel_cod_dpa']!="todo")
					   {$vari .= "and n_dpa.cod_dpa='".$_POST['sel_cod_dpa']."'";}
					   
					   $rs_vari= $db->Execute($vari)or $mensaje=$db->ErrorMsg() ;
                       $cant_vari=$rs_vari->RecordCount();
					   

  ?>
                    <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> > 
                      
                      <td class="raya" height="26" align="center"><?php  $fecha2=substr($rs_var_estab->Fields("fecha_captar"),8,9);echo $array2[$fecha2-1];?></td>
                      <td class="raya" height="26" align="center"><?php print $cant_estab;?></td>
                      <td height="26" align="center" class="raya"><?php 
					  if($_POST['sel_cod_dpa']!="todo")
					  {
					  $zona="select  distinct zona from n_estab, n_var_estab, n_variedad,b_variedad, n_dpa
					  where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
					  and n_estab.cod_dpa=n_dpa.cod_dpa
					  and n_var_estab.id_estab=n_estab.id_estab and n_dpa.cod_dpa='".$_POST['sel_cod_dpa']."' and fecha_captar='".$rs_var_estab->Fields("fecha_captar")."' and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'";
					   $rs_zona= $db->Execute($zona)or $mensaje=$db->ErrorMsg() ;
                       $cant_zona=$rs_zona->RecordCount();
					         for($z=1;$z<=$cant_zona;$z++)
							 {
							 if($cant_zona==$z)
							 {
							 print $rs_zona->Fields("zona");
							 }
							 else  {print $rs_zona->Fields("zona")." - ";}
							 $rs_zona->MoveNext();
							 }
					  }
					  else
					  print $rs_var_estab->Fields("cod_dpa")." ".$rs_var_estab->Fields("prov_mun");
					  ?></td>
                      <td height="26" align="center" class="raya"><?php print $cant_vari;?></td>
                     
                    </tr>
                    <?php 
                      $rs_var_estab->MoveNext();
					  $rs_estab->MoveNext();
					   $rs_vari->MoveNext();
	  	}
 	
  ?>
                  </tbody>
                </table>
                
                <p>&nbsp;</p>
                <p>
                 
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
