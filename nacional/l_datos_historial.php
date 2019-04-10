<?php 
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_invitado.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];


$query = "select id_nac,frecuencia, producto, cod_prod, n_producto.id_producto, mercado, n_mercado.id_mercado, media_precios,calc, fecha, id_usuario
from dato_nacional, n_producto, n_mercado
where n_producto.id_producto=dato_nacional.id_producto AND (n_mercado.id_mercado=dato_nacional.id_mercado)";

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
<link href="../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../javascript/cal2.js"></script>
<script language="javascript" src="../javascript/cal_conf2.js"></script>
<script language="javascript" src="../javascript/overlib_mini.js"></script>

<script src="../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../imagenes/banner.jpg" width="750" height="35"></td>
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
<script language="javascript"  src="../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../javascript/menu_invitado.js">	
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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../imagenes/extrasmall/exit.gif">
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
                          <td width="7%" valign="middle"  class="us"><img src="../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="87%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Historial 
                            a nivel nacional.</font></strong></td>
                          <td width="1%"> 
                            <div align="center"> <a  class="toolbar" href="imp_datos_historial.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="5%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../help/l_datos_historial_nacional_historial.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="97%"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">

                    <tr align="center" valign="middle"> 
                      <td height="39" colspan="15"  > <div align="right"> 
                          <p><a href="#"> 
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
                              <option value="100" <?php if($ver==100){?>selected="selected" <?php } ?>>100</option><option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
  </select>
                          </p>
                          <table width="680" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                              <td width="372"><strong><font color="#FFFFFF" size="1">Nota: 
                                </font></strong><font color="#FFFFFF" size="1">El 
                                listado muestra un hist&oacute;rico de los precios 
                                promedios de los productos a nivel nacional de 
                                todas las canastas.</font></td>
                              <td width="57"> 
                              <div align="right"><strong><font color="#FFFFFF" size="1">Filtro:</font></strong></div></td>
                              <td width="251"> 
                                <div align="left">
                                  <input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15">
                                  <select  onChange="document.frm.submit();"  name="sel_filtro">
                                    <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                    <option value="<?php echo "dato_nacional.fecha" ?>"<?php if ($sel_filtro == "dato_nacional.fecha") { echo "selected"; } ?>><?php echo htmlspecialchars("Fecha de Cálculo") ?></option>
                                    <option value="<?php echo "dato_nacional.media_precios" ?>"<?php if ($sel_filtro == "dato_nacional.media_precios") { echo "selected"; } ?>><?php echo htmlspecialchars("Media Precios") ?></option>
                                    <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                                    <option value="<?php echo "producto" ?>"<?php if ($sel_filtro == "producto") { echo "selected"; } ?>><?php echo htmlspecialchars("Producto") ?></option>
                                  </select>
                                </div></td>
                            </tr>
                          </table>
                        </div></td>
                    </tr>
                    <tr> 
                      <td height="12">&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                      <td align="center" valign="middle"  >&nbsp;</td>
                    </tr>
                    <tr align="center" valign="center"  > 
                      <td class="intro" width="3%" height="20">No</td>
                      <td width="9%" class="intro" ><a href="l_datos_historial.php?order=<?php echo "mercado" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Mercado 
                        </a></td>
                      <td width="31%" class="intro" ><a href="l_datos_historial.php?order=<?php echo "producto" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Producto 
                        </a></td>
                      <td width="10%" class="intro" ><a href="l_datos_historial.php?order=<?php echo "id_usuario" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Usuario 
                        </a></td>
                      <td width="9%" class="intro" ><a href="l_datos_historial.php?order=<?php echo "frecuencia" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Frecuencia</a></td>
                      <td width="11%" class="intro" ><a href="l_datos_historial.php?order=<?php echo "media_precios" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>"> 
                        Precio Medio</a></td>
                      <td width="14%" class="intro" ><a href="l_datos_historial.php?order=<?php echo "fecha" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Fecha 
                        </a></td>
                    </tr>
                 
                    <?php
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{
		
					
					if($rs->fields["id_usuario"]!='')
					{
					$sql_usuario="select usuario, nombre, apellidos,rol,email,telef from usuario where id_usuario='".$rs->fields["id_usuario"]."'";
					$rs_usuario=$db->Execute($sql_usuario) or die($db->ErrorMsg());
					}
										
					$fecha=$rs->fields["fecha"];
					$mes_actual=substr($fecha,5,2);
					//$mes_actual=$mes_actual-1;//print $mes_actual;
					
					$ano_actual=substr($fecha,0,4);
					
					switch ($mes_actual) {   
						 case 2:  $mes="Enero"."-".$ano_actual;   break;
						 case 3:  $mes="Febrero"."-".$ano_actual; break;
						 case 4:  $mes="Marzo"."-".$ano_actual;   break;
						 case 5:  $mes="Abril"."-".$ano_actual;   break;
						 case 6:  $mes="Mayo"."-".$ano_actual;    break;
						 case 7:  $mes="Junio"."-".$ano_actual;   break;
						 case 8:  $mes="Julio"."-".$ano_actual;   break;
						 case 9:  $mes="Agosto"."-".$ano_actual;  break;
						 case 10:  $mes="Septiembre"."-".$ano_actual;  break;
						 case 11: $mes="Octubre"."-".$ano_actual; break;
						 case 12: $mes="Noviembre"."-".$ano_actual;   break;
						 case 1: $ano_actual=$ano_actual-1; $mes="Diciembre"."-".$ano_actual;   break;
					 }

  ?>
                    <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?>> 
                      <td height="26"  align="center" class="raya"> 
                        <?php $a=$pager_nav->index_rs++; echo $a; ?>
                      </td>
                      <td  class="raya" align="center"><?php echo $rs->fields["mercado"];?></td>
                      <td  class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Código: ".$rs->fields["cod_prod"];?>', ABOVE, RIGHT);" onMouseOut="return nd();"><?php echo $rs->fields["producto"];?></a></td>
                       <td  class="raya"align="center"><a onMouseOver="return overlib('<?php if($rs_usuario->fields["rol"]=="edito") {$telef_rol=$rs_usuario->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >"; 
 }elseif($rs_usuario->fields["rol"]=="aut_p")
{$telef_rol=$rs_usuario->fields["telef"]."<br>Rol: Autor Provincial";}
elseif($rs_usuario->fields["rol"]=="autor")
{$telef_rol=$rs_usuario->fields["telef"]."<br>Rol: Autor Municipal";}
echo $rs_usuario->fields["nombre"]." ".$rs_usuario->fields["apellidos"]."<br>E-mail: ".$rs_usuario->fields["email"]."<br>Teléfono: ".$telef_rol;?>', ABOVE, RIGHT);"onMouseOut="return nd();" class="toolbar1"href="m_datos_editor.php?var_aux_mod=<?php echo $rs->fields["id_captacion"];?>"><?php echo $rs_usuario->fields["usuario"];?></a></td>
                      
                      <td  class="raya"align="center">
                        <?php if($rs->fields["frecuencia"]!="")echo $rs->fields["frecuencia"];else print "-";?>
                      </td>
                     
                      <td  class="raya"align="center"><?php echo substr($rs->fields["media_precios"],0,8);?></td>
                      
                        
                      <td width="6%"align="center"  class="raya"><a onMouseOver="return overlib('<?php if($rs->fields["calc"]==1) {echo "Fecha del cálculo: ".$rs->fields["fecha"];?>', ABOVE, RIGHT);" <?php } else {echo "Fecha de captación: <br>".$rs->fields["fecha"]; print"\', ABOVE, RIGHT); \""?> class="toolbar1" href="m_datos_editor.php?var_aux_mod=<?php echo $rs->fields["id_prov"];?>"<?php }?> onMouseOut="return nd();"><?php echo $mes;?></a></td>
                      
                    </tr>
                    <?php 
	  	$rs->MoveNext();
	  	}
  	}
  	
 		
  ?>
                 
                </table>
                <p>&nbsp;</p>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "entrada_municipal";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_captacion";?>">
                  <input type="hidden" name="location" value="<?php echo "../municipal/l_datos_historial.php";?>">
                </p>
              </div>
              </form>
      <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
