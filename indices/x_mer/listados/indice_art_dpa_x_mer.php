<?php 
$locat="indice_art_dpa.php";
$x="../../../";
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
header("Location:indice_art_dpa.php?curr_page=".$_POST['txt_ir']."&order=".$order."&type=".$ordtype."&txt_filtro=".$txt_filtro."&sel_filtro=".$sel_filtro."&ver=".$ver."&sel_cod_dpa=".$sel_cod_dpa."&sel_mes=".$sel_mes."&sel_ano=".$sel_ano."&porc=".$porc);
}
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="d_art_dpa.indice";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=desc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];

if ($_GET["sel_ano"]!="") $sel_ano = $_GET['sel_ano'];
if (isset($_POST["sel_ano"])) $sel_ano = $_POST['sel_ano'];
if ($_GET["sel_mes"]!="") $sel_mes = $_GET['sel_mes'];
if (isset($_POST["sel_mes"])) $sel_mes = $_POST['sel_mes'];
if ($_GET["sel_moneda"]!="") $sel_moneda = $_GET['sel_moneda'];
if (isset($_POST["sel_moneda"])) $sel_moneda = $_POST['sel_moneda'];


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

if($ver=="")
$ver=50;

if($sel_mes!=0 and $sel_ano!=0)
{
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
$fecha_cierre_sem4_1=substr($fecha_base,0,8)."04";

$mes1=$sel_mes;
$ano1=$sel_ano;

if($mes1=="12")
{$mes_next1="02";$ano_next1=$ano1+1;$mes1="01";$ano1=$ano1+1;}
elseif($mes1=="11")
{$mes_next1="01";$ano_next1=$ano1+1;$mes1=$mes1+1;}
else {$mes_next1=$mes1+2;$ano_next1=$ano1;$mes1=$mes1+1;}

if(strlen($mes_ant1)==1)
$mes_ant1=0 .$mes_ant1;

$fecha_01_fin1=$ano_next1."/".$mes_next1."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini1=$ano1."/".$mes1."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_1."' 
and fecha_cal>='$fecha_01_ini1' and fecha_cal<'$fecha_01_fin1' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_next=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------


$query = "select e_articulo.ide_articulo, ecod_articulo, earticulo, cod_dpa_nueva, prov_mun_nuevo, d_art_dpa.indice, id_mercado_nuevo
from e_articulo,d_art_dpa, n_dpa, b_articulo

where d_art_dpa.fecha='".$fecha_cal_inicio_sem1_next."'and d_art_dpa.idb_articulo=b_articulo.idb_articulo and b_articulo.ide_articulo=e_articulo.ide_articulo and n_dpa.cod_dpa=d_art_dpa.cod_dpa";
 
   if($rol=='aut_p') 
   {$query=$query."  and n_dpa.cod_dpa like '".$cod_dpa2."'";}
   elseif($rol=='autor')
   {$query=$query."  and n_dpa.cod_dpa='".$cod_dpa."'";}
   elseif($rol=='admin' || $rol=='super' || $rol=='edito')
   {if($sel_cod_dpa!=0)
    $query .= " and n_dpa.cod_dpa='".$sel_cod_dpa."'"; 
   }
   if($sel_moneda!=0)
   $query .= " and b_articulo.id_mercado_nuevo='".$sel_moneda."'"; 
   


if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);


//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;
//print $rs;



$mes=$sel_mes;
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
}
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
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/large/mydocuments.gif" width="48" height="48" border="0"></td>
                          <td width="90%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Listado
                                 de variaciones de micro&iacute;ndices de precios por art&iacute;culo y mercado
                                 <?php if($rol=="autor")echo "de ".$prov_mun_nuevo; if($fecha_text!="") {?> en
                                 el mes de <?php echo $fecha_text;}?></font></strong></td>
                         
                          <td > 
                            <div align="center"> <a  class="toolbar" href="imp_datos.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td > 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('help/l_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" height="50"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
