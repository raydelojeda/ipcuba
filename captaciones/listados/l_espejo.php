<?php 
$locat="l_espejo.php";
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");


if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}


if($_POST['txt_ir'])
{//print "sds";
header("Location:l_datos_m.php?curr_page=".$_POST['txt_ir']."&order=".$order."&type=".$ordtype."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa."&sel_mes=".$sel_mes."&sel_ano=".$sel_ano."&porc=".$porc);
}
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="captacion.fecha";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=desc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];

$array=array("Domingo de la 1ra semana","Lunes de la 1ra semana","Martes de la 1ra semana","Miércoles de la 1ra semana","Juéves de la 1ra semana","Viérnes de la 1ra semana","Sábado de la 1ra semana","Domingo de la 2da semana","Lunes de la 2da semana","Martes de la 2da semana","Miércoles de la 2da semana","Juéves de la 2da semana","Viérnes de la 2da semana","Sábado de la 2da semana","Domingo de la 3ra semana","Lunes de la 3ra semana","Martes de la 3ra semana","Miércoles de la 3ra semana","Juéves de la 3ra semana","Viérnes de la 3ra semana","Sábado de la 3ra semana","Domingo de la 4ta semana","Lunes de la 4ta semana ","Martes de la 4ta semana","Miercoles de la 4ta semana","Jueves de la 4ta semana","Viérnes de la 4ta semana","Sábado de la 4ta semana",);


$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-1","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

//---------------------------------------------------
/*$query_fecha = "select max (distinct fecha) from dato_provincial where fecha>='".$fecha_base."'";
$rs_fecha_prov = $db->Execute($query_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_prov = $rs_fecha_prov->Fields('max');//print $x;*/
//---------------------------------------------------
//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
//print 	$sql_usuario;
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;

$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");
//print $cod_dpa;
//---------------------------------------------------

$f=date("Y/m/d");
$mes=substr($f,4,4);
$año=substr($f,0,4);
$mes_actual=$año.$mes."01";
//$query="select * from cap_s_m";
//print $mes_actual;
$query = "select n_estab.id_mercado, mercado, captacion.id_var_estab, n_var_estab.idb_variedad, n_var_estab.id_estab,
 n_dpa.cod_dpa_nueva, b_variedad.id_variedad, precio_s_m, cap_s_m.id_usuario, fecha_m, cant_s_m, id_unidad_s_m,
  cap_s_m.id_cap, id_s_m, variedad, captacion.id_obs, cod_estab, variedad,cod_var, 
  carac1,carac2,carac3,carac4,carac5,carac6, 
  
  estab, n_estab.id_tipologia, dir, nombre, apellidos, rol, telef, email, fecha_captar, 
  
  captacion.valor1 as val1, captacion.valor2 as val2, captacion.valor3 as val3, captacion.valor4 as val4,
  captacion.valor5 as val5, captacion.valor6 as val6, captacion.cant,captacion.cap_uni, 
  
  usuario, unidad, obs, prov_mun_nuevo, cont_imp  
  from n_mercado, n_estab, n_var_estab, b_variedad, n_variedad, captacion, n_dpa, cap_s_m, usuario, 
  n_obs, n_tipologia, n_unidad where n_mercado.id_mercado = n_estab.id_mercado 
  and n_estab.id_estab=n_var_estab.id_estab and n_tipologia.id_tipologia=n_estab.id_tipologia 
  and n_estab.cod_dpa=n_dpa.cod_dpa and n_var_estab.id_var_estab=captacion.id_var_estab 
  and n_unidad.id_unidad=cap_s_m.id_unidad_s_m and n_var_estab.idb_variedad=b_variedad.idb_variedad 
  and captacion.id_cap=cap_s_m.id_cap 
  and captacion.id_obs=n_obs.id_obs 
  and cap_s_m.id_usuario=usuario.id_usuario 
  and b_variedad.id_variedad=n_variedad.id_variedad 
  and central='0' and incluido='1'";
 

 
   if($rol=='aut_p') 
   {$query=$query."  and n_estab.cod_dpa like '".$cod_dpa2."'";}
   elseif($rol=='autor')
   {$query=$query."  and n_estab.cod_dpa='".$cod_dpa."'";}
   elseif($rol=='admin' || $rol=='super' || $rol=='edito')
   {if($_POST['sel_cod_dpa']!=0)
    $query .= "and n_dpa.cod_dpa='".$_POST['sel_cod_dpa']."'"; 
   }
   		

//print $query;


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


