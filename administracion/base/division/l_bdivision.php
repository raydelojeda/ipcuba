<?php 
$x="../../../";
$campo_order="n_division.cod_division";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_super.php");

if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas 
	$_GET["regis_cant"]="";
}

if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];



//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_max = $rs_fecha->Fields('max');//print $x;
//------------------------------FECHA MAXIMA DE LA BASE---------------------



$query = "select distinct idb_division, fecha, cod_division, division, mercado_nuevo, b_division.r_peso from n_division, b_division, n_mercado where b_division.id_division=n_division.id_division and b_division.id_mercado_nuevo=n_mercado.id_mercado_nuevo and fecha='".$fecha_max."'";

if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and  $sel_filtro ~* '$txt_filtro'";
  }
if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }


if (isset($order) && $order!='') $query .= " order by $order"; elseif($campo_order) $query .= " order by $campo_order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;

$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
//print $query;
$rs = $pager_nav->curr_rs;

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
                          <td width="71%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Pesos por division y moneda.</font></strong></td>
                          <td width="0%"> <div align="center"><a class="toolbar" href="n_bdivision.php"><img src="../../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="4%"> <div align="center"> <a  onClick="modif('m_bdivision.php');" class="toolbar" href="#"> 
                              <img   src="../../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                              <td width="4%"> 
                            <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
                          <td width="5%"> <div align="center"> <a  class="toolbar" href="imp_bdivision.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="10%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_bdivision.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="123"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<tr align="center" valign="middle"> 
                    <td height="39" colspan="6"  > 
                      <?php
if($rs->fields[0]!='')//para verificar que no este vacio
{			
  		if ($rs->RecordCount() > 0)
  		{
  	?>
<div align="right">
                        <a href="#"> 
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
                          <?php   	
  						}  
						
						}//fin del para verificar que no este vacio	
  						?>
                        
                        &nbsp;</div></td>
                  </tr>
                  <tr> 
                    <td height="20"> <div align="center"></div></td>
                    <td align="center" valign="middle"  ></td>
                    <td width="39%" align="left"><div align="right">
                        Filtro:     
                        <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15">
                        <select  onChange="document.frm.submit();" class="combo" name="sel_filtro">
                          <option value="<?php echo "no" ?>">-Seleccionar-</option>
                          <option value="<?php echo "cod_division" ?>"<?php if ($sel_filtro == "cod_division") { echo "selected"; } ?>><?php echo htmlspecialchars("Código División") ?></option>
                          <option value="<?php echo "division" ?>"<?php if ($sel_filtro == "division") { echo "selected"; } ?>><?php echo htmlspecialchars("División") ?></option>
                          <option value="<?php echo "mercado_nuevo" ?>"<?php if ($sel_filtro == "mercado_nuevo") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                        </select>
                        </div></td>
                    <td colspan="3" align="right"  ><?php print "Fecha Base :".$rs->fields["fecha"]." =100";?>&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td  height="14">&nbsp;</td>
                    <td  >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="5%" height="20">No</td>
                    <td width="15%" class="intro" ><a href="l_bdivision.php?order=<?php echo "cod_division";?>&type=<?php echo $ordtypestr;?>">Código 
                      Divisi&oacute;n </a></td>
                    <td class="intro"> <div align="center"><a href="l_bdivision.php?order=<?php echo "division" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Divisi&oacute;n</a></div></td>
                    <td width="17%" class="intro"> 
                    <div align="center"><a href="l_bdivision.php?order=<?php echo "mercado_nuevo" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Moneda</a></div></td>
                    <td width="20%" class="intro"><a href="l_bdivision.php?order=<?php echo "r_peso" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Peso respecto al rubro</a></td>
                    <td width="4%" class="intro">&nbsp;</td>
                  </tr>
                  <?php
if($rs->fields[0]!='')//para verificar que no este vacio
{	
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> > 
                    <td class="raya" height="22" align="center"> <a href="m_bdivision.php?var_aux_mod=<?php echo $rs->fields["idb_division"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"  class="toolbar1"> 
                      <?php $a=$pager_nav->index_rs++; echo $a; ?>
                      </a> </td>
                    <td class="raya" height="22" align="center"><a href="m_bdivision.php?var_aux_mod=<?php echo $rs->fields["idb_division"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"  class="toolbar1"> 
                      <?php echo $rs->fields["cod_division"];?></a></td>
                    <td class="raya" height="22" align="center"><a href="m_bdivision.php?var_aux_mod=<?php echo $rs->fields["idb_division"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"  class="toolbar1" onMouseOver="return overlib('<?php print "Fecha Base:".$rs->fields["fecha"]." = 100";?>', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php echo $rs->fields["division"];?></a></td>
                    <td class="raya" height="22" align="center"> <a href="m_bdivision.php?var_aux_mod=<?php echo $rs->fields["idb_division"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"  class="toolbar1"> 
                      <?php echo $rs->fields["mercado_nuevo"];?></a></td>
                    <td class="raya" align="center"><a href="m_bdivision.php?var_aux_mod=<?php echo $rs->fields["idb_division"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"  class="toolbar1"> 
                      <?php echo substr($rs->fields["r_peso"],0,6);?></a></td>
                    <td align="center" valign="middle" class="raya"> <input name="checkbox_<?php echo $rs->fields["idb_division"];?>" type="checkbox"  value="checkbox"></td>
                  </tr>
                  <?php 
					 
				  if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["idb_division"];
		       	 }
				  elseif($rs->fields["idb_division"]!='')
				 {
		            $cadenacheckboxp .= ",".$rs->fields["idb_division"];
		         }
				//print $cadenacheckboxp;


	  	$rs->MoveNext();
	  	}
  	}
  	
}			
  ?>
                </table>
               <br>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "b_division";?>">
                  <input type="hidden" name="campo" value="<?php echo "idb_division";?>">
                  <input type="hidden" name="location" value="<?php echo "../administracion/base/division/l_bdivision.php";?>">
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