<tr align="center" valign="middle"> 
                    <td height="50" colspan="15"  > 
                      <table width="735" height="50" border="0" cellpadding="0" cellspacing="0" class="filtro" >
<tr>
  <td width="156" height="20">&nbsp;</td>
  <td width="157"><div align="right"><a  href="#" onClick="javascript: document.frm.submit();">Ir: </a>
      <input  name="txt_ir" type="text" class="combo" value="" size="3" >
</div></td>
  <td colspan="2"  align="center"><div align="right"><a href="#">
    </a><a href="#">&nbsp;
    <?php
  					if($sel_mes!=0 and $sel_ano!=0)
{
  							$pager_nav->Render_Navegator();		?>
    </a>
      <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];	}	
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
    &nbsp;
  </div></td>
  </tr>
<tr> 
                            <td height="20" colspan="2"> 
                              <div align="left">Filtro: 
                                <input  name="txt_filtro" type="text" value="<?php echo $txt_filtro ?>" size="15">
                                <select  onChange="document.frm.submit();"  name="sel_filtro">
                                  <option value="<?php echo "no" ?>">-Seleccionar-</option>
                                  
                                      <option value="<?php echo "ecod_articulo" ?>"<?php if ($sel_filtro == "ecod_articulo") { echo "selected"; } ?>><?php echo htmlspecialchars("Cód. Artículo") ?></option>
                                  
                                          <option value="<?php echo "earticulo" ?>"<?php if ($sel_filtro == "earticulo") { echo "selected"; } ?>><?php echo htmlspecialchars("Artículo") ?></option>
                                </select>
                              </div></td>
                          <td width="107"  align="center"><div align="left"> <a href="#">
                          <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
DPA:
<?php }?>
                          </a></div></td>
                      <td width="315"  align="right"><div align="left">
                       <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?>
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
                        </select>
                        <?php }?>&nbsp;
                      </div></td>
