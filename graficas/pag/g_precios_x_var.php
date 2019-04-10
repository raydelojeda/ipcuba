<?php 
$x="../../";
session_start();
require_once($x."adodb/adodb.inc.php");
require_once($x."coneccion/conn.php");
include($x."php/session/session_autor.php");

include("../Includes/FusionCharts.php");


if ($_GET["id_estab"]!="") $id_estab = $_GET['id_estab'];
if ($_GET["id_var"]!="") $id_var = $_GET['id_var'];
if ($_GET["dia1"]!="") $dia1 = $_GET['dia1'];
if ($_GET["dia2"]!="") $dia2 = $_GET['dia2'];


//---------------------------------------------------

$sql_cap = "select captacion.fecha as fecha_cap,variedad, precio, nombre, apellidos, telef, rol, va_a_calculo, inc, obs, n_inc.id_inc

FROM n_mercado, n_tipologia, n_unidad,n_dpa, n_estab, n_var_estab, b_variedad, n_variedad, captacion, usuario, n_inc, n_obs 

WHERE captacion.fecha>='$dia1' and captacion.fecha<'$dia2' 
and captacion.id_var_estab=n_var_estab.id_var_estab 
and b_variedad.idb_variedad=n_var_estab.idb_variedad 
and n_variedad.id_variedad=b_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa 
and n_var_estab.id_estab=n_estab.id_estab 
and usuario.id_usuario=captacion.id_usuario 
and captacion.id_obs=n_obs.id_obs 
and captacion.id_inc=n_inc.id_inc 

and central='0' and n_variedad.ide_articulo!='1' 

and n_unidad.id_unidad=n_var_estab.id_unidad 
and n_tipologia.id_tipologia=n_estab.id_tipologia 
and n_mercado.id_mercado=b_variedad.id_mercado 

and n_variedad.id_variedad='$id_var' and n_estab.id_estab='$id_estab'
order by captacion.fecha asc 
";	
//print 	$sql_cap;
$rs_cap = $db->Execute($sql_cap)or $mensaje=$db->ErrorMsg() ;


$cant_rs=$rs_cap->RecordCount();

$sql_cap1 = "select min(precio), max(precio)

FROM n_mercado, n_tipologia, n_unidad,n_dpa, n_estab, n_var_estab, b_variedad, n_variedad, captacion, usuario, n_inc, n_obs 

WHERE captacion.fecha>='$dia1' and captacion.fecha<'$dia2' 
and captacion.id_var_estab=n_var_estab.id_var_estab 
and b_variedad.idb_variedad=n_var_estab.idb_variedad 
and n_variedad.id_variedad=b_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa 
and n_var_estab.id_estab=n_estab.id_estab 
and usuario.id_usuario=captacion.id_usuario 
and captacion.id_obs=n_obs.id_obs 
and captacion.id_inc=n_inc.id_inc 

and central='0' and n_variedad.ide_articulo!='1' 

and n_unidad.id_unidad=n_var_estab.id_unidad 
and n_tipologia.id_tipologia=n_estab.id_tipologia 
and n_mercado.id_mercado=b_variedad.id_mercado 

and n_variedad.id_variedad='$id_var' and n_estab.id_estab='$id_estab'
";	
//print 	$sql_cap;
$rs_cap1 = $db->Execute($sql_cap1)or $mensaje=$db->ErrorMsg() ;
		
?>
<SCRIPT LANGUAGE="Javascript" SRC="../FusionCharts/FusionCharts.js"></SCRIPT>

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
                    <td height="56" align="right" class="menudottedline"><table width="99%" border="0" class="menubar"  id="toolbar">
                      <tr >
                        <td width="7%" height="50" valign="middle"  class="us"><img src="../../imagenes/large/3d.gif" alt="" width="48" height="48" border="0"><strong><font color="#000000" size="1"> </font></strong></td>
                        <td width="93%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Precios por variedad entre fechas y provincia.</font></strong></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
                <?php
	//In this example, we show how to connect FusionCharts to a database.
	//For the sake of ease, we've used an MySQL databases containing two
	//tables.
		
	// Connect to the DB
	

	//$strXML will be used to store the entire XML document generated
	//Generate the graph element
	
