<?php session_start();?>
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
                          <td width="7%" valign="middle"  class="us"><img src="../../imagenes/large/agt_business.gif" alt="" width="48" height="48" border="0"></td>
<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 
include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");
include($x."administracion/config/fechas.php");

$fecha=$fecha_cal_inicio_sem1_next;
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

$sel_mercado=$_GET["sel_mercado"];
if($sel_mercado=="1")$mercado= "Formal";
if($sel_mercado=="2")$mercado= "Informal";
if($sel_mercado=="3")$mercado= "Agropecuario";
if($sel_mercado=="4")$mercado= "Divisa";
?>


                          <td width="85%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Listado
                                 de &iacute;ndices simples sin encadenar de art&iacute;culos   <?php if($mercado!="") {?>                            
en
                          el mercado <?php echo $mercado;}?>
     <?php if($fecha_text!="") {?>                            
 en
                          el mes de <?php echo $fecha_text;}?></font></strong></td>
                          <td width="8%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_canasta.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../imagenes/admin/help.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" class="tabla" >
                  <tr align="center" valign="middle">
                    <td height="23" colspan="16"  >&nbsp;</td>
                  </tr>
                 
                  <tr align="center" valign="center"  >
                    <td width="6%" height="44" class="intro">
                      N</td>
                    <td width="48%"   class="intro">Art&iacute;culos </td>
                    <td width="40%"   class="intro">&Iacute;ndice</td>
                    <td width="6%"   class="intro">&nbsp;</td>
                  </tr>
                  
                  
<?php 


$relativos = array();	
$rel_var = array();
$rel_art = array();
$count="";

if ($_GET["sel_mercado"]!="") $id_mercado = $_GET['sel_mercado'];


$sql_sel_art = "select distinct e_articulo.ide_articulo, earticulo, ecod_articulo from e_articulo, n_variedad, b_variedad
where n_variedad.ide_articulo=e_articulo.ide_articulo
and n_variedad.id_variedad=b_variedad.id_variedad
and b_variedad.id_mercado='$id_mercado'
and e_articulo.ide_articulo!='1' group by ecod_articulo, e_articulo.ide_articulo, earticulo order by ecod_articulo";//print $sql_sel_n_art;die();//where fecha='$fecha_i_var_dpa'
$rs_sel_art = $db->Execute($sql_sel_art) or die($db->ErrorMsg());

