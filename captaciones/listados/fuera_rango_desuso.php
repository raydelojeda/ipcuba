<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");
if($_POST['txt_ir'])
{//print "sds";
header("Location:fuera_rango.php?curr_page=".$_POST['txt_ir']);
}
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="captacion.fecha";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=desc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];


//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

//---------------------------------------------------
$query_fecha = "select max (distinct fecha) from dato_provincial where fecha>='".$fecha_base."'";
$rs_fecha_prov = $db->Execute($query_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_prov = $rs_fecha_prov->Fields('max');//print $x;
//---------------------------------------------------
//---------------------------------------------------
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
//print $cod_dpa;
//---------------------------------------------------

$f=date("Y/m/d");
$mes=substr($f,4,4);
$año=substr($f,0,4);
$mes_actual=$año.$mes."01";

$query = "select captacion.id_var_estab,id_cap, variedad, obs,ecod_var, n_variedad.id_variedad, cod_estab,dir,n_estab.cod_dpa, estab, prov_mun, mercado, n_mercado.id_mercado, captacion.precio, captacion.fecha, captacion.id_usuario, nombre, usuario, apellidos, ci, rol, telef, email, b_variedad. ,b_variedad.p_max,inc,captacion.id_inc,

captacion.valor1,captacion.valor2,captacion.valor3,captacion.valor4,captacion.valor5,captacion.valor6,
carac1,carac2,carac3,carac4,carac5,carac6, unidad 

from captacion, usuario,n_dpa, n_obs, n_var_estab, b_variedad,n_variedad,n_mercado, n_estab,n_articulo, n_unidad ,n_inc

where n_unidad.id_unidad=n_var_estab.id_unidad and n_articulo.id_articulo=n_variedad.id_articulo and usuario.id_usuario=captacion.id_usuario and captacion.id_obs=n_obs.id_obs and captacion.id_var_estab=n_var_estab.id_var_estab and b_variedad.idb_variedad=n_var_estab.idb_variedad and 
captacion.id_inc=n_inc.id_inc and
n_variedad.id_variedad=b_variedad.id_variedad and n_mercado.id_mercado=b_variedad.id_mercado and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa=n_dpa.cod_dpa 
and n_inc.id_inc='1' and (n_obs.id_obs='6' or n_obs.id_obs='4')
and  captacion.fecha>='".$fecha_base."' and ( >captacion.precio or captacion.precio>p_max) and captacion.fecha>='".$mes_actual."'";
//print $query;



 if($rol!='admin' && $rol!="edito")
 {
   if($rol=='aut_p') 
   {$query=$query." and b_variedad.central!='1' and n_estab.cod_dpa like '".$cod_dpa2."%'";}
   else
   $query=$query." and b_variedad.central='0' and n_estab.cod_dpa='".$cod_dpa."'";
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
$rs = $pager_nav->curr_rs;
//print $rs;

$mes= date("m");
if($mes=="01")$fecha_text= "Enero";
if($mes=="02")$fecha_text= "Febrero";
if($mes=="03")$fecha_text= "Marzo";
if($mes=="04")$fecha_text= "Abril";
if($mes=="05")$fecha_text= "Mayo";
if($mes=="06")$fecha_text= "Junio";
if($mes=="07")$fecha_text= "Julio";
if($mes=="08")$fecha_text= "Agosto";
if($mes=="09")$fecha_text= "Septiembre";
if($mes=="10")$fecha_text= "Octubre";
if($mes=="11")$fecha_text= "Noviembre";
if($mes=="12")$fecha_text= "Diciembre";
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
<link href="../../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../javascript/cal2.js"></script>
<script language="javascript" src="../../javascript/cal_conf2.js"></script>
<script language="javascript" src="../../javascript/overlib_mini.js"></script>

<script src="../../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../../imagenes/banner.jpg" width="750" height="35"></td>
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
<script language="javascript"  src="../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../javascript/menu_invitado.js">	
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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../imagenes/extrasmall/exit.gif">
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
                          <td width="6%" valign="middle"  class="us"><img src="../../imagenes/admin/news.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="64%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Captaciones fuera de rango <?php if($rol!="admin" && $rol!="edito")echo "de ".$prov_mun;?> en el mes de <?php echo $fecha_text;?></font></strong></td>
                          <td width="0%"> 
                         <div align="center"><a class="toolbar" href="../autor/n_datos.php"><img src="../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td> 
                            
                          <td width="4%"> 
<div align="center"> <a  onClick="modif('m_datos.php');" class="toolbar" href="#"> 
                              <img   src="../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <?php if($rol=="admin" || $rol=="edito") {?>
                          <td > 
                             <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../php/eliminar.php');" src="../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
						<?php }?>
                          <td width="5%"> 
                            <div align="center"><a class="toolbar" href="../autor/n_captaciones.php">
                              <img   src="../../imagenes/admin/switch_f2.png" alt="Captaciones faltantes" width="32" height="32" border="0"> 
                              <br>
                          Faltantes</a> </div></td>
                          <td width="5%"> 
                            <div align="center"> <a  class="toolbar" href="../autor/imp_datosf.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="12%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('help/l_datosf.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="97%" height="50"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<tr align="center" valign="middle"> 
                    <td height="39" colspan="18"  > 
                        <table width="713" height="20" border="0" cellpadding="0" cellspacing="0" class="filtro" >
<tr> 
                            <td width="263" height="20"> 
                              <div align="right">Filtro: 
<input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15">
<select  onChange="document.frm.submit();"  name="sel_filtro">
                                  <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                  <option value="<?php echo "captacion.fecha" ?>"<?php if ($sel_filtro == "captacion.fecha") { echo "selected"; } ?>><?php echo htmlspecialchars("Fecha digitada") ?></option>
                                  <option value="<?php echo "captacion.precio" ?>"<?php if ($sel_filtro == "captacion.precio") { echo "selected"; } ?>><?php echo htmlspecialchars("Precio") ?></option>
                                  <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                                  <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                                </select>
</div></td>
                            <td width="98"  align="right"><a  href="#" onClick="javascript: document.frm.submit();">Ir: </a>
                              <input  name="txt_ir" type="text" class="combo" value="" size="3" ></td>
                        <td width="352"  align="center"><div align="right"><a href="#">
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
                        </div>&nbsp;</td>
                        </tr>
                      </table>
                        
                    </td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="23" height="20">No</td>
                    <td width="56" class="intro" ><a href="fuera_rango.php?order=<?php echo "mercado" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Inc/Obs</a></td>
                    <td width="231" class="intro" ><a href="fuera_rango.php?order=<?php echo "variedad" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Variedad</a></td>
                    <td width="121" class="intro" ><a href="fuera_rango.php?order=<?php echo "estab" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Establecimiento</a></td>
                    <td width="58" class="intro" ><a href="fuera_rango.php?order=<?php echo "precio" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Precio</a></td>
                    <td width="55" class="intro" ><a href="fuera_rango.php?order=<?php echo "cod_dpa" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Cod DPA</a></td>
                    
                    <td width="59" class="intro" ><a href="fuera_rango.php?order=<?php echo "usuario" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Usuario</a></td>
                    <td width="98" class="intro" ><a href="fuera_rango.php?order=<?php echo "fecha_captar" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Fecha digitada</a></td>
                    <td width="25" class="intro" >
                      <?php if($rol=="admin") {?> <input name="checkbox" onClick="marcar();" type="checkbox">
                   <?php }else print "&nbsp;";?> </td>
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
						
                       
				  $pre=$rs->fields["precio"];
				  $min=$rs->fields[" "];
				  $max=$rs->fields["p_max"];
				  
				  $inc=$rs->fields["inc"];
				  $id_inc=$rs->fields["id_inc"];
				  $obs=$rs->fields["obs"];
			   ?>	
							
                  <tr  height="20" <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                   <td align="center" class="raya"><a  class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"> 
                      <?php  echo $a; ?>
                      </a></td>
                    <td  class="raya" align="center"><a onMouseOver="return overlib('<?php if($id_inc!=1)echo $inc;else print $obs;print "<br>";echo $rs->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php if($id_inc!=1)echo substr($inc,0,2);else print substr($obs,0,2);?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$rs->fields["ecod_var"];
					  if($rs->fields["ecod_var"]) {echo "<br><b> UM: </b>".$rs->fields["unidad"];}
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$rs->fields["valor1"];}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$rs->fields["valor2"];}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$rs->fields["valor3"];}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$rs->fields["valor4"];}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$rs->fields["valor5"];}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$rs->fields["valor6"];}
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><?php echo $rs->fields["variedad"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Código Establecimiento: ".$rs->fields["cod_estab"]."<br>Dirección: ".$rs->fields["dir"]."<br>Código DPA: ".$rs->fields["cod_dpa"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><?php echo $rs->fields["estab"];?></a></td>
                    <td align="center"  class="raya"><a onMouseOver="return overlib('<?php echo "Mín: ".$min."$  Máx: ".$max."$     CUP";?>', ABOVE, RIGHT);" onMouseOut="return nd();" <?php if($min >= $pre || $pre >= $max){ print "class=\"raya_roja\"";}?> href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><?php echo $rs->fields["precio"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "DPA: ".$rs->fields["prov_mun"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><?php echo $rs->fields["cod_dpa"];?></a></td>
                    
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php 
if($rs->fields["rol"]=="edito") 
{$telef_rol=$rs->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
elseif($rs->fields["rol"]=="aut_p")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Provincial";}
elseif($rs->fields["rol"]=="autor")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Municipal";} elseif($rs->fields["rol"]=="admin")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Administrador";} elseif($rs->fields["rol"]=="super")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Super Administrador";}

echo $rs->fields["nombre"]." ".$rs->fields["apellidos"]."<br>E-mail: ".$rs->fields["email"]."<br>Teléfono: ".$telef_rol;?>', ABOVE, RIGHT);"onMouseOut="return nd();" class="toolbar1"href="../editor/m_datos_editor.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><?php echo $rs->fields["usuario"];?></a></td>
                    <td class="raya"align="center"><a class="toolbar1" href="../autor/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>"><?php echo $rs->fields["fecha"];?></a></td>
                    <td  align="center" class="raya" > <input name="checkbox_<?php echo $rs->fields["id_cap"];?>" type="checkbox"  value="checkbox"> 
                    </td>
                  </tr>
                  <?php 
					
     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_cap"];
		       	 }
				 elseif($rs->fields["id_cap"]!='')
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_cap"];
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
                  <input type="hidden" name="tabla" value="<?php echo "captacion";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_cap";?>">
                  <input type="hidden" name="location" value="<?php echo "../captaciones/autor/fuera_rango.php";?>">
                </p>
              </div>
              </form>
      <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
