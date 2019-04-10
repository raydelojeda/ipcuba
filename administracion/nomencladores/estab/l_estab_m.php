<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");

$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$rol=$rs_usuario->Fields("rol");

if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];

$query = "select * from n_estab,n_mercado,n_tipologia,n_dpa where n_estab.id_tipologia=n_tipologia.id_tipologia and n_mercado.id_mercado=n_estab.id_mercado and n_dpa.cod_dpa=n_estab.cod_dpa and incluido='1'";
//print $query;
if($rol=='aut_p') 
{$query=$query."  and n_estab.cod_dpa like '".$cod_dpa2."'";}
elseif($rol=='autor')
{$query=$query."  and n_estab.cod_dpa='".$cod_dpa."'";}
elseif($rol=='admin' || $rol=='super' || $rol=='edito')
{if($sel_cod_dpa!=0)
$query .= "and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
}

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
//print $rs;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
<link href="../../../css/theme.css" rel="stylesheet" type="text/css">
<link href="../../../css/estilos.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript"   src="../../../javascript/overlib_mini.js"></script>
<script language="javascript"    src="../../../javascript/barra/floater_xlibAbajo.js"></script>
<script language="javascript"    src="../../../javascript/barra/basic.js"></script>
<script language="javascript"    src="../../../javascript/barra/scripts1.js"></script>
<script language="JavaScript" src="../../../javascript/funciones.js" type="text/javascript">

var cabecera=window.screenTop

if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<body  onLoad="loadBar()"><form method="post" name="frm" id="frm" action="">
<div id="contenido1">
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td> <table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
          <tr> 
            <td><img src="../../../imagenes/banner.jpg" width="750" height="35"></td>
          </tr>
          <tr> 
            <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
              <tr> 
                <td class="menubackgr" style="padding-left:5px;"> <div id="myMenuID"></div>
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
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../../javascript/menu_jefes.js">	
		</script>



