<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="usuario.cod_dpa";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];

$query = "select * from usuario, n_dpa WHERE n_dpa.cod_dpa = usuario.cod_dpa";

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

<html>
<head>
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/azul.css" rel="stylesheet" type="text/css">
<link href="../../css/theme.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="javascript"   src="../../javascript/overlib_mini.js"></script>
<script language="JavaScript" src="../../javascript/theme.js" type="text/javascript"></script>
<script language="JavaScript" src="../../javascript/funciones.js" type="text/javascript">
var cabecera=window.screenTop

if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<body  >

<form method="post" name="frm" id="frm" action="">
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td> <table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
          <tr> 
            <td><img src="../../imagenes/banner.jpg" width="750" height="35"></td>
          </tr>
          <tr> 
            <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
              <tr> 
                <td class="menubackgr" style="padding-left:5px;"> <div id="myMenuID"></div>
                  <script language="javascript"  src="../../javascript/menu_super.js"></script> 
                </td>
                <td class="menubackgr"  valign="middle" align="right" > <a href="../../php/logout.php" style="color: #333333; font-weight: bold"> 
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
                          <td width="6%" valign="middle"  class="us"><img src="../../imagenes/admin/user.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="70%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Administración 
                            de usuarios </font></strong></td>
                          <td width="1%"> <div align="center"><a class="toolbar" href="n_usuario.php"><img src="../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="4%"> <div align="center"> <a  onClick="modif('m_usuario.php');" class="toolbar" href="#"> 
                              <img   src="../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <td width="4%"> <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../php/eliminar.php')" src="../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
                          <td width="5%"> <div align="center"> <a  class="toolbar" href="imp_usuario.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?> "   target="_blank"> 
                              <img   src="../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="10%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_usuario.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tabla" id="toolbar1">
                  <tr> 
                    <td colspan="11">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="middle"> 
                    <td  > <div align="right"> &nbsp;</div></td>
                    <td width="7%"  > 
                      <div align="right"> </div>
                    <div align="right">Filtro: </div></td>
                    <td width="15%"  >                       
                      <div align="left">
                        <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15">
                    </div></td>
                    <td width="20%"  ><div align="left">
                      <select  onchange="document.frm.submit();" class="combo" name="sel_filtro">
                        <option value="<?php echo "no" ?>">-Seleccionar-</option>
                        <option value="<?php echo "nombre" ?>"<?php if ($sel_filtro == "nombre") { echo "selected"; } ?>><?php echo htmlspecialchars("Nombre") ?></option>
                        <option value="<?php echo "ci" ?>"<?php if ($sel_filtro == "ci") { echo "selected"; } ?>><?php echo htmlspecialchars("Carnet") ?></option>
                        <option value="<?php echo "rol" ?>"<?php if ($sel_filtro == "rol") { echo "selected"; } ?>><?php echo htmlspecialchars("Rol") ?></option>
                        <option value="<?php echo "email" ?>"<?php if ($sel_filtro == "email") { echo "selected"; } ?>><?php echo htmlspecialchars("Email") ?></option>
                        <option value="<?php echo "usuario" ?>"<?php if ($sel_filtro == "usuario") { echo "selected"; } ?>><?php echo htmlspecialchars("Usuario") ?></option>
                        <option value="<?php echo "n_dpa.cod_dpa_nueva" ?>"<?php if ($sel_filtro == "n_dpa.cod_dpa_nueva") { echo "selected"; } ?>><?php echo htmlspecialchars("Código DPA") ?></option>
                      </select>
                    </div></td>
                    <td colspan="4"  ><div align="right"><a href="#">
                    
                        <?php
  					
  						$pager_nav->Render_Navegator();		?>
                        </a>
                        <?php
				  		echo "&nbsp;&nbsp;<b>Página :</b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];	
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
  </select>
  
                    </div></td>
                  </tr>
                  <tr> 
                    <td colspan="11">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="4%" height="21">No</td>
                    <td class="intro" width="7%"><a href="l_usuario.php?order=<?php echo "baja" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Baja</a></td>
                    <td colspan="2" class="intro" ><a href="l_usuario.php?order=<?php echo "nombre" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Nombre 
                      y Apellidos</a></td>
                    <td class="intro" width="18%" ><a href="l_usuario.php?order=<?php echo "rol" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Rol</a></td>
                    <td class="intro" width="12%"><a href="l_usuario.php?order=<?php echo "usuario.cod_dpa" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Código 
                    DPA </a></td>
                    
                    <td class="intro" width="20%"><a href="l_usuario.php?order=<?php echo "email" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">E-Mail</a></td>
                    <td class="intro" width="4%" >&nbsp; </td>
                  </tr>
                  <?php
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >  
                    <td class="raya" height="22" align="center"> 
                      <?php $a=$pager_nav->index_rs++; echo $a; ?></td>
                      <td class="raya"align="center"><a class="toolbar1" href="m_usuario.php?var_aux_mod=<?php echo $rs->fields["id_usuario"];?>">
					  <?php  if($rs->fields["baja"]!=1) {?>
                      <img border="0" src="../../imagenes/tick.png"> 
                      <?php } else {?>
                      <img border="0" src="../../imagenes/publish_x.png"> 
                      <?php }?></a></td>
                    <td class="raya"colspan="2"  align="center"><a onMouseOver="return overlib('<?php echo "Usuario: ".$rs->fields["usuario"];echo "<br>CI: ".$rs->fields["ci"]."<BR> Teléfono: ".$rs->fields["telef"];?>', ABOVE, RIGHT);" onMouseOut="return nd();"class="toolbar1" href="m_usuario.php?var_aux_mod=<?php echo $rs->fields["id_usuario"];?>"><?php echo $rs->fields["nombre"];?>&nbsp;<?php echo $rs->fields["apellidos"]; ?></a></td>
                    <td  class="raya"align="center"> <a class="toolbar1" href="m_usuario.php?var_aux_mod=<?php echo $rs->fields["id_usuario"];?>">
                      <?php if($rs->fields["rol"]=="invit")
												print "Invitado";
												elseif($rs->fields["rol"]=="admin")
												print "Administrador";
												elseif($rs->fields["rol"]=="autor")
												print "Autor Municipal";
												elseif($rs->fields["rol"]=="aut_p")
												print "Autor Provincial";
												elseif($rs->fields["rol"]=="edito")
												print "Editor";
												elseif($rs->fields["rol"]=="jefes")
												print "Directivo";
												elseif($rs->fields["rol"]=="super")
												print "SA";
										?></a>                    </td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo $rs->fields["prov_mun"]; ?>', ABOVE, RIGHT);" onMouseOut="return nd();"class="toolbar1" href="m_usuario.php?var_aux_mod=<?php echo $rs->fields["id_usuario"];?>"><?php echo $rs->fields["cod_dpa_nueva"];?></a></td>
                    
                    <td class="raya"align="center"><a class="toolbar1" href="mailto:<?php echo $rs->fields["email"];?>"><?php echo $rs->fields["email"];?></a></td>
                    <td class="raya"align="center" valign="middle"> <input  name="checkbox_<?php echo $rs->fields["id_usuario"];?>" type="checkbox"  value="checkbox">                    </td>
                  </tr>
                  <?php 

     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_usuario"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_usuario"];
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
                <input type="hidden" name="tabla" value="<?php echo "usuario";?>">
                <input type="hidden" name="campo" value="<?php echo "id_usuario";?>">
                <input type="hidden" name="location" value="<?php echo "../administracion/usuarios/l_usuario.php";?>">
              </p>
              <br></td>
          </tr>
        </table></td>
  </tr>
  </table>
   <table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Grupo de IPC 2010</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</form>
</body>
</html>
