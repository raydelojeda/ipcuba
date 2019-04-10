<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");
include($x."adodb/adodb-navigator.php");


//print $_SERVER['HTTP_HOST'];
//print gethostbyname('localhost');

if($_POST['txt_ir'])
{//print "sds";
header("Location:l_bvariedad.php?curr_page=".$_POST['txt_ir']);
}

	if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}

if (isset($_GET["order"])) $order = $_GET["order"]; else $order="variedad";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;

if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if ($_POST["sel_filtro"]!="") $sel_filtro = $_POST['sel_filtro'];


//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

$query = "select * from b_variedad, n_variedad, n_mercado WHERE  n_mercado.id_mercado = b_variedad.id_mercado and  n_variedad.id_variedad = b_variedad.id_variedad AND fecha='".$fecha_base."'";
//print $query;
if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);
//print $query;
if($ver=="")
$ver=50;
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
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/large/folder_green.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="71%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Listado 
                            de variedades de la canasta</font></strong></td>
                          <td width="0%"> 
                            <div align="center"><a class="toolbar" href="n_bvariedad.php"><img src="../../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="4%"> 
                            <div align="center"> <a  onClick="modif('m_bvariedad.php');" class="toolbar" href="#"> 
                              <img   src="../../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <td width="4%"> 
                            <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
                              <td width="4%"> 
                            <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('elim_cascada.php');" src="../../../imagenes/large/edit_remove.gif" alt="Eliminar en cascada hasta captación" width="32" height="32" border="0">
                              <br>
                              Cascada</a> </div></td>
                          <td width="5%"> 
                            <div align="center"> <a  class="toolbar" href="../variedad/imp_bvariedad.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="10%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_variedad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="60"  align="center" cellpadding="0" cellspacing="0"  class="tabla"  id="toolbar1">
                  
                  <tr> 
                    <td height="39" colspan="7"> <div align="right"></div>                      
                      <div align="right">Filtro:
                        <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="10">
                        <select  onchange="document.frm.submit();" class="combo" name="sel_filtro">
                          <option value="<?php echo "no" ?>">-Seleccionar-</option>
                          <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                          <option value="<?php echo "cod_var" ?>"<?php if ($sel_filtro == "cod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Código variedad") ?></option>
                          <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                          
                          </select>                    
                        <a  href="#" onClick="javascript: document.frm.submit();">Ir: </a>
                        <input  name="txt_ir" type="text" class="combo" value="" size="3" >
&nbsp; <a href="#">
<?php
  					
  							$pager_nav->Render_Navegator();		?>
</a>
<?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							?>
&nbsp;Ver #
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

                      </div>
                    <div align="left"></div></td>
                  </tr>
                  <tr> 
                    <td width="7%" height="9">&nbsp;</td>
                    <td width="6%"align="center" valign="middle"  >&nbsp;</td>
                    <td width="8%"align="center" valign="middle"  >&nbsp;</td>
                    <td width="29%"align="center" valign="middle"  >&nbsp;</td>
                    <td width="46%"align="center" valign="middle"  >&nbsp;</td>
                    <td width="4%" align="center" valign="middle"  >&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro"  height="20">No</td>
                    <td  class="intro" ><a href="../variedad/l_bvariedad.php?order=<?php echo "indice" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">-</a></td>
                    <td  class="intro" ><a href="../variedad/l_bvariedad.php?order=<?php echo "central" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">- 
                      </a></td>
                    <td  class="intro" ><a href="../variedad/l_bvariedad.php?order=<?php echo "mercado" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Mercado</a></td>
                    <td class="intro"> <a href="../variedad/l_bvariedad.php?order=<?php echo "variedad" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Variedad</a></td>
                    <td class="intro">&nbsp;</td>
                  </tr>
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
                    <td class="raya"height="22" align="center"><a href="../variedad/m_bvariedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>&curr_page=<?php print $pager_nav->curr_page;?>&curr_page=<?php print $var;?>"  class="toolbar1"> 
                      <?php $a=$pager_nav->index_rs++; echo $a; ?>
                      </a></td>
                    <td class="raya" align="center"> <a class="toolbar1" onMouseOver="return overlib('<?php if($rs->fields["indice"]==1)print "Variedad de la lista de bienes y servicios del IPC."; else print "Variedad de la lista de bienes y servicios del PCI.";?>', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php if($rs->fields["indice"]==1) {?>
                      <img src="../../../imagenes/tick.png"> 
                      <?php } else {?>
                      <img src="../../../imagenes/publish_x.png"> 
                      <?php }?>
                      </a> </td>
                    <td  class="raya" align="center">
                      <?php $central=$rs->fields["central"];if($central==2){?>
                      <a onMouseOver="return overlib('<?php echo "Variedad Centralizada Provincialmente.";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../variedad/m_bvariedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>"><img border="0" src="../../../imagenes/menu/hmenu-lock.png"></a>
                      <?php }elseif($central==1) {?>
					  <a onMouseOver="return overlib('<?php echo "Variedad Centralizada Nacionalmente.";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../variedad/m_bvariedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>"><img border="0" src="../../../imagenes/menu/hmenu-lock.png"></a>
                     <?php } elseif($central==0) {?>
					  <a onMouseOver="return overlib('<?php echo "Variedad No Centralizada.";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="../variedad/m_bvariedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>"><img border="0" src="../../../imagenes/menu/hmenu-unlock.png"></a><?php } ?>                    </td>
                    <td class="raya"  ><div align="center"><a href="../variedad/m_bvariedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>&curr_page=<?php print $pager_nav->curr_page;?>&curr_page=<?php print $var;?>"  class="toolbar1"> <?php echo $rs->fields["mercado"];?></a></div></td>
                   <td class="raya" align="center"><a href="../variedad/m_bvariedad.php?var_aux_mod=<?php echo $rs->fields["idb_variedad"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"  class="toolbar1" onMouseOver="return overlib('<?php echo "Código: ".$rs->fields["cod_var"];if($rs->fields["indice"]==1)print "<br>"."Variedad de la lista de bienes y servicios del IPC."; else print "<br>Variedad de la lista de bienes y servicios del PCI."; print "<br>Fecha Base:".$rs->fields["fecha"]." = 100";?>', ABOVE, RIGHT);" onMouseOut="return nd();"><?php echo $rs->fields["variedad"];?></a></td>
                    <td class="raya" align="center" valign="middle"> <input name="checkbox_<?php echo $rs->fields["idb_variedad"];?>" type="checkbox"  value="checkbox">                    </td>
                  </tr>
                  <?php 
					
     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["idb_variedad"];
		       	 }
				  elseif($rs->fields["idb_variedad"]!='')
				 {
		            $cadenacheckboxp .= ",".$rs->fields["idb_variedad"];
		         }
				//print $cadenacheckboxp;


	  	$rs->MoveNext();
	  	}
  	}
  	
}		
  ?>
                </table>
                <p>&nbsp;</p>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "b_variedad";?>">
                  <input type="hidden" name="campo" value="<?php echo "idb_variedad";?>">
                  <input type="hidden" name="location3" value="<?php echo "../administracion/base/variedad/l_bvariedad.php?order=".$order."&type=".$ordtypestr."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
                  <input type="hidden" name="location2" value="<?php echo "l_bvariedad.php?order=".$order."&type=".$ordtypestr."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
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