<?php
} elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../../javascript/menu_super.js">	
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
                <td class="menubackgr"  valign="middle" align="right" > <a href="../../../php/logout.php" style="color: #333333; font-weight: bold"> 
                  Salir:&nbsp; <?php print $_SESSION["user"];?></a> </td>
              </tr>
            </table>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                  <tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar" id="toolbar"  >
                        <tr  > 
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/admin/frontpage.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="90%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Administración 
                            de establecimientos</font></strong></td>
                          <?php if($rol=="super" || $rol=="admin" || $rol=="edito") {?><td width="1%"> 
                          <div align="center"><a class="toolbar" href="n_estab.php"><img src="../../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td><?php }?>
                          <td width="1%"> <div align="center"> <a  onClick="modif('m_estab_m.php');" class="toolbar" href="#"> 
                              <img   src="../../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <?php if($rol=="super" || $rol=="admin" || $rol=="edito") {?><td width="1%">  <td width="4%"> <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
                              <td width="1%"> <div align="center"><a class="toolbar" href="sustituir_estab.php"><img src="../../../imagenes/admin/reload_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Sustituir</a></div></td><?php }?>
                          <td width="5%"> <div align="center"> <a  class="toolbar" href="../../estab/imp_estab.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20"   target="_blank"> 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="10%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="100%" height="120" border="0" cellpadding="0" cellspacing="0" class="tabla" id="toolbar1">
                  <tr> 
                    <td colspan="13">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="middle"> 
                    <td  >&nbsp;</td>
                    <td width="1%"  >&nbsp;</td>
                    <td colspan="8"  ><div align="right">Filtro:
                      <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15" />
                            <select  onchange="document.frm.submit();" class="combo" name="sel_filtro">
                              <option value="<?php echo "no" ?>">-Seleccionar-</option>
                              <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                              <option value="<?php echo "tipologia" ?>"<?php if ($sel_filtro == "tipologia") { echo "selected"; } ?>><?php echo htmlspecialchars("Tipología") ?></option>
                              <option value="<?php echo "n_estab.cod_dpa" ?>"<?php if ($sel_filtro == "n_estab.cod_dpa") { echo "selected"; } ?>><?php echo htmlspecialchars("Código DPA") ?></option>
                              <option value="<?php echo "n_estab.cod_estab" ?>"<?php if ($sel_filtro == "n_estab.cod_estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Código Estab") ?></option>
                              <option value="<?php echo "dir" ?>"<?php if ($sel_filtro == "dir") { echo "selected"; } ?>><?php echo htmlspecialchars("Dirección") ?></option>
                              <option value="<?php echo "estab" ?>"<?php if ($sel_filtro == "estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Establecimiento") ?></option>
                              <option value="<?php echo "org_sup" ?>"<?php if ($sel_filtro == "org_sup") { echo "selected"; } ?>><?php echo htmlspecialchars("Organismo superior") ?></option>
                            </select><a href="#">
                            <?php
  					
  						$pager_nav->Render_Navegator();		?>
                      </a>
                          <?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina :</b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];	
							?>
  &nbsp;&nbsp;Ver #
  <select name="sel_#"  class="combo" onchange="document.frm.submit();">
    <option value="5" <?php if($ver==5){?>selected="selected" <?php } ?>>5</option>
    <option value="10" <?php if($ver==10){?>selected="selected" <?php } ?>>10</option>
    <option value="15" <?php if($ver==15){?>selected="selected" <?php } ?>>15</option>
    <option value="20" <?php if($ver==20){?>selected="selected" <?php } ?>>20</option>
    <option value="25" <?php if($ver==25){?>selected="selected" <?php } ?>>25</option>
    <option value="30" <?php if($ver==30){?>selected="selected" <?php } ?>>30</option>
    <option value="50" <?php if($ver==50){?>selected="selected" <?php } ?>>50</option>
    <option value="150" <?php if($ver==150){?>selected="selected" <?php } ?>>150</option>
    <option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
  </select>
                    </div></td>
                  </tr>
                  <tr align="center" valign="middle">
                    <td height="25"  >&nbsp;</td>
                    <td  >&nbsp;</td>
                    <td colspan="8"  ><?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
                      DPA:<select name="sel_cod_dpa" title="C&oacute;digo DPA" id="sel_cod_dpa" onchange="document.frm.submit();" >
                        <option value="0">---------CUBA---------</option>
                        <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                      </select>
                      <?php }?>
                    &nbsp; </td>
                  </tr>
                  <tr> 
                    <td colspan="13">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="2%" height="21">No</td>
                    <td colspan="2" class="intro" ><a href="l_estab.php?order=<?php echo "mercado" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano?>">Mercado</a></td>
                    <td class="intro" width="7%"><a href="l_estab.php?order=<?php echo "tipologia" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano?>">Tipolog&iacute;a</a></td>
                    <td class="intro" width="9%"><a href="l_estab.php?order=<?php echo "n_dpa.cod_dpa" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano?>">Cód. DPA</a></td>
                    <td class="intro" width="10%" ><a href="l_estab.php?order=<?php echo "cod_estab" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano?>">Cód. Estab.</a></td>
                    <td class="intro" width="31%"><a href="l_estab.php?order=<?php echo "dir" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano?>">Direcci&oacute;n</a></td>
                    <td class="intro" width="35%"><a href="l_estab.php?order=<?php echo "estab" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano?>">Establecimiento</a></td>
                    <td class="intro" width="3%"><input name="checkbox" onclick="marcar();" type="checkbox" /></td>
                  </tr>
                  <?php
  $cadenacheckboxp = "";
  if($rs->fields[0]!='')
{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> > 
                    <td class="raya" height="22" align="center"> 
                      <?php $a=$pager_nav->index_rs++; echo $a; ?>                    </td>
                    <td class="raya"colspan="2"  align="center"><a onMouseOver="return overlib('<?php echo $rs->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="m_estab_m.php?var_aux_mod=<?php echo $rs->fields["id_estab"];?>"><?php echo substr($rs->fields["mercado"],0,1);?></a></td>
                    <td class="raya"align="center"><a class="toolbar1" href="m_estab_m.php?var_aux_mod=<?php echo $rs->fields["id_estab"];?>"><?php echo $rs->fields["tipologia"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo $rs->fields["prov_mun"];?>', ABOVE, RIGHT);" onMouseOut="return nd();"  href="m_estab_m.php?var_aux_mod=<?php echo $rs->fields["id_estab"];?>"><?php echo $rs->fields["cod_dpa"];?></a></td>
                    <td class="raya" align="center"><a class="toolbar1" href="m_estab_m.php?var_aux_mod=<?php echo $rs->fields["id_estab"];?>"><?php echo $rs->fields["cod_estab"];?></a></td>
                    <td class="raya"align="center"><a class="toolbar1" href="m_estab_m.php?var_aux_mod=<?php echo $rs->fields["id_estab"];?>"><?php echo $rs->fields["dir"];?></a></td>
                    <td class="raya" align="center"><a class="toolbar1" onMouseOver="return overlib('<?php echo "Organismo superior: ".$rs->fields["org_sup"]."<br>Contacto: ".$rs->fields["contacto"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" href="m_estab_m.php?var_aux_mod=<?php echo $rs->fields["id_estab"];?>"><?php echo $rs->fields["estab"];?></a></td>
                    
                  
                    
                   
                    <td width="3%"align="center" valign="middle" class="raya"> 
                      <input name="checkbox_<?php echo $rs->fields["id_estab"];?>" type="checkbox"  value="checkbox">                    </td>
                  </tr>
                  <?php 

     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_estab"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_estab"];
		         }
				//print $cadenacheckboxp;


	  	$rs->MoveNext();
	  	}
  	}
  	
  		
  ?>
                </table>
              </div>
              <p> 
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "n_estab";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_estab";?>">
                  <input type="hidden" name="location" value="<?php echo "../administracion/nomencladores/estab/l_estab.php";?>">
              </p>
              <p>&nbsp; </p></td>
          </tr>
        </table></td>
  </tr>
  </table>
   <table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Grupo de IPC 2010</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
<div id='menu1' class='portal' style="display:block; width: 200px; left: -3px; top: 340px;">
<div class="barra">

<table width="100" class="menubar" cellpadding="0" cellspacing="0" border="0">
                  <tr> 
                    <td class="menudottedline" align="right"> 
                    <table width="100%" border="0"  cellpadding="0" cellspacing="0"class="menubar" id="toolbar"  >
                        <tr  > 
                                                   
                          <td width="33%" > <div align="center"><a class="toolbar2" href="../estab/n_estab.php"><img src="../../../imagenes/menu/add_section.png" alt="Nuevo" name="new" width="16" height="16" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="33%" > <div align="center"> <a  onClick="modif('m_estab_m.php');" class="toolbar2" href="#"> 
                              <img   src="../../../imagenes/menu/edit.png" alt="Editar" width="16" height="16" border="0"> 
                      <br>
                              Editar</a> </div></td>
                          <td width="33%" > <div align="center"> <a class="toolbar2" href="#"> 
                          <img  onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/menu/trash.png" alt="Borrar" width="16" height="16" border="0"> 
                        
                              <br>
                              Borrar</a> </div></td>
                      </table></td>
                  </tr>
                </table>
 </div>
</div>
</form>
</body>
</html>
