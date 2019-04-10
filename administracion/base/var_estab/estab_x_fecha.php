<?php 

$x="../../../";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."/php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; else $order=" n_estab.cod_dpa, fecha_captar, estab";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;



if ($_GET["cod_dpa"]!="") $cod_dpa = $_GET['cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $cod_dpa = $_POST['sel_cod_dpa'];

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];

$array=array("Domingo de la 1ra semana","Lunes de la 1ra semana","Martes de la 1ra semana","Miércoles de la 1ra semana","Jueves de la 1ra semana","Viernes de la 1ra semana","Sábado de la 1ra semana","Domingo de la 2da semana","Lunes de la 2da semana","Martes de la 2da semana","Miércoles de la 2da semana","Jueves de la 2da semana","Viernes de la 2da semana","Sábado de la 2da semana","Domingo de la 3ra semana","Lunes de la 3ra semana","Martes de la 3ra semana","Miércoles de la 3ra semana","Jueves de la 3ra semana","Viernes de la 3ra semana","Sábado de la 3ra semana","Domingo de la 4ta semana","Lunes de la 4ta semana ","Martes de la 4ta semana","Miercoles de la 4ta semana","Jueves de la 4ta semana","Viernes de la 4ta semana","Sábado de la 4ta semana",);


$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-1","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);

$query="select distinct fecha_captar,cod_estab, dir, estab, tipologia, n_estab.cod_dpa, zona, n_var_estab.id_estab 
from n_var_estab, n_estab, n_tipologia, n_dpa ,b_variedad,n_variedad
where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa and n_estab.id_tipologia=n_tipologia.id_tipologia and n_var_estab.id_estab=n_estab.id_estab and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'";
if($cod_dpa!="todo")
{
$query .= " and n_estab.cod_dpa='".$cod_dpa."'";
}

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
$rs_var_estab = $pager_nav->curr_rs;
//$cant_var_estab=$rs_var_estab->RecordCount(); 


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
                          <td width="77%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Establecimientos por d&iacute;as a captar</font></strong></td>
                       
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
                <table width="99%"   align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
                  
                    <tr align="center" valign="middle"> 
                      <td height="39"  colspan="12"  >
                        <br>
                        <table width="707" height="18" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                          <tr>
                            <td width="302" height="18"  align="right">DPA:
                              <select name="sel_cod_dpa" title="C&oacute;digo Producto" id="sel_cod_dpa" onChange="document.frm.submit();" >
                                <option value="0">-----------------------</option>
                                <option value="todo"<?php if($cod_dpa=="todo")print "selected";?>>----------Total Cuba-----------</option>
                                <?php 
								$x="../../../";
								$tabla="n_dpa where incluido='". 1 ."'";
								$campo0=prov_mun_nuevo;
								$campo1=cod_dpa_nueva;
								$campo_id=cod_dpa;
								$id=$cod_dpa;
								include($x."php/selected.php");
								?>
                              </select></a></td>
                            <td width="405"  align="right"><a href="#">
                              <?php
  					
  							$pager_nav->Render_Navegator();		?>
                            </a>
                              <?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$ver=$_POST['sel_#'];		
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
</select>&nbsp;&nbsp;</td>
                          </tr>
                        </table>   
                        <br>                      </td>
                    </tr>
                    
                 
                 
                    <tr align="center" valign="center"  > 
                      <td width="2%" class="intro" >No</td>
                      <td width="7%" class="intro" ><a href="estab_x_fecha.php?order=<?php echo "fecha_captar" ?>&type=<?php echo $ordtypestr ?>&cod_dpa=<?php echo $cod_dpa;?>">D&iacute;a a captar</a></td>
                      <td width="9%"  class="intro">Variedades</td>
                      <?php  if($cod_dpa=="todo"){?>  <td class="intro" width="22%"><a href="estab_x_fecha.php?order=<?php echo "n_estab.cod_dpa" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $cod_dpa?>">DPA</a></td>
                      <?php }?>
                      <td width="29%"  class="intro"><a href="estab_x_fecha.php?order=<?php echo "estab" ?>&type=<?php echo $ordtypestr ?>&cod_dpa=<?php echo $cod_dpa;?>">Establecimientos</a></td>
                      <td class="intro" width="23%"><a href="estab_x_fecha.php?order=<?php echo "tipologia" ?>&type=<?php echo $ordtypestr ?>&cod_dpa=<?php echo $cod_dpa;?>">Tipolog&iacute;a</a></td>
                      <td class="intro" width="8%"><a href="estab_x_fecha.php?order=<?php echo "zona" ?>&type=<?php echo $ordtypestr ?>&cod_dpa=<?php echo $cod_dpa;?>">Zona</a></td>
                    </tr>
                 
                    <?php