</tr>
                      </table>                    
                      <table width="739" height="32" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                        <tr>
                          <td width="104" height="20"><div align="right">Moneda:</div></td>
                          <td width="195"><select name="sel_moneda" title="Mercado" id="sel_moneda" onChange="document.frm.submit();" >
                              <option value="0">----</option>
                              <?php 
                     				$id=$_POST['sel_moneda'];
									
									$query_sel = "select distinct mercado_nuevo, n_mercado.id_mercado_nuevo from n_mercado";
									$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
									$cant_rs=$rs_selected->RecordCount();
										for ($i = 0; $i < $cant_rs;$i++)
										{
											$rs_fields0=$rs_selected->Fields('mercado_nuevo');
											$rs_fields_id=$rs_selected->Fields('id_mercado_nuevo');						$rs_fields1="";				 
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											$rs_selected->MoveNext();
										}
								    ?>
                          </select></td>
                          <td width="63"><div align="right">Mes:</div></td>
                          <td width="146"><select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                              <option value="0">---------------</option>
                              <option <?php if($sel_mes=="01")print "selected";?> value="01">Enero</option>
                              <option <?php if($sel_mes=="02")print "selected";?> value="02">Febrero</option>
                              <option <?php if($sel_mes=="03")print "selected";?> value="03">Marzo</option>
                              <option <?php if($sel_mes=="04")print "selected";?> value="04">Abril</option>
                              <option <?php if($sel_mes=="05")print "selected";?> value="05">Mayo</option>
                              <option <?php if($sel_mes=="06")print "selected";?> value="06">Junio</option>
                              <option <?php if($sel_mes=="07")print "selected";?> value="07">Julio</option>
                              <option <?php if($sel_mes=="08")print "selected";?> value="08">Agosto</option>
                              <option <?php if($sel_mes=="09")print "selected";?> value="09">Septiembre</option>
                              <option <?php if($sel_mes=="10")print "selected";?> value="10">Octubre</option>
                              <option <?php if($sel_mes=="11")print "selected";?> value="11">Noviembre</option>
                              <option <?php if($sel_mes=="12")print "selected";?> value="12">Diciembre</option>
                            </select>                          </td>
                          <td width="69"  align="center"><div align="right">A&ntilde;o:</div></td>
                          <td width="162"  align="center"><div align="left">
                              <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                              <option value="0">------</option>
                              <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){
							  if($anno-$i>=2011)
							  {
							  
							  ?>
                              <option <?php if($sel_ano==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                              <?php }}?>
                            </select>
                          </div></td>
                        </tr>
                      </table>
                    <p>&nbsp;</p></td>
                  </tr>
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="23" height="20">No</td>
                    <td width="82" class="intro" ><a href="indice_art_dpa_x_mer.php?order=<?php echo  "id_mercado_nuevo";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_ano=<?php echo $sel_ano?>&sel_mes=<?php echo $sel_mes?>">Moneda</a></td>
                    <td width="109" class="intro" ><a href="indice_art_dpa_x_mer.php?order=<?php echo  "ecod_articulo";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_ano=<?php echo $sel_ano?>&sel_mes=<?php echo $sel_mes?>">Código Art&iacute;culo</a></td>
                    <td width="304" class="intro" ><a href="indice_art_dpa_x_mer.php?order=<?php echo  "earticulo";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_ano=<?php echo $sel_ano?>&sel_mes=<?php echo $sel_mes?>">Artículo</a></td>
                    <td width="134" class="intro" ><div align="right"><a href="indice_art_dpa_x_mer.php?order=<?php echo "indice";?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_ano=<?php echo $sel_ano?>&sel_mes=<?php echo $sel_mes?>">Variación mensual (%)</a></div></td>
                     <td width="89" class="intro" ><?php if($rol!="autor") {?><a href="indice_art_dpa_x_mer.php?order=<?php echo "cod_dpa_nueva".", ".$order ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>&sel_cod_dpa=<?php echo $sel_cod_dpa?>&sel_ano=<?php echo $sel_ano?>&sel_mes=<?php echo $sel_mes?>">Cod DPA</a><?php }else print "&nbsp;";?></td>
                    
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
		 
		$id_mercado_nuevo=$rs->Fields('id_mercado_nuevo');
		if($id_mercado_nuevo)
		{
		$sql_moneda = "select distinct mercado_nuevo from n_mercado where id_mercado_nuevo='$id_mercado_nuevo'";		
		$rs_moneda = $db->Execute($sql_moneda)or die($db->ErrorMsg()) ;
		$cant_moneda=$rs_moneda->RecordCount();
		
		$mercado_nuevo=$rs_moneda->Fields('mercado_nuevo');
		}	
		$indice=number_format($rs->fields["indice"]*100-100, 2, ',', ' ');
		  
  ?>
                  <tr  height="50" <?php $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";?>> 
                    <td align="center" class="raya"><?php  echo $a; ?></td>
                    <td class="raya"align="center"><?php echo $mercado_nuevo;?></td>
                    <td class="raya"align="center"><?php echo $rs->fields["ecod_articulo"];?></td>
                    <td class="raya"align="center">
					  <?php echo $rs->fields["earticulo"];?></td>
                    <td align="center"  class="raya"><div align="right"><?php echo $indice;?></div></td>
                     
					 
                     <td class="raya"align="center"><?php if($rol!="autor") {?><a onMouseOver="return overlib('<?php echo "DPA: ".$rs->fields["prov_mun_nuevo"];?>', ABOVE, RIGHT);" onMouseOut="return nd();" class="toolbar1" ><?php echo $rs->fields["cod_dpa_nueva"];?></a><?php }else print "&nbsp;";?></td>
                     
                  </tr>
                  <?php 
					
   


	  	$rs->MoveNext();
	  	}
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
