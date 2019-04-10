<?php 
$x="../../../";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="ecod_var";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];


$query = "select * from n_variedad,e_articulo,n_articulo where e_articulo.ide_articulo=n_variedad.ide_articulo and n_articulo.id_articulo=n_variedad.id_articulo";
//print $query;

if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;
//print $rs;
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
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
</font></strong></td>
                          <td width="61%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Administración 
                            de variedades</font></strong></td>
                          <td width="0%"> <div align="center"><a class="toolbar" href="n_variedad.php"><img src="../../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="6%"> <div align="center"> <a  onClick="modif('m_variedad.php');" class="toolbar" href="#"> 
                              <img   src="../../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <td width="6%"><div align="center"> <a class="toolbar" href="#">
                            <input name="borrar2" type="image" onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                            <br>
                          Borrar</a></div></td>
                          <td width="6%"><div align="center"> <a class="toolbar" href="#">
                            <input name="borrar" type="image" onClick="elim('elim_cascada.php');" src="../../../imagenes/large/edit_remove.gif" alt="Eliminar en cascada hasta captaci&oacute;n" width="32" height="32" border="0">
                            <br>
                          Cascada</a></div></td>
                          <td width="9%"> <div align="center"> <a  class="toolbar" href="../variedad/imp_variedad.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="12%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_variedad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="95%" height="200"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
                  <thead>
                    <tr align="center" valign="middle"> 
                      <td height="27" colspan="13"  > <div align="right"><a href="#"> 
                          <?php
  					
  							$pager_nav->Render_Navegator();		?>
                          </a> 
                          <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							?>
                          &nbsp;&nbsp;Ver # 
                          <select name="sel_#" class="inputbox"  onChange="document.frm.submit();">
                            <option value="5" <?php if($ver==5){?>selected="selected" <?php } ?>>5</option>
                            <option value="10" <?php if($ver==10){?>selected="selected" <?php } ?>>10</option>
                            <option value="15" <?php if($ver==15){?>selected="selected" <?php } ?>>15</option>
                            <option value="20" <?php if($ver==20){?>selected="selected" <?php } ?>>20</option>
                            <option value="25" <?php if($ver==25){?>selected="selected" <?php } ?>>25</option>
                            <option value="30" <?php if($ver==30){?>selected="selected" <?php } ?>>30</option>
                            <option value="50" <?php if($ver==50){?>selected="selected" <?php } ?>>50</option>
                            <option value="100" <?php if($ver==100){?>selected="selected" <?php } ?>>100</option>
                            <option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
                          </select>
                          &nbsp;</div></td>
                    </tr>
                    <tr> 
                      <td height="20">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="6" align="right" valign="middle"  > <div align="left">Filtro: 
                        <input  align="left" name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15">
                        <select  onChange="document.frm.submit();" class="combo" name="sel_filtro">
                          <option value="<?php echo "no" ?>">-Seleccionar-</option>
                          <option value="<?php echo "ecod_var" ?>"<?php if ($sel_filtro == "ecod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Código variedad") ?></option>
                          <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                          </select>
                      </div> </td>
                      <td  align="right"  >&nbsp; </td>
                    </tr>
                    <tr> 
                      <td height="10">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td colspan="2" align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                    </tr>
                    <tr align="center" valign="center"  > 
                      <td width="2%" height="20" class="intro">No</td>
                      <td class="intro" width="4%"><a href="l_variedad.php?order=<?php echo "indice"?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">-</a></td>
                      <td class="intro" width="3%"><a href="l_variedad.php?order=<?php echo "central"?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">-</a></td>
                      <td width="5%" class="intro" >&nbsp;</td>
                      <td width="5%" class="intro" >&nbsp;</td>
                      <td width="5%" class="intro" >&nbsp;</td>
                      <td width="31%" class="intro" ><a href="l_variedad.php?order=<?php echo "ecod_var" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Código 
                        Variedad </a></td>
                      <td colspan="2" class="intro"> <div align="center"><a href="l_variedad.php?order=<?php echo "variedad" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Variedad</a></div></td>
                      <td class="intro"><input name="checkbox" onclick="marcar();" type="checkbox" /></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
