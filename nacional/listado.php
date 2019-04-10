<?php 
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_editor.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; else $order=cod_prod;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];

if (!isset($order) && isset($_SESSION["order"])) $order = $_SESSION["order"];
if (!isset($ordtype) && isset($_SESSION["type"])) $ordtype = $_SESSION["type"];
if ($txt_filtro!='') $campo_filtro = "%" .$txt_filtro ."%";

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

//---------------------------------------------------
$query_fecha = "select max (distinct fecha) from dato_nacional where fecha>='".$fecha_base."'";
$rs_fecha_nac = $db->Execute($query_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_nac = $rs_fecha_nac->Fields('max');//print $x;
//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."'"; 
$sql_usuario = "select id_usuario,rol, cod_dpa from usuario".$query_usuario;		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
     
//$id_usuario=$rs_usuario->Fields("id_usuario");
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$query = "select id_captacion, variedad, obs,cod_var,variedad,cod_estab,dir,n_estab.cod_dpa, n_variedad.id_variedad, mercado, n_mercado.id_mercado, captacion.precio, captacion.fecha,captacion.imputado, captacion.id_usuario,usuario, nombre, apellidos,email,telef,usuario.cod_dpa,rol,ci,estab from captacion, usuario,n_dpa, n_obs, n_var_estab, b_variedad,n_variedad,n_mercado, n_estab where usuario.id_usuario=captacion.id_usuario and captacion.id_obs=n_obs.id_obs and captacion.id_var_estab=n_var_estab.id_var_estab and b_variedad.idb_variedad=n_var_estab.idb_variedad and n_variedad.id_variedad=b_variedad.id_variedad and n_mercado.id_mercado=b_variedad.id_mercado and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa=n_dpa.cod_dpa and usuario.cod_dpa='$cod_dpa' and b_variedad.central='1' 
and  captacion.fecha>='".$fecha_nac."'";
$rs= $db->Execute($query)or $mensaje=$db->ErrorMsg() ;
print $query ;
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
                          <td width="87%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Listado 
                            a nivel nacional de productos.</font></strong></td>
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
                <table width="97%" height="153"   align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<thead>
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
                          <table width="711" border="0" cellspacing="0" cellpadding="0" >
                            <tr> 
                              <td width="371"><strong><font color="#FFFFFF" size="1">Nota: 
                                </font></strong><font color="#FFFFFF" size="1">El 
                                listado muestra los precios promedios de los productos 
                                a nivel nacional con los &uacute;ltimos datos 
                                procesados.</font></td>
                              <td width="101"> <div align="right"><strong><font color="#FFFFFF" size="1">Filtro:</font></strong></div></td>
                              <td width="239"> <input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15"> 
                                <select  onChange="document.frm.submit();"  name="sel_filtro">
                                  <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                  <option value="<?php echo "dato_provincial.fecha" ?>"<?php if ($sel_filtro == "dato_provincial.fecha") { echo "selected"; } ?>><?php echo htmlspecialchars("Fecha de Cálculo") ?></option>
                                  <option value="<?php echo "dato_provincial.media_precios" ?>"<?php if ($sel_filtro == "dato_provincial.media_precios") { echo "selected"; } ?>><?php echo htmlspecialchars("Media Precios") ?></option>
                                  <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                                  <option value="<?php echo "n_dpa.cod_dpa" ?>"<?php if ($sel_filtro == "n_dpa.cod_dpa") { echo "selected"; } ?>><?php echo htmlspecialchars("Código DPA") ?></option>
                                  <option value="<?php echo "producto" ?>"<?php if ($sel_filtro == "producto") { echo "selected"; } ?>><?php echo htmlspecialchars("Producto") ?></option>
                                </select></td>
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
                      <td class="intro" width="2%" height="15">No</td>
                      <td width="10%" class="intro" >Mercado</td>
                      <td width="31%" class="intro" >Variedad</td>
                      <td width="10%" class="intro" >Usuario</td>
                      <td width="18%" class="intro" >Establecimiento</td>
                      <td width="12%" class="intro" >Precio Medio</td>
                      <td width="17%" class="intro" >Fecha</td>
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
                      <td  class="raya"align="center">&nbsp; </td>
                      
                      <td  class="raya"align="center"><?php echo substr($rs->fields["media_precios"],0,8);?></td>
                      <td width="17%"align="center"  class="raya"><a onMouseOver="return overlib('<?php if($rs->fields["calc"]==1) {echo "Fecha del cálculo: ".$rs->fields["fecha"];?>', ABOVE, RIGHT);" <?php } else {echo "Fecha de captación: <br>".$rs->fields["fecha"]; print"\', ABOVE, RIGHT); \""?> class="toolbar1" href="m_datos_editor.php?var_aux_mod=<?php echo $rs->fields["id_prov"];?>"<?php }?> onMouseOut="return nd();"><?php echo $mes;?></a></td>
                    </tr>
                    <?php 
	  	$rs->MoveNext();
	  	}
  	}
 } 	
 		
  ?>
                  </tbody>
                </table>
                <p>&nbsp;</p>
               
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