$min=round($rs_cap1->Fields("min")-1);
$max=round($rs_cap1->Fields("max")+1);
$variedad=$rs_cap->Fields("variedad");

	$strXML = "<graph caption='Serie de precios por variedad' subcaption='".$variedad."' xAxisName='Meses' yAxisMinValue='".$min."' yAxisMaxValue='".$max."' yAxisName='Precios' decimalPrecision='2' formatNumberScale='2' numberPrefix='' showNames='1' showValues='1'  showAlternateHGridColor='0' AlternateHGridColor='000000' divLineColor='000000' divLineAlpha='100' alternateHGridAlpha='0' >";

	// Fe
    
	//Iterate through each factory
	
			//Generate <set name='..' value='..' />    
			//$strXML .= "<set name='' value='' hoverText='' />";
for ($i = 0; $i < $cant_rs;$i++)
{		    

$fecha_cap=$rs_cap->Fields("fecha_cap");
$precio=$rs_cap->Fields("precio");





$obs3=$rs_cap->Fields("obs");
$inc3=$rs_cap->Fields("inc");
$id_inc3=$rs_cap->Fields("id_inc");
$va_a_calculo3=$rs_cap->Fields("va_a_calculo");

$rol3=$rs_cap->fields["rol"];$telef_rol3="";
if($rol3=="edito") 
{$telef_rol3=" Rol: Editor-ONE";}
elseif($rol=="aut_p")
{$telef_rol3=" Rol: Autor Provincial";}
elseif($rol3=="autor")
{$telef_rol3=" Rol: Autor Municipal";} 
elseif($rol3=="admin")
{$telef_rol3=" Rol: Administrador";}

$fecha_text2="Captado por: ". $rs_cap->fields["nombre"]." ".$rs_cap->fields["apellidos"].$telef_rol3;

$fecha_text2.=" ";
if($id_inc3!=1)$fecha_text2.=" Incidencia: ".$inc3;else $fecha_text2.=" Observación: ".$obs3;
if($cont_imp3)$fecha_text2.="  Precio imputado";$fecha_text2.=" ";
if($va_a_calculo3==1){$fecha_text2.="   Va a cálculo";} else {$fecha_text2.="   No va a cálculo.";}


$mes=substr($fecha_cap,5,2);
$ano=substr($fecha_cap,2,2);
if($mes=="01"){$fecha_text= "Ene/".$ano;$fecha_text2.= ", Enero";}
if($mes=="02"){$fecha_text= "Feb/".$ano;$fecha_text2.= ", Febrero";}
if($mes=="03"){$fecha_text= "Mar/".$ano;$fecha_text2.= ", Marzo";}
if($mes=="04"){$fecha_text= "Abr/".$ano;$fecha_text2.= ", Abril";}
if($mes=="05"){$fecha_text= "May/".$ano;$fecha_text2.= ", Mayo";}
if($mes=="06"){$fecha_text= "Jun/".$ano;$fecha_text2.= ", Junio";}
if($mes=="07"){$fecha_text= "Jul/".$ano;$fecha_text2.= ", Julio";}
if($mes=="08"){$fecha_text= "Ago/".$ano;$fecha_text2.= ", Agosto";}
if($mes=="09"){$fecha_text= "Sep/".$ano;$fecha_text2.= ", Septiembre";}
if($mes=="10"){$fecha_text= "Oct/".$ano;$fecha_text2.= ", Octubre";}
if($mes=="11"){$fecha_text= "Nov/".$ano;$fecha_text2.= ", Noviembre";}
if($mes=="12"){$fecha_text= "Dic/".$ano;$fecha_text2.= ", Diciembre";}



			$strXML .= "<set name='" . $fecha_text . "' value='" . $precio . "' hoverText='".$fecha_text2."' />";
			
			
			
			
			
$rs_cap->MoveNext();
	  	}
		//$strXML .= "<set name='' value='' hoverText='' />";
	//Finally, close <graph> element
	$strXML .= "</graph>";
	
	//Create the chart - Pie 3D Chart with data from $strXML
	echo renderChart("../Charts/FCF_Line.swf", "", $strXML, "FactorySum", 750, 400, false, false);
?>
               
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