if($rs_var_estab->fields[0]!='')
{

	 	$rs_var_estab->MoveFirst();
	
	  	while (!$rs_var_estab->EOF)
	  	{
					   $vari="select estab,ecod_var,variedad,n_estab.cod_dpa, prov_mun 
					   from n_estab, n_var_estab,b_variedad,n_variedad,n_dpa 
					   where n_variedad.id_variedad=b_variedad.id_variedad and b_variedad.idb_variedad=n_var_estab.idb_variedad and n_estab.cod_dpa=n_dpa.cod_dpa and n_var_estab.id_estab=n_estab.id_estab and fecha_captar='".$rs_var_estab->Fields("fecha_captar")."' and n_var_estab.id_estab='".$rs_var_estab->Fields("id_estab")."' and incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'";
					   
					   
if($sel_cod_dpa!="todo")
{
$query=$query." and cod_dpa='".$cod_dpa."'";	
}			   
					   
					   
					   
					 $query=$query." order by ecod_var";//print $vari;
					   $rs_vari= $db->Execute($vari)or $mensaje=$db->ErrorMsg() ;
                       $cant_vari=$rs_vari->RecordCount();
					   $dpa=$rs_vari->Fields("cod_dpa").". ".$rs_vari->Fields("prov_mun");
  ?>
                   <tr  height="20" <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                    <td height="22"   align="center" class="raya"><?php $a=$pager_nav->index_rs++; echo $a; ?></td>
                    <td class="raya" height="26" align="center"><a onMouseOver="return overlib('<?php $fecha2=substr($rs_var_estab->Fields("fecha_captar"),8,9);echo $array[$fecha2-1];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php  echo $array2[$fecha2-1];?></a></td>
                      <td class="raya" align="center"><a onMouseOver="return overlib('<?php 
		for($v=1;$v<=$cant_vari;$v++)
		{
		print $rs_vari->fields["ecod_var"].". ";
		print $rs_vari->fields["variedad"]."<br>";
		$rs_vari->MoveNext();
		}
					  
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php print $cant_vari;?></a></td>
                      <?php  if($cod_dpa=="todo"){?> 
                      <td align="center" class="raya">
                    <?php print $dpa?>  </td><?php }?>
                    
                      <td class="raya" height="26" align="center"><a onMouseOver="return overlib('<?php echo "Código: ".$rs_var_estab->fields["cod_estab"]."<br>Tipología: ".$rs_var_estab->fields["tipologia"]."<br>Dirección: ".$rs_var_estab->fields["dir"]."<br>DPA: ".$rs_var_estab->fields["cod_dpa"]?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"><?php echo $rs_var_estab->fields["estab"];?></a></td>
                      <td height="26" align="center" class="raya"><?php echo $rs_var_estab->fields["tipologia"];?></td>
                      <td height="26" align="center" class="raya"><?php print $rs_var_estab->Fields("zona");
					  
					  ?></td>
                    </tr>
                    <?php 
                      $rs_var_estab->MoveNext();
					 
	  	}
	}
 	
  ?>
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
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