if($rs->fields[0]!='')
{	
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                    <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> > 
                      <td height="16" align="center"  class="raya"><a href="../variedad/m_variedad.php?var_aux_mod=<?php echo $rs->fields["id_variedad"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"> 
                        <?php $a=$pager_nav->index_rs++; echo $a; ?>
                        </a> </td>
                      <td  class="raya" align="center"><a class="toolbar1" onMouseOver="return overlib('<?php if($rs->fields["indice"]==1)print "Variedad de la lista de bienes y servicios del IPC."; else print "Variedad dada de baja en el IPC.";?>', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php if($rs->fields["indice"]==1) {?>
                      <img src="../../../imagenes/tick.png">
                      <?php } else {?>
                      <img src="../../../imagenes/publish_x.png">
                      <?php }?>
                      </a> </td>
                      <td  class="raya" align="center"><?php $central=$rs->fields["central"];if($central==2){?>
                        <a onMouseOver="return overlib('<?php echo "Variedad Centralizada Provincialmente.";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../variedad/m_variedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>"><img border="0" src="../../../imagenes/menu/hmenu-lock.png"></a>
                        <?php }elseif($central==1) {?>
                        <a onMouseOver="return overlib('<?php echo "Variedad Centralizada Nacionalmente.";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../variedad/m_variedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>"><img border="0" src="../../../imagenes/menu/hmenu-lock.png"></a>
                        <?php } elseif($central==0) {?>
                        <a onMouseOver="return overlib('<?php echo "Variedad No Centralizada.";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../variedad/m_variedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>"><img border="0" src="../../../imagenes/menu/hmenu-unlock.png"></a>
                      <?php } ?></td>
                      <td class="raya" align="center"><?php //print "fotos_catalogo/". $rs->fields["ecod_var"] ."_1.jpg";
		if (file_exists('fotos_catalogo/'. $rs->fields["ecod_var"] .'_1.jpg')){?>
 <a onMouseOver="return overlib('<?php print "<img src=fotos_catalogo/". $rs->fields["ecod_var"]."_1.jpg border=0 width=150 height=150 >";
		  ?>', ABOVE, RIGHT);" onMouseOut="return nd();"> <img src="../../../imagenes/menu/media.png" alt="" width="16" height="16"></a><?php }else print "&nbsp;";?></td>
                      <td class="raya" align="center"><?php 
		if (file_exists('fotos_catalogo/'. $rs->fields["ecod_var"] .'_2.jpg')){?>
 <a onMouseOver="return overlib('<?php print "<img src=fotos_catalogo/". $rs->fields["ecod_var"]."_2.jpg border=0 width=150 height=150 >";
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"> <img src="../../../imagenes/menu/media.png" alt="" width="16" height="16"></a><?php }else print "&nbsp;";?></td>
                      <td class="raya" align="center"><?php 
		if (file_exists('fotos_catalogo/'. $rs->fields["ecod_var"] .'_3.jpg')){?>
 <a onMouseOver="return overlib('<?php print "<img src=fotos_catalogo/". $rs->fields["ecod_var"]."_3.jpg border=0 width=150 height=150 >";
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"> <img src="../../../imagenes/menu/media.png" width="16" height="16"></a><?php }else print "&nbsp;";?></td>
                      <td class="raya" align="center"><a href="../variedad/m_variedad.php?var_aux_mod=<?php echo $rs->fields["id_variedad"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["ecod_var"];?></a></td>
                      <td class="raya"colspan="2" align="center"><a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$rs->fields["ecod_var"];
					  
						  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$rs->fields["valor1"];}
						  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$rs->fields["valor2"];}
						  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$rs->fields["valor3"];}
						  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$rs->fields["valor4"];}
						  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$rs->fields["valor5"];}
						  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$rs->fields["valor6"];}
					  
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();" href="../variedad/m_variedad.php?var_aux_mod=<?php echo $rs->fields["id_variedad"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"> 
                        <?php echo $rs->fields["variedad"];?></a></td>
                      <td class="raya"width="3%" align="right" valign="middle"><input name="checkbox_<?php echo $rs->fields["id_variedad"];?>" type="checkbox"  value="checkbox">
                        &nbsp;</td>
                    </tr>
                    <?php 

     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_variedad"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_variedad"];
		         }
				
	  	$rs->MoveNext();
	  	}
  	}
  	
 }		
  ?>
                  </tbody>
                </table>
                <br>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "n_variedad";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_variedad";?>">
                  <input type="hidden" name="location" value="<?php echo "../administracion/nomencladores/variedad/l_variedad.php?order=".$order."&type=".$ordtypestr."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
                  <input type="hidden" name="location3" value="<?php echo "../../nomencladores/variedad/l_variedad.php?order=".$order."&type=".$ordtypestr."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
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
