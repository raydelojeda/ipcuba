<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."adodb/adodb-navigator.php");

$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-4","L-4","Ma-4","Mi-4","J-4","V-4","S-4");

if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}

//print $s_rs->fields["rol"];
$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
//print 	$sql_usuario;
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
//$id_usuario=$rs_usuario->Fields("id_usuario");
//$cod_dpa=substr($rs_usuario->Fields("cod_dpa"),0,2). 0 . 0;lo cambie para ver los municipios
$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2);
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");

if (isset($_GET["order"])) $order = $_GET["order"]; else $order=estab;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];


$query = "select id_var_estab,fecha_creacion, fecha_desuso, n_variedad.ide_articulo,n_var_estab.fecha_captar, fecha_desuso,variedad, cod_var,ecod_var,  n_variedad.id_variedad, id_estab_sustituido,fecha_sus,
unidad, tipologia,
cod_estab,dir,n_estab.cod_dpa,cod_dpa_nueva,prov_mun_nuevo, estab, prov_mun, cantidad,
mercado, n_mercado.id_mercado, central,
valor1,valor2,valor3,valor4,valor5,valor6,
carac1,carac2,carac3,carac4,carac5,carac6
from n_var_estab,b_variedad,n_variedad,n_mercado,n_estab, n_dpa,n_unidad, n_articulo,e_articulo,n_tipologia
where 
n_articulo.id_articulo=n_variedad.id_articulo and
n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and n_estab.id_mercado=n_mercado.id_mercado and n_var_estab.id_estab=n_estab.id_estab
and n_estab.cod_dpa=n_dpa.cod_dpa
and n_unidad.id_unidad=n_var_estab.id_unidad
and n_variedad.ide_articulo=e_articulo.ide_articulo
and n_estab.id_tipologia=n_tipologia.id_tipologia and n_dpa.incluido='1' ";//and n_mercado.id_mercado!='3'
//print $query;
if($sel_cod_dpa!=0)
$query .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
   
if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";//print $query;
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;

//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;//print $rs;
//$id_estab_sustituido=$rs->fields["id_estab_sustituido"];
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
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
</style>
<!-- InstanceEndEditable --> 

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
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar" id="toolbar"  >
                        <tr  > 
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/large/configure.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="70%" valign="middle"  class="us"><span class="style3"><font color="#5A697E">Administración 
                            de la variedad-establecimiento </font></span></td>
                            <td width="1%"> <div align="center"><a class="toolbar" href="n_estab_var.php"><img src="../../../imagenes/admin/new.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="1%"> <div align="center"><a class="toolbar" href="n_var_estab.php"><img src="../../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="4%"> <div align="center"> <a  onClick="modif('m_var_estab.php');" class="toolbar" href="#"> 
                              <img   src="../../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <td width="4%"><div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
                          <td width="4%"> <div align="center"> <a class="toolbar" href="#"> 
                              <input name="alta" type="image" onClick="elim('dar_alta.php');" src="../../../imagenes/admin/publish.png" alt="Alta" width="32" height="32" border="0">
                              <br>
                              Dar Alta</a> </div></td>
                          <td width="4%"> <div align="center"> <a class="toolbar" href="#"> 
                              <input name="baja" type="image" onClick="elim('dar_baja.php');" src="../../../imagenes/admin/unpublish.png" alt="Baja" width="32" height="32" border="0">
                              <br>
                              Dar Baja</a> </div></td>
                                <td width="4%"> <div align="center"> <a class="toolbar" href="#"> 
                              <input name="carac" type="image" onClick="elim('elim_carac.php');" src="../../../imagenes/large/agt_update-product.gif" alt="Baja" width="32" height="32" border="0">
                              <br>
                          Limpiar</a> </div></td>
                          <td width="10%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_var_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="60" border="0" cellpadding="0" cellspacing="0" class="tabla" id="toolbar1">