//print $mes;
if($mes=="/01/")$fecha_text= "Enero";
if($mes=="/02/")$fecha_text= "Febrero";
if($mes=="/03/")$fecha_text= "Marzo";
if($mes=="/04/")$fecha_text= "Abril";
if($mes=="/05/")$fecha_text= "Mayo";
if($mes=="/06/")$fecha_text= "Junio";
if($mes=="/07/")$fecha_text= "Julio";
if($mes=="/08/")$fecha_text= "Agosto";
if($mes=="/09/")$fecha_text= "Septiembre";
if($mes=="/10/")$fecha_text= "Octubre";
if($mes=="/11/")$fecha_text= "Noviembre";
if($mes=="/12/")$fecha_text= "Diciembre";

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
                          <td width="6%" valign="middle"  class="us"><img src="../../imagenes/admin/news.png" width="48" height="48" border="0"></td>
                          <td width="90%" valign="middle"  class="us"><strong><font color="#5A697E" size="2">Listado
                                 de captaciones antiguas con modificaciones donde las captaciones actuales han tenido cambios de cantidad o unidades</font></strong></td>
                          <td > 
                            <div align="center"> <a  class="toolbar" href="../../administracion/nomencladores/general/imp_datos.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../../imagenes/admin/print_f2.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Imprimir</a> </div></td> 
                            
                          <?php if($rol=="admin") {?>
                          <?php }?>
                          <td > 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('help/l_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="50"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<tr align="center" valign="middle"> 
                    <td height="50" colspan="21"  > 
                      <table width="692" height="57" border="0" cellpadding="0" cellspacing="0" class="filtro" >
<tr>
  <td height="20" colspan="2">
      <div align="right">
        <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
        DPA:
        <?php }?>      
        &nbsp;
        <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
        <select name="sel_cod_dpa" title="C&oacute;digo Producto" id="sel_cod_dpa" onChange="document.frm.submit();" >
          <option value="0">---------CUBA---------</option>
          <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$_POST['sel_cod_dpa'];
						include($x."php/selected.php");
						?>
          </select>
            </div></td>
  </tr>
<tr> 
                            <td height="20"> 
                              <div align="right">Filtro: 
<input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15">
<select  onChange="document.frm.submit();"  name="sel_filtro">
                                  <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                  <option value="<?php echo "mercado" ?>"<?php if ($sel_filtro == "mercado") { echo "selected"; } ?>><?php echo htmlspecialchars("Mercado") ?></option>
                        <option value="<?php echo "ecod_var" ?>"<?php if ($sel_filtro == "ecod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Código Variedad") ?></option>
                        <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
                        <option value="<?php echo "cod_estab" ?>"<?php if ($sel_filtro == "cod_estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Estab.") ?></option>
                        <option value="<?php echo "estab" ?>"<?php if ($sel_filtro == "estab") { echo "selected"; } ?>><?php echo htmlspecialchars("Establecimiento") ?></option>
                        <option value="<?php echo "tipologia" ?>"<?php if ($sel_filtro == "tipologia") { echo "selected"; } ?>><?php echo htmlspecialchars("Tipologia") ?></option>
                          <option value="<?php echo "usuario" ?>"<?php if ($sel_filtro == "usuario") { echo "selected"; } ?>><?php echo htmlspecialchars("Usuario") ?></option>
                                </select>
