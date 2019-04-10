<?php 

$x="../../../";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");


if (isset($_GET["order"])) $order = $_GET["order"]; elseif($_POST['sel_cod_dpa']=="todo_m")
 {$order=" n_dpa.cod_dpa, ecod_var";}else $order=" ecod_var";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];
//print  $sel_cod_dpa;
$query = "select  ecod_var, variedad,count(b_variedad.id_mercado)";
 if($sel_cod_dpa=="todo_m")
 {$query=$query.", n_dpa.cod_dpa, prov_mun";}
 
$query=$query." from n_variedad,b_variedad,n_var_estab, n_estab, n_dpa
where n_dpa.cod_dpa=n_estab.cod_dpa and n_var_estab.id_estab=n_estab.id_estab and n_variedad.id_variedad=b_variedad.id_variedad and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and b_variedad.idb_variedad=n_var_estab.idb_variedad";


 if($sel_cod_dpa!="todo" && $sel_cod_dpa!="todo_m")
 {
   $query=$query." and n_dpa.cod_dpa='".$sel_cod_dpa."'";
 }


if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
 if($sel_cod_dpa=="todo_m")
 {$query=$query." group by n_dpa.cod_dpa, prov_mun, ecod_var, variedad";}  
  elseif($sel_cod_dpa=="todo")
 {$query=$query." group by ecod_var, variedad";}  
 else{$query=$query." group by n_dpa.cod_dpa, ecod_var, variedad";}
 
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
                          <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/agt_business.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
</font></strong></td>
                          <td width="77%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Cantidad de precios por variedad</font></strong></td>
                       
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
                <table width="97%"   align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
                 
                    <tr align="center" valign="middle"> 
                      <td height="62"  colspan="12"  >
                      
                        <table width="713" height="20" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                          <tr>
                            <td width="290" height="20"><div align="right">Filtro:
                              <input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15">
                                    <select  onChange="document.frm.submit();"  name="sel_filtro">
                                      <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                                                            
                                      <option value="<?php echo "ecod_var" ?>"<?php if ($sel_filtro == "ecod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Variedad") ?></option>
                                      <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                                     
                              </select>
                            </div></td>
                            <td width="423"  align="right"><a href="#">
                              <?php
  					
  							$pager_nav->Render_Navegator();		?>
                              </a>
                                <?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
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
                                <option value="10000" <?php if($ver==10000){?>selected="selected" <?php } ?>>10000</option>
                              </select></td>
                          </tr>
                        </table>                   
                        <br>     
                          DPA:
                          <select name="sel_cod_dpa" title="C&oacute;digo Producto" id="sel_cod_dpa" onChange="document.frm.submit();" >
                            <option value="0">---------------------------------</option>
                            <option value="todo"<?php if($sel_cod_dpa=="todo")print "selected";?>>----------Total Cuba-----------</option>
                            <option value="todo_m"<?php if($sel_cod_dpa=="todo_m")print "selected";?>>--Total Cuba por municipios--</option>
                            <?php 
						$x="../../../";
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                          </select>
                        
                      </td>
                    </tr>
                    
                   
                 
                    <tr align="center" valign="center"  >
                      <td width="5%" class="intro" >No</td> 
                      
                      <td width="15%" class="intro" ><a href="cant_precios_x_var.php?order=<?php echo "ecod_var" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Código de variedad</a></td>
                      <td width="40%"  class="intro"><a href="cant_precios_x_var.php?order=<?php echo "variedad" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Variedad</a></td>                      
                    <?php  if($sel_cod_dpa=="todo_m"){?>  <td class="intro" width="28%"><a href="cant_precios_x_var.php?order=<?php echo "cod_dpa" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">DPA</a></td><?php }?>
                      <td class="intro" width="12%"><a href="cant_precios_x_var.php?order=<?php echo "count" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Cant. de precios</a></td>
                    </tr>
               
                    <?php 
			// if($rs->fields[1]!='')
			//{		//print "ddd";
			  
				if ($rs->RecordCount() > 0)
				{
			
					$rs->MoveFirst();
				
					while (!$rs->EOF)
					{
					   $cod_var=$rs->Fields("ecod_var");
					   $variedad=$rs->Fields("variedad");
					   $cant_precios=$rs->Fields("count");
					   $dpa=$rs->Fields("cod_dpa").". ".$rs->Fields("prov_mun");
					  
  					?>
                    <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                      <td class="raya" align="center"><?php $a=$pager_nav->index_rs++; echo $a; ?></td> 
                      
                      <td class="raya" height="33" align="center"><?php  echo  $cod_var;?></td>
                      <td class="raya" height="33" align="center"><?php print $variedad;?></td>
                      <?php  if($sel_cod_dpa=="todo_m"){?> <td  class="raya"align="center">
                    <?php print $dpa?>  </td><?php }?>
                      <td height="33" align="center" class="raya"><?php print $cant_precios;?></td>
                    </tr>
                    <?php 
                      $rs->MoveNext();
			}
  	}
  	
//} 		
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