<tr> 
                    <td colspan="19">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="middle"> 
                    <td colspan="2"  ><div align="right">Filtro: </div></td>
                    <td  align="right"colspan="4" ><div align="left">
                      <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15">
                      <select  onChange="document.frm.submit();" class="combo" name="sel_filtro">
                        <option value="<?php echo "no" ?>">-Seleccionar-</option>
                        <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                        <option value="<?php echo "ecod_var" ?>"<?php if ($sel_filtro == "ecod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Código Variedad") ?></option>
                        <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                        <option value="<?php echo "cod_estab" ?>"<?php if ($sel_filtro == "cod_estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Estab.") ?></option>
                        <option value="<?php echo "estab" ?>"<?php if ($sel_filtro == "estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Establecimiento") ?></option>
                        <option value="<?php echo "tipologia" ?>"<?php if ($sel_filtro == "tipologia") { echo "selected"; } ?>><?php echo htmlspecialchars("Tipologia") ?></option>
                        <option value="<?php echo "n_dpa.cod_dpa" ?>"<?php if ($sel_filtro == "n_dpa.cod_dpa") { echo "selected"; } ?>><?php echo htmlspecialchars("DPA") ?></option>
                        
                        
                        <option value="<?php echo "unidad" ?>"<?php if ($sel_filtro == "unidad") { echo "selected"; } ?>><?php echo htmlspecialchars("U/M") ?></option>
                      </select>
                    </div></td>
                    <td colspan="8"> <div align="right"><a href="#"><?php
  					
  						$pager_nav->Render_Navegator();		?>
                        </a> 
                        <?php
				  		echo "&nbsp;&nbsp;<b>Página :</b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  			
							?>
                        &nbsp;&nbsp;Ver # 
                        <select name="sel_#"  class="combo" onChange="document.frm.submit();">
                          <option value="5" <?php if($ver==5){?>selected="selected" <?php } ?>>5</option>
                          <option value="10" <?php if($ver==10){?>selected="selected" <?php } ?>>10</option>
                          <option value="15" <?php if($ver==15){?>selected="selected" <?php } ?>>15</option>
                          <option value="20" <?php if($ver==20){?>selected="selected" <?php } ?>>20</option>
                          <option value="25" <?php if($ver==25){?>selected="selected" <?php } ?>>25</option>
                          <option value="30" <?php if($ver==30){?>selected="selected" <?php } ?>>30</option>
                          <option value="50" <?php if($ver==50){?>selected="selected" <?php } ?>>50</option>
                          <option value="100" <?php if($ver==100){?>selected="selected" <?php } ?>>100</option>            
                          <option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
                           <option value="5000" <?php if($ver==5000){?>selected="selected" <?php } ?>>5000</option>
                           <option value="100000" <?php if($ver==100000){?>selected="selected" <?php } ?>>100000</option>
                        </select> &nbsp;&nbsp;
                    </div></td>
                  </tr>
                  <tr align="center" valign="middle">
                    <td height="15" colspan="2"  >&nbsp;</td>
                    <td  align="right"colspan="4" >&nbsp;</td>
                    <td colspan="8"><div align="left">
                      <select name="sel_cod_dpa" title="Código DPA" id="sel_cod_dpa" onChange="document.frm.submit();" >
                          <option value="0">---------CUBA---------</option>
                          <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                        </select>&nbsp;
                      </div></td>
                  </tr>
                  <tr> 
                    <td height="4" colspan="19">&nbsp;</td>
                  </tr>
                  <tr align="center"  >
                    <td width="19" class="intro">No</td> 
                    <td width="25" height="94" class="intro"><a href="l_var_estab.php?order=<?php echo "central".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">-</a></td>
                    <td width="30"  class="intro" ><a href="l_var_estab.php?order=<?php echo "n_variedad.ide_articulo".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">-</a></td>
                    <td width="29"  class="intro" ><a href="l_var_estab.php?order=<?php echo "fecha_creacion,fecha_desuso".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">-</a></td>
                    <td width="48"  class="intro" ><a href="l_var_estab.php?order=<?php echo "mercado".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Mercado</a></td>
                    
                    <td class="intro" width="247"><a href="l_var_estab.php?order=<?php echo "variedad, n_estab.cod_estab".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Variedad</a></td>
                    
                    <td class="intro" width="29"><a href="l_var_estab.php?order=<?php echo "n_estab.cod_dpa".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">DPA</a></td>
                    <td class="intro" width="195"><a href="l_var_estab.php?order=<?php echo "estab,fecha_captar,variedad".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Establecimiento</a></td>
                    
                    <td class="intro" width="46" ><a href="l_var_estab.php?order=<?php echo "fecha_captar".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">Fecha a captar</a></td>
                    
                    <td width="53" class="intro" ><a href="l_var_estab.php?order=<?php echo "unidad" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>">UM </a></td>
                    
                    <td width="20" class="intro" ><?php if($rol=="admin" || $rol=="super") {?>
                     <input name="checkbox" onClick="marcar();" type="checkbox">
                    <?php }else print "&nbsp;";?></td>
                  </tr>
                  <?php
  $cadenacheckboxp = "";
  if($rs->fields[0]!='')
{

	 	$rs->MoveFirst();
		//$a=$pager_nav->index_rs;
	  	while (!$rs->EOF)
	  	{
		$dia_captar=substr($rs->fields["fecha_captar"],8,2)-1;

  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td   align="center" class="raya"><a  class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>">
                      <?php echo $a; ?>
                    </a></td> 
                    <td height="5"   align="center" class="raya"><?php $central=$rs->fields["central"];if($central==2){?>
                      <a onMouseOver="return overlib('<?php echo "Precio Centralizado Provincialmente";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><img border="0" src="../../../imagenes/menu/hmenu-lock.png"></a>
                      <?php }elseif($central==1) {?>
					  <a onMouseOver="return overlib('<?php echo "Precio Centralizado Nacionalmente";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><img border="0" src="../../../imagenes/menu/hmenu-lock.png"></a>
                     <?php }elseif($central==0) {?>
					  <a onMouseOver="return overlib('<?php echo "Precio No Centralizado";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><img border="0" src="../../../imagenes/menu/hmenu-unlock.png"></a>
                     <?php } ?>                    </td>
                     
                     
                    <td  class="raya" align="center"><?php $earticulo=$rs->fields["ide_articulo"];if($earticulo==1){?>
                      <a onMouseOver="return overlib('<?php echo "No pertenece a la nueva base o última ENIGH";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><img border="0" src="../../../imagenes/publish_x.png"></a>
                      <?php }else {?>
					  <a onMouseOver="return overlib('<?php echo "Pertenece a la lista de bienes y servicios vigente";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><img border="0" src="../../../imagenes/tick.png"></a>
                     <?php } ?>                    </td>
                     
                     
                    <td  class="raya" align="center"><?php $fecha_creacion=$rs->fields["fecha_creacion"];$fecha_desuso=$rs->fields["fecha_desuso"];if($fecha_desuso){?>
                      <a onMouseOver="return overlib('<?php echo "Variedad dada de alta en el establecimiento el día ".$fecha_creacion.".<br>";echo "Variedad dada de baja en el establecimiento el día ".$fecha_desuso.".";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>"><img border="0" src="../../../imagenes/extrasmall/deletecell.gif"></a>
                       <?php }else { $fecha_creacion=$rs->fields["fecha_creacion"];?>
					  <a onMouseOver="return overlib('<?php echo "Variedad dada de alta en el establecimiento el día ".$fecha_creacion.".";?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1"href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><img border="0" src="../../../imagenes/extrasmall/mail_replylist.gif"></a>
                      <?php } ?></td>
                    <td  class="raya" align="center"><a onMouseOver="return overlib('<?php echo $rs->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><?php echo substr($rs->fields["mercado"],0,1);?></a></td>
                    <td class="raya"align="center"><a href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$rs->fields["ecod_var"];
					  echo "<br><b> UM: </b>".$rs->fields["cantidad"]." ".$rs->fields["unidad"];
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$rs->fields["valor1"];}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$rs->fields["valor2"];}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$rs->fields["valor3"];}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$rs->fields["valor4"];}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$rs->fields["valor5"];}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$rs->fields["valor6"];}?>', ABOVE, RIGHT);" onMouseOut="return nd();"class="toolbar1"><?php echo $rs->fields["variedad"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "DPA: ".$rs->fields["prov_mun_nuevo"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>"><?php echo $rs->fields["cod_dpa_nueva"];?></a></td>
                   
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Código establecimiento: ".$rs->fields["cod_estab"]."<br>Código DPA: ".$rs->fields["cod_dpa_nueva"]." - ".$rs->fields["prov_mun_nuevo"]."<br>Direción: ".$rs->fields["dir"]."<br>Tipología: ".$rs->fields["tipologia"];
				/*	if($id_estab_sustituido!="")
					{
					print "<br>---------------------------------------<br>";
					$sql_sus="select * from n_mercado,n_estab, n_dpa,n_tipologia where n_estab.cod_dpa=n_dpa.cod_dpa 
					and n_estab.id_mercado=n_mercado.id_mercado and n_estab.id_tipologia=n_tipologia.id_tipologia 
					and n_estab.id_estab='$id_estab_sustituido'";
					$rs_sus=$db->Execute($sql_sus) or die($db->ErrorMsg());
					print "<b>Sustituído el día: ".$rs->fields["fecha_sus"]."</b><br>";
					echo "Código establecimiento: ".$rs_sus->fields["cod_estab"]."<br>Código DPA: ".$rs_sus->fields["cod_dpa_nueva"]." - ".$rs_sus->fields["prov_mun_nuevo"]."<br>Direción: ".$rs_sus->fields["dir"]."<br>Tipología: ".$rs_sus->fields["tipologia"];
					$id_estab_sustituido1=$rs_sus->fields["id_estab_sustituido"];
					}
					
					if($id_estab_sustituido1!="")
					{
					print "<br>---------------------------------------<br>";
					$sql_sus1="select * from n_mercado,n_estab, n_dpa,n_tipologia where n_estab.cod_dpa=n_dpa.cod_dpa 
					and n_estab.id_mercado=n_mercado.id_mercado and n_estab.id_tipologia=n_tipologia.id_tipologia 
					and n_estab.id_estab='$id_estab_sustituido1'";
					$rs_sus1=$db->Execute($sql_sus1) or die($db->ErrorMsg());
					print "<b>Sustituído el día: ".$rs_sus->fields["fecha_sus"]."</b><br>";
					echo "Código establecimiento: ".$rs_sus1->fields["cod_estab"]."<br>Código DPA: ".$rs_sus1->fields["cod_dpa_nueva"]." - ".$rs_sus1->fields["prov_mun_nuevo"]."<br>Direción: ".$rs_sus1->fields["dir"]."<br>Tipología: ".$rs_sus1->fields["tipologia"]; 
					}*/
					?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><?php echo $rs->fields["estab"];?></a></td>
                    
                    <td class="raya" align="center"><a onMouseOver="return overlib('<?php echo "Fecha digitación: ".$rs->fields["fecha_captar"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><?php echo $array2[$dia_captar];?></a></td>
                    <td class="raya"align="center"><a class="toolbar1" href="m_var_estab.php?var_aux_mod=<?php echo $rs->fields["id_var_estab"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"><?php echo $rs->fields["cantidad"]." ".$rs->fields["unidad"];?></a></td>
                    <td width="20"align="center" class="raya"><input name="checkbox_<?php echo $rs->fields["id_var_estab"];?>" type="checkbox"  value="checkbox">&nbsp;</td>
                  </tr>
                  <?php 

     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_var_estab"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_var_estab"];
		         }
				//print $cadenacheckboxp;


	  	$rs->MoveNext();
	  	}
  	}
  	
  		
  ?>
                </table>
               <br>
                <p> 
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "n_var_estab";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_var_estab";?>">
                  <input type="hidden" name="location" value="<?php echo "../administracion/base/var_estab/l_var_estab.php?order=".$order."&type=".$ordtypestr."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
                  <input type="hidden" name="location2" value="<?php echo "l_var_estab.php?order=".$order."&type=".$ordtypestr."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa;?>">
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