</div></td>
                          <td  align="center">
							
                              <div align="right"><a  href="#" onClick="javascript: document.frm.submit();">Ir: </a>
                                <input  name="txt_ir" type="text" class="combo" value="" size="3" >
                                <a href="#">
                                <?php }?>
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
</select>
&nbsp; </div></td>
                        </tr>
                    </table>                    </td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="17" height="20">No</td>
                    <td width="19" class="intro" ><a href="l_espejo.php?order=<?php echo "mercado" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">M</a></td>
                    <td width="181" class="intro" ><div align="center"><a href="l_espejo.php?order=<?php echo  "variedad";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Variedad</a></div></td>
                    <td width="162" class="intro" ><a href="l_espejo.php?order=<?php echo "estab";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Establecimiento</a></td>
                    <td width="50" class="intro" ><a href="l_espejo.php?order=<?php echo "precio_s_m";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Precio anterior</a></td>
                    <?php if($rol!="autor") {?> <td width="48" class="intro" ><a href="l_espejo.php?order=<?php echo "cod_dpa";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Cod DPA</a></td>
                    <?php }?>
                    <td width="54" class="intro" ><a href="l_espejo.php?order=<?php echo "usuario";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Usuario</a></td>
                    <td width="75" class="intro" ><a href="l_espejo.php?order=<?php echo "fecha_m";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Fecha de modificación
                        </a></td>
                    <td width="57" class="intro" ><a href="l_espejo.php?order=<?php echo "cant_s_m";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">Cantidad anterior </a></td>
                    <td  class="intro" ><a href="l_espejo.php?order=<?php echo "unidad";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_mes=<?php echo $sel_mes;?>&sel_ano=<?php echo $sel_ano;?>">U/M anterior </a></td>
                    <td width="25" class="intro" >
                    <?php if($rol=="admin") {?> <input name="checkbox" onClick="marcar();" type="checkbox">
                     <?php }else print "&nbsp;";?></td>
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
		 
			
		  $inc=$rs->fields["inc"];
		  $id_inc=$rs->fields["id_inc"];
		  $obs=$rs->fields["obs"];
		  $cont_imp=$rs->fields["cont_imp"];
  ?>
                  <tr  height="20" <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                    <td align="center" class="raya">
                      <?php  echo $a; ?>
                      </a></td>
                    <td  class="raya" align="center"><a onMouseOver="return overlib('<?php echo $rs->fields["mercado"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo substr($rs->fields["mercado"],0,1);?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$rs->fields["ecod_var"];
					  echo "<br><b> UM: </b>".$rs->fields["cant"]." ".$rs->fields["cap_uni"];
					  if($rs->fields["carac1"]) {echo "<br><b> ".$rs->fields["carac1"].": </b>".$rs->fields["val1"];}
					  if($rs->fields["carac2"]) {echo "<br><b> ".$rs->fields["carac2"].": </b>".$rs->fields["val2"];}
					  if($rs->fields["carac3"]) {echo "<br><b> ".$rs->fields["carac3"].": </b>".$rs->fields["val3"];}
					  if($rs->fields["carac4"]) {echo "<br><b> ".$rs->fields["carac4"].": </b>".$rs->fields["val4"];}
					  if($rs->fields["carac5"]) {echo "<br><b> ".$rs->fields["carac5"].": </b>".$rs->fields["val5"];}
					  if($rs->fields["carac6"]) {echo "<br><b> ".$rs->fields["carac6"].": </b>".$rs->fields["val6"];}
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["variedad"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Código Establecimiento: ".$rs->fields["cod_estab"]."<br>Dirección: ".$rs->fields["dir"]."<br>Código DPA: ".$rs->fields["cod_dpa"]."<br>Tipología: ".$rs->fields["tipologia"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["estab"];?></a></td>
                    <td align="center"  class="raya"><a onMouseOver="return overlib('<?php if($cont_imp)print "<br><b>Precio imputado</b>";else echo $rs->fields["obs"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" <?php if($min >= $pre || $pre >= $max){ print "class=\"raya_roja\"";}?>class="toolbar1" href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["precio_s_m"];?></a></td>
                     
					 <?php if($rol!="autor") {?>
                     <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "DPA: ".$rs->fields["prov_mun_nuevo"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["cod_dpa_nueva"];?></a></td>
                     <?php }?>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php 
if($rs->fields["rol"]=="edito") 
{$telef_rol=$rs->fields["telef"]."<br>Rol: Editor-ONE"; print "<img src=../imagenes/menu/edit.png border=0 >";}
elseif($rs->fields["rol"]=="aut_p")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Provincial";}
elseif($rs->fields["rol"]=="autor")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Autor Municipal";} elseif($rs->fields["rol"]=="admin")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Administrador";} elseif($rs->fields["rol"]=="super")
{$telef_rol=$rs->fields["telef"]."<br>Rol: Super Administrador";}

echo $rs->fields["nombre"]." ".$rs->fields["apellidos"]."<br>E-mail: ".$rs->fields["email"]."<br>Teléfono: ".$telef_rol;?>', ABOVE, RIGHT);"onMouseOut="return nd();" class="toolbar1"href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php echo $rs->fields["usuario"];?></a></td>
                    <td class="raya"align="center"><a onMouseOver="return overlib('<?php echo "Día a captar: ".$d=substr($rs->fields["fecha_captar"],8,9);?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" href="../../administracion/nomencladores/general/m_datos.php?var_aux_mod=<?php echo $rs->fields["id_cap"];?>&curr_page=<?php print $pager_nav->curr_page;?>&regis_cant=<?php print $var;?>"><?php print $rs->fields["fecha_m"];//print $fecha_text;?></a></td>
                    <td class="raya"align="center"><?php print $rs->fields["cant_s_m"]?></td>
                    <td width="53"align="center" class="raya"><?php print $rs->fields["unidad"]?></td>
                  
                    <td  align="center" class="raya" > <input name="checkbox_<?php echo $rs->fields["id_cap"];?>" type="checkbox"  value="checkbox">                    </td>
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
                  <input type="hidden" name="location" value="<?php echo "../captaciones/autor/l_datos_m.php";?>">
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