$cant_art=$rs_sel_art->RecordCount();
$rs_sel_art->MoveFirst();
for($art=1;$art<=$cant_art;$art++)
{ 
	$ide_articulo=$rs_sel_art->Fields('ide_articulo');
	$articulo=$rs_sel_art->Fields('earticulo');
	$ecod_articulo=$rs_sel_art->Fields('ecod_articulo');

	$sql_sel_dpa = "select * from n_dpa where incluido='1' order by cod_dpa";// and cod_dpa_nueva='2609' 
	$rs_sel_dpa = $db->Execute($sql_sel_dpa) or die($db->ErrorMsg());
	
	$cant_dpa=$rs_sel_dpa->RecordCount();
	$rs_sel_dpa->MoveFirst();
	for($dpa=1;$dpa<=$cant_dpa;$dpa++)
	{	
		$cod_dpa=$rs_sel_dpa->Fields('cod_dpa');
				
		$sql_sel_n_art = "select distinct e_articulo.ide_articulo from e_articulo, n_variedad, b_variedad
		where n_variedad.ide_articulo=e_articulo.ide_articulo
		and n_variedad.id_variedad=b_variedad.id_variedad
		and b_variedad.id_mercado='$id_mercado'
		and e_articulo.ide_articulo='$ide_articulo'";//print $sql_sel_n_art;die();//where fecha='$fecha_i_var_dpa'
		$rs_sel_n_art = $db->Execute($sql_sel_n_art) or die($db->ErrorMsg());
		
		$cant_n_art=$rs_sel_n_art->RecordCount();
		$rs_sel_n_art->MoveFirst();
		for($n_art=1;$n_art<=$cant_n_art;$n_art++)
		{ 
			$sql_sel_variedad = "select distinct n_variedad.id_variedad
			from n_estab, n_var_estab, b_variedad, n_variedad, captacion as cap_ant, captacion 
			WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
			and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
			and	captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
			and captacion.fecha<'$fecha_cal_inicio_sem1_next'
			
			and captacion.id_var_estab=cap_ant.id_var_estab and captacion.id_var_estab=n_var_estab.id_var_estab 
			and captacion.precio!=0 and cap_ant.precio!=0
			and b_variedad.idb_variedad=n_var_estab.idb_variedad and n_variedad.id_variedad=b_variedad.id_variedad 
			and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa='".$cod_dpa."' 
			and b_variedad.id_mercado='$id_mercado'			
			and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_next') 
			and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_next') 
			and n_variedad.ide_articulo='$ide_articulo' and captacion.va_a_calculo='1' 
			and fecha_captar >='".$fecha_base."' order by n_variedad.id_variedad";//print $sql_sel_variedad;die(); //and ecod_var='02.1.1.1.01.06' and variedad like 'Huevos frescos de gallina (normados)'
			$rs_sel_variedad = $db->Execute($sql_sel_variedad) or die($db->ErrorMsg());
			
			$cant_variedad=$rs_sel_variedad->RecordCount();
			$rs_sel_variedad->MoveFirst();
			for($var=1;$var<=$cant_variedad;$var++)
			{ 
				$id_variedad=$rs_sel_variedad->Fields('id_variedad');
					
				$sql_sel_bvariedad = "select distinct b_variedad.idb_variedad 
				from n_estab, n_var_estab, b_variedad, captacion as cap_ant, captacion 
				WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
				and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
				and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
				and captacion.fecha<'$fecha_cal_inicio_sem1_next'
				  
				and captacion.id_var_estab=cap_ant.id_var_estab and captacion.id_var_estab=n_var_estab.id_var_estab 
				and captacion.precio!=0 and cap_ant.precio!=0 and captacion.va_a_calculo='1'
				and b_variedad.idb_variedad=n_var_estab.idb_variedad
				and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa='".$cod_dpa."' 
				and b_variedad.id_mercado='$id_mercado'
				and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_next') 
				and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_next') 
				
				and fecha_captar >='".$fecha_base."' and b_variedad.id_mercado='$id_mercado' and id_variedad='".$id_variedad."'"; //print $sql_sel_bvariedad;die();
				$rs_sel_bvariedad = $db->Execute($sql_sel_bvariedad) or die($db->ErrorMsg());
				
				$cant_bvariedad=$rs_sel_bvariedad->RecordCount();
				$rs_sel_bvariedad->MoveFirst();	
				for($bvar=1;$bvar<=$cant_bvariedad;$bvar++)
				{ 		
					$idb_variedad=$rs_sel_bvariedad->Fields('idb_variedad');
				
					$sql_captacion = "SELECT captacion.precio/cap_ant.precio as relat
					
					FROM captacion as cap_ant, captacion, n_var_estab, 
					n_estab 
					
					WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
					and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
					and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
					and captacion.fecha<'$fecha_cal_inicio_sem1_next' 			
					and captacion.id_var_estab=cap_ant.id_var_estab 			
					and captacion.va_a_calculo='1'
					
					and n_estab.cod_dpa='".$cod_dpa."'
					
					and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_next') 
					and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_next')
					and captacion.id_var_estab=n_var_estab.id_var_estab 		
					and n_var_estab.id_estab=n_estab.id_estab 		
					
					and captacion.precio!=0 and cap_ant.precio!=0
					and fecha_captar >='".$fecha_base."' and idb_variedad='".$idb_variedad."'";//print $sql_captacion."<br><br>";
					$rs_captacion = $db->Execute($sql_captacion)or die($db->ErrorMsg());
					$cant_cap=$rs_captacion->RecordCount();
					
					for($cap=1;$cap<=$cant_cap;$cap++)
					{ 			
						$relat=$rs_captacion->Fields('relat');
						if($relat!="" && $relat!=0)
						{								
							$count=count($relativos);
							$relativos[$count]=$relat;		  
						//print $relativos[$count]."  ".$count."<br>";
						}							
					$rs_captacion->MoveNext();   
					}		
				$rs_sel_bvariedad->MoveNext();   
				}
			
				if($relativos[0])
				{
					$obj = new medias;
					$indice_var=$obj->geo($relativos);
					//print "indice=".$indice."<br>";//die();			
					foreach ($relativos as $g => $valorg) {unset($relativos[$g]);}		
					if($indice_var!="" && $indice_var!=0)
					{								
						$count_var=count($rel_var_dpa);
						$rel_var_dpa[$count_var]=$indice_var;		  
					//print $relativos[$count]."  ".$count."<br>";
					}	
				}	
			$rs_sel_variedad->MoveNext();   
			}
			if($rel_var_dpa[0])
			{
				$obj1 = new medias;
				$indice_art_dpa=$obj1->geo($rel_var_dpa);
				//print "indice=".$indice."<br>";//die();			
				foreach ($rel_var_dpa as $g => $valorg) {unset($rel_var_dpa[$g]);}		
				if($indice_art_dpa!="" && $indice_art_dpa!=0)
				{								
					$count_art_dpa=count($rel_art_dpa);
					$rel_art_dpa[$count_art_dpa]=$indice_art_dpa;		  
				//print $relativos[$count]."  ".$count."<br>";
				}	
			}
		$rs_sel_n_art->MoveNext();   
		}		
	$rs_sel_dpa->MoveNext();   
	}
	
	if($rel_art_dpa[0])
	{
		$obj2 = new medias;
		$indice_art=$obj2->geo($rel_art_dpa);
		//print "indice=".$indice."<br>";//die();			
		foreach ($rel_art_dpa as $g => $valorg) {unset($rel_art_dpa[$g]);}			
	}	
	//print 	$ecod_articulo.". ".$articulo."  -  ".$indice_art."<br>";
	$indice_art=number_format($indice_art, 30, ',', '');
	
   ?>
                 
                  <tr <?php  $a=$a+1;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center"><?php print $a; ?></div></td>
                    <td  class="raya" height="19" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onMouseOver="return overlib('Artículo', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php echo $ecod_articulo.". ";echo $articulo;?>
                    </a></td>
                    <td  class="raya" align="right" ><?php print $indice_art; ?></td>
                    <td  class="raya" ><div align="right"></div></td>
                  </tr>
                  
<?php 
$rs_sel_art->MoveNext();   
}			
?>
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
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
